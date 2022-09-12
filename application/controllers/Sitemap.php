<?php

class Sitemap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_sitemap');
    }

    public function index()
    {
        $this->load->model('Model_sitemap');
        $data['produk'] = $this->Model_sitemap->produk();
        $data['artikel'] = $this->Model_sitemap->artikel();
        $this->load->view('view_sitemap', $data);
    }
}
