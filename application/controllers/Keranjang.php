<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_app');
        $this->load->model('Model_artikel');
    }

    function index()
    {
        $id_produk   = filter(decrypt_url($this->input->post('id_produk')));
        $jumlah   = filter($this->input->post('jumlah'));;
        //$stok = $b['beli'] - $j['jual'];
        $query = $this->db->get_where('tb_toko_produk', array('id_produk' => $id_produk));
        foreach ($query->result() as $row) {
            $stok = $row->stok;
        }

        if ($id_produk != '') {
            if ($stok < $this->input->post('jumlah') or $stok <= '0') {
                $produk = $this->Model_app->edit('tb_toko_produk', array('id_produk' => $id_produk))->row_array();
                $produk_cek = filter($produk['nama_produk']);
                echo "<script>window.alert('Maaf, Stok untuk pemesanan Produk - $produk_cek Tidak Mencukupi!');
                                  window.location=('" . base_url() . "produk/detail/$produk[produk_seo]')</script>";
            } else {
                $this->session->unset_userdata('produk');
                if ($this->session->idp == '') {
                    $idp = 'INV-' . date('YmdHis');
                    $this->session->set_userdata(array('idp' => $idp));
                }

                $cek = $this->Model_app->view_where('tb_toko_penjualantemp', array('session' => $this->session->idp, 'id_produk' => $id_produk))->num_rows();
                if ($cek >= 1) {
                    $this->db->query("UPDATE tb_toko_penjualantemp SET jumlah=jumlah+$jumlah where session='" . $this->session->idp . "' AND id_produk='$id_produk'");
                } else {
                    $harga = $this->Model_app->view_where('tb_toko_produk', array('id_produk' => $id_produk))->row_array();
                    $data = array(
                        'session' => $this->session->idp,
                        'id_produk' => $id_produk,
                        'jumlah' => $jumlah,
                        'harga_jual' => $harga['harga_konsumen'],
                        'satuan' => $harga['satuan'],
                        'waktu_order' => date('Y-m-d H:i:s')
                    );
                    $this->Model_app->insert('tb_toko_penjualantemp', $data);
                }
                redirect('keranjang');
            }
        } else {
            $data['record'] = $this->Model_app->view_join_rows('tb_toko_penjualantemp', 'tb_toko_produk', 'id_produk', array('session' => $this->session->idp), 'id_penjualan_detail', 'ASC');
            $data['title'] = 'Keranjang Belanja';
            $data['breadcrumb'] = 'Keranjang Belanja';
            $this->template->load('home/template', 'home/produk/view_keranjang', $data);
        }
    }

    function update()
    {

        $id_pen = $this->input->post('id_penjualan_detail');
        $jumlah = $this->input->post('jumlah');
        if (!empty($id_produk)) {
            foreach ($id_pen as $index => $val) {
                $data = array(
                    'id_penjualan_detail' => $val,
                    'jumlah'    => $jumlah[$index]
                );
                $this->db->update('tb_toko_penjualantemp', $data);
            }
        }
        redirect('keranjang');
    }

    function update2()
    {

        $id_pen = decrypt_url($this->uri->segment(3));
        $jumlah = $this->input->post('jumlah');

        $data = array(
            'jumlah'    => $jumlah
        );
        $this->db->update('tb_toko_penjualantemp', $data, "id_penjualan_detail='$id_pen'");

        redirect('keranjang');
    }

    function delete()
    {
        $id = array('id_penjualan_detail' => decrypt_url($this->uri->segment(3)));
        $this->Model_app->delete('tb_toko_penjualantemp', $id);
        $isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM tb_toko_penjualantemp where session='" . $this->session->idp . "'")->row_array();
        if ($isi_keranjang['jumlah'] == '') {
            $this->session->unset_userdata('idp');
            $this->session->unset_userdata('reseller');
        }
        redirect('keranjang');
    }

    function delete2()
    {
        $id = array('id_penjualan_detail' => decrypt_url($this->uri->segment(3)));
        $this->Model_app->delete('tb_toko_penjualantemp', $id);
        $isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM tb_toko_penjualantemp where session='" . $this->session->idp . "'")->row_array();
        if ($isi_keranjang['jumlah'] == '') {
            $this->session->unset_userdata('idp');
            $this->session->unset_userdata('reseller');
        }
        redirect('keranjang/checkouts');
    }

    function checkouts()
    {
        if (isset($_POST['submit'])) {
            if ($this->session->idp != '') {
                $this->load->library('email');
                $data = array(
                    'kode_transaksi' => $this->session->idp,
                    'id_pembeli' => $this->session->id_pengguna,
                    'diskon' => $this->input->post('diskonnilai'),
                    'kurir' => $this->input->post('kurir'),
                    'service' => $this->input->post('service'),
                    'ongkir' => $this->input->post('ongkir'),
                    'waktu_transaksi' => date('Y-m-d H:i:s'),
                    'proses' => '0',
                    'p_nama' => $this->input->post('nama_pem'),
                    'p_telp' => $this->input->post('telp_pem'),
                    'p_kota' => $this->input->post('kota_pem'),
                    'p_kec' => $this->input->post('kec_pem'),
                    'p_alamat' => $this->input->post('alamat_pem'),
                    'p_pos' => $this->input->post('pos_pem'),
                );
                $this->Model_app->insert('tb_toko_penjualan', $data);
                $idp = $this->db->insert_id();

                $keranjang = $this->Model_app->view_where('tb_toko_penjualantemp', array('session' => $this->session->idp));
                foreach ($keranjang->result_array() as $row) {
                    $dataa = array(
                        'id_penjualan' => $idp,
                        'id_produk' => $row['id_produk'],
                        'jumlah' => $row['jumlah'],
                        'harga_jual' => $row['harga_jual'],
                        'satuan' => $row['satuan']
                    );
                    $this->Model_app->insert('tb_toko_penjualandetail', $dataa);

                    $q = $this->db->get_where('tb_toko_produk', array('id_produk' => $row['id_produk']));
                    foreach ($q->result() as $r) {
                        $stoq =  $r->stok;
                    }
                    $datastok = array(
                        'stok'    => $stoq - $row['jumlah']
                    );

                    $this->db->where('id_produk', "$row[id_produk]");
                    $this->db->update('tb_toko_produk', $datastok);
                }
                $this->Model_app->delete('tb_toko_penjualantemp', array('session' => $this->session->idp));
                $kons = $this->db->query("SELECT * FROM tb_toko_penjualan a JOIN tb_kota b ON a.p_kota=b.kota_id where a.id_penjualan='$idp'")->row_array();

                $id_pengguna = $this->session->id_pengguna;
                $usr = $this->db->query("SELECT email from tb_pengguna where id_pengguna=$id_pengguna")->row_array();
                $email_tujuan = $usr['email'];

                $data['title'] = 'Transaksi Berhasil';
                $data['email'] =  $usr['email'];
                $data['orders'] = $this->session->idp;
                $data['total_bayar'] = rupiah(+$this->input->post('total') + $this->input->post('ongkir'));

                $iden = $this->Model_app->view_where('tb_web_identitas', array('id_identitas' => '1'))->row_array();
                $data['rekening'] = $this->Model_app->view('tb_toko_rekening');


                $tgl = date("d-m-Y H:i:s");

                $subject      = "Detail Pemesanan anda";
                $message      = "
				<html>
				<body>
				Halooo! <b>$kons[p_nama]</b> ... <br> Hari ini pada tanggal $tgl , Anda telah order produk di $iden[nama_website].<br><br>
					<table border='0' style='width:100%;'>
						<tr>
						   <td style='background:#e3e3e3; pading:20px' cellpadding=6><b>Berikut Data Anda : </b></td>
						</tr>
	
						<tr>
						<td width='140px'>
							<b>Nama Lengkap</b></td>
							<td> : $kons[p_nama]</td></tr>
						<tr>
							<td><b>No. Telepon</b></td>
							<td> : $kons[p_telp]</td>
						</tr>
						<tr>
							<td><b>Alamat</b></td>
							<td> : $kons[p_alamat]</td>
						</tr>
						<tr>
							<td></td>
							<td> &nbsp; $kons[p_kec]</td>
						</tr>
						<tr>
							<td></td>
							<td> &nbsp; $kons[nama_kota], $kons[kode_pos]</td>
						</tr>
					</table><br>

					No. Invoice : <b>" . $this->session->idp . "</b><br>
					Berikut Detail Data Orderan Anda :
					
					<table style='width:100%;' border='0'>
				          <thead>
				            <tr bgcolor='#e3e3e3'>
				              <th style='width:40px'>No</th>
				              <th width='47%'>Nama Produk</th>
				              <th>Harga</th>
				              <th>Jumlah</th>
				              <th>Total</th>
				            </tr>
				          </thead>
				          <tbody>";

                $no = 1;
                $belanjaan = $this->Model_app->view_join_where('tb_toko_penjualandetail', 'tb_toko_produk', 'id_produk', array('id_penjualan' => $idp), 'id_penjualan_detail', 'ASC');
                foreach ($belanjaan as $row) {
                    $sub_total = (($row['harga_jual'] - $row['diskon']) * $row['jumlah']);
                    if ($row['diskon'] != '0') {
                        $diskon = "<del style='color:red'>" . rupiah($row['harga_jual']) . "</del>";
                    } else {
                        $diskon = "";
                    }
                    if (trim($row['gambar']) == '') {
                        $foto_produk = 'no-image.png';
                    } else {
                        $foto_produk = $row['gambar'];
                    }
                    $diskon_total = $row['diskon'] * $row['jumlah'];

                    $message .= "<tr>
									<td>$no</td>
				                    <td>$row[nama_produk]</td>
				                    <td>" . rupiah($row['harga_jual'] - $row['diskon']) . " $diskon</td>
				                    <td>$row[jumlah]</td>
				                    <td>Rp " . rupiah($sub_total) . "</td>
				                </tr>";
                    $no++;
                }

                $message .= "<tr bgcolor='#e3e3e3'>
				                  <td colspan='4'><b>Total Berat</b></td>
				                  <td><b>" . $this->input->post('berat') . " gram</b></td>
				                </tr>

				                <tr bgcolor='#e3e3e3'>
				                  <td colspan='4'><b>Biaya Kirim</b></td>
				                  <td><b>Rp " . $this->input->post('ongkir') . "</b></td>
				                </tr>

				                <tr bgcolor='#e3e3e3'>
				                  <td colspan='4'><b>Total Harga</b></td>
				                  <td><b>Rp " . rupiah($this->input->post('total') + $this->input->post('ongkir')) . "</b></td>
				                </tr>

				        </tbody>
				      </table><br>

				      Silahkan melakukan pembayaran ke rekening :
				      <table style='width:100%;' border='0'>
						<thead>
						  <tr bgcolor='#e3e3e3'>
						    <th width='20px'>No</th>
						    <th>Nama Bank</th>
						    <th>No Rekening</th>
						    <th>Atas Nama</th>
						  </tr>
						</thead>
						<tbody>";
                $noo = 1;
                $rekening = $this->Model_app->view('tb_toko_rekening');
                foreach ($rekening->result_array() as $row) {
                    $message .= "<tr><td>$noo</td>
						              <td>$row[nama_bank]</td>
						              <td>$row[no_rekening]</td>
						              <td>$row[pemilik_rekening]</td>
						          </tr>";
                    $noo++;
                }
                $message .= "</tbody>
					  </table><br><br>

				      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='" . base_url() . "konfirmasi'>disini</a><br>
				      Salam. Admin Zamanet Store</body></html> \n";

                $namawebsite = $iden['nama_website'];
                kirim_email($email_tujuan, $subject, $message);
                $data['breadcrumb'] = 'Transaksi Berhasil';

                $iden = $this->Model_app->view_ordering_limit('tb_web_identitas', 'id_identitas', 'DESC', 0, 1)->row_array();
                $emailadmin = $iden['email'];
                $subadmin = 'Pesanan Baru';
                $pesanadmin = 'Hai Admin, ada pesanan baru.. buruan cek sekarang';
                kirim_email($emailadmin, $subadmin, $pesanadmin);

                $this->session->unset_userdata('idp');



                $this->template->load('home/template', 'home/produk/view_transaksi_berhasil', $data);
            } else {
                redirect('keranjang');
            }
        } else {
            $this->session->set_userdata('bypass', true);
            if ($this->session->id_pengguna) {
                $cek = $this->Model_app->view_where('tb_toko_penjualantemp', array('session' => $this->session->idp));
                if ($cek->num_rows() >= 1) {
                    $data['title'] = 'Checkout';
                    $data['breadcrumb'] = 'Checkout';
                    $data['rows'] = $this->Model_app->view_join_where_two('tb_pengguna', 'tb_alamat', 'tb_kota', 'id_alamat', 'id_alamat', 'id_kota', 'kota_id', array('tb_pengguna.id_pengguna' => $this->session->id_pengguna))->row_array();

                    $ses = $this->session->idp;
                    $this->db->join('tb_toko_produk', 'tb_toko_penjualantemp.id_produk=tb_toko_produk.id_produk');
                    $this->db->where("tb_toko_penjualantemp.session='$ses'");
                    $this->db->order_by('tb_toko_penjualantemp.id_penjualan_detail', 'ASC');
                    $query = $this->db->get('tb_toko_penjualantemp');

                    $data['record'] = $query;

                    //$data['record'] = $this->Model_app->view_join_rows('tb_toko_penjualantemp', 'tb_toko_produk', 'id_produk', array('session' => $this->session->idp), 'id_penjualan_detail', 'ASC');
                    $this->template->load('home/template', 'home/produk/view_checkouts', $data);
                } else {
                    redirect('keranjang' . $cek);
                }
            } else {
                redirect('login');
            }
        }
    }
}
