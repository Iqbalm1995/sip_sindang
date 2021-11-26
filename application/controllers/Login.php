<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_global','Model_global');
		$this->load->model('Model_login','Model_login');
    }

	public function index()
	{
        // head data
        $data['title_page'] = 'Login';
        $data['menu_active'] = 'Login';

        // body data
        $data['pages_caption'] = 'Login';
        
		// $this->load->view('template/header', $head);
        $this->load->view('login/login_views', $data);
        // $this->load->view('template/footer');
	}

    public function do_login()
	{
        $uname  	= $this->input->post('uname');
		$pass 		= $this->input->post('pass');
        $remember   = $this->input->post('remember_me');

        if (isset($uname) && isset($pass)) {
            $get_user = $this->Model_login->get_user_login($uname, $pass);

            if ($get_user) {
                $data_session = array(
                        'id' => $get_user->id, 
                        'role_id' => $get_user->role_id, 
                        'role_name' => $get_user->role_name, 
                        'pos_id' => $get_user->pos_id, 
                        'pos_name' => $get_user->pos_name, 
                        'username' => $get_user->username, 
                        'email' => $get_user->email, 
                        'nama' => $get_user->nama, 
                        'status' => $get_user->status, 
                        'login_status' => 'login_active', 
                        'login_on' => date('Y-m-d H:i:s') 
                );
				$this->session->set_userdata($data_session);
                if ($remember) {
                    $this->session->set_userdata('remember_me', TRUE);
                }
                redirect(base_url().'dashboard');

            }else{
            	$this->session->set_flashdata('pesan1', '
				<div class="alert alert-warning alert-dismissible show fadeIn animated">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>&times;</span>
                    </button>
                    <strong>Login Gagal</strong><br>Periksa kembali username dan password. 
                  </div>
                </div>');
            	redirect(base_url().'login');
            }
        }
    }

	public function do_logout()
	{
		$data_session = array(
                        'id' => '',
                        'role_id' => '',
                        'role_name' => '',
                        'pos_id' => '',
                        'pos_name' => '',
                        'username' => '',
                        'email' => '',
                        'nama' => '',
                        'status' => '',
                        'login_status' => '',
                        'login_on' => ''
				);
		$this->session->unset_userdata($data_session);
    	$this->session->sess_destroy();

	    redirect(base_url().'login');
	}
}
