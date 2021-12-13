<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_global','Model_global');
		$this->load->model('Model_posyandu','Model_posyandu');
        /* Restrict user */
        if($this->session->userdata('login_status') != "login_active"){
			redirect(base_url().'login');
		}
    }

	public function index()
	{
        // head data
        $head['title_page'] = 'Dashboard';
        $head['menu_active'] = 'dashboard';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption'] = 'Dashboard';
        
		$this->load->view('template/header', $head);
        $this->load->view('dashboard/dashboard_views', $data);
        $this->load->view('template/footer');
	}
}