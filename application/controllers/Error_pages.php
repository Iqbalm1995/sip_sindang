<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index()
	{
        // head data
        $data['title_page'] = 'Website Is Down';
        // body data
        $data['pages_caption'] = 'Blank Page';
        
        $this->load->view('blank/error_views', $data);
	}
}
