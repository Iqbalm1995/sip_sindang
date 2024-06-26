<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testpage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		// $this->load->model('Model_global','Model_global');
		// $this->load->model('Model_login','Model_login');
    }

	public function index()
	{
        
        echo "awokaowk";
	}
}
