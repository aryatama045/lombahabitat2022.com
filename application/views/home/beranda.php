
<?php
$iden = $this->db->query("SELECT * FROM tb_web_identitas where id_identitas='1'")->row_array();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>Lomba HHD 2021</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Rizki Aryatama">
    <meta name="description" content="<?= $iden['meta_deskripsi']; ?>">
    <meta name="keywords" content="<?= $iden['meta_keyword']; ?>">
    <meta name="robots" content="all,index,follow">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta NAME="Distribution" CONTENT="Global">
    <meta NAME="Rating" CONTENT="General">
    <link rel="canonical" href="<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:title" content="<?= $title; ?>" />
    <meta property="og:description" content="<?= $iden['meta_deskripsi']; ?>" />
    <meta property="og:url" content="<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <meta property="og:site_name" content="<?= $iden['nama_website']; ?>" />

    <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon/') ?><?= $iden['favicon']; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>vendor/photoswipe/photoswipe.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>vendor/photoswipe/default-skin/default-skin.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>css/slick.css">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>vendor/fontawesome/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template/tema/') ?>fonts/stroyka/stroyka.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/'); ?>sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/gijgo/css/gijgo.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/templatemo-style.css" />

    <script src="<?= base_url('assets/template/tema/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/template/js/header.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script>
        var site_url = '<?= base_url() ?>';
    </script>



</head>

<body>

    <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content"></div>
        </div>
    </div>

    <!-- mobile menu -->
    <?php include '_include/mobilemenu.php'; ?>

    <!-- site -->
    <div class="site-home">

        <!-- navbar -->
        <?php include '_include/navbar.php'; ?>

        <section id="hero" class="text-white tm-font-big tm-parallax">

            <div class=" tm-hero-text-container">
                <div class="tm-hero-text-container-inner">
                    <img  src="<?= base_url('assets/home/') ?>center.png" alt="">
                </div>
                <div class="tm-hero-text-container-inner2 ">
                <!--d-md-block d-none-->
                    <img  src="<?= base_url('assets/home/') ?>center2.png" alt="">
                </div>    
                <!-- <div class="tm-hero-text-container-inner4 d-lg-none ">
                    <img  src="<?= base_url('assets/home/') ?>center4.png" alt="">
                </div>  -->
                <div class="tm-hero-text-container-inner3 ">
                <!--d-md-block d-none-->
                    <img  src="<?= base_url('assets/home/') ?>center3.png" alt="">
                </div> 
                <div class="tm-hero-text-container-inner5 ">
                <!--d-md-block d-none-->
                    <img  src="<?= base_url('assets/home/') ?>center5.png" alt="">
                </div>

            </div>
        </section>
    </div>

    <?php $this->M_main->kunjungan(); ?>

    <script src="<?= base_url('assets/template/tema/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>vendor/photoswipe/photoswipe.min.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>vendor/photoswipe/photoswipe-ui-default.min.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>vendor/select2/js/select2.min.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>js/number.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>js/main.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>js/header.js"></script>
    <script src="<?= base_url('assets/template/tema/') ?>vendor/svg4everybody/svg4everybody.min.js"></script>
    <script src="<?= base_url('assets/template/js/'); ?>sweetalert2.min.js"></script>
    <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/template/adminlte3/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('assets/template/gijgo/js/gijgo.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/js/footer.js') ?>"></script>

</body>

</html>