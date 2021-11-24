<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        /* Restrict user */
        // if($this->session->userdata('status') != "login_active"){
		// 	redirect(base_url().'admin');
		// }
    }

	public function index()
	{
        // head data
        $head['title_page'] = 'Blank Page';

        // body data
        $data['pages_caption'] = 'Blank Page';
        
		$this->load->view('template/header', $head);
        $this->load->view('blank/blank_views', $data);
        $this->load->view('template/footer');
	}
}
