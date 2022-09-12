<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	    $data['title']		= '';
			
			// $this->template->load('home/template', 'home/view_home', $data);
			$this->load->view('home/beranda', $data);
		
	}
}
