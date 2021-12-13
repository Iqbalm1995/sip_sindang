<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_global','Model_global');

        /* Restrict user */
        if($this->session->userdata('login_status') != "login_active"){
			redirect(base_url().'login');
		}

		if (!in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_LV2)) {
			redirect(base_url().'dashboard');
		}
    }

	public function index()
	{
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // head data
        $head['title_page']     = 'Data Pengguna';
        $head['menu_active']    = 'pengguna';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Pengguna';

		$data['data_pos']  	= $this->Model_posyandu->get_posyandu();
		$data['data_role']  = $this->Model_user->get_roles();
        
		$this->load->view('template/header', $head);
        $this->load->view('user/user_views', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_pengguna()
	{
        $role_admin = array('Dev');
		$list = $this->Model_user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_usr) {
			$no++;
			$row = array();

			if ($r_usr->status == 1) {
				$status = '<span class="badge badge-primary">Aktif</span>';
			}else{
				$status = '<span class="badge badge-danger">Nonaktif</span>';
			}

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_usr->nama;
			$row[] = $r_usr->email;
			$row[] = $r_usr->username;
			$row[] = $r_usr->role_name;
			$row[] = ( !empty($r_usr->pos_name) ? $r_usr->pos_name : '<div class="text-center">-</div>' ) ;
			$row[] = '<div class="text-center">'.$status.'</div>';

			//add html for action
            if (in_array( $r_usr->role_name ,$role_admin)) {
                $row[] = '<div class="text-center">-</div>';
            }else{
				if ($this->session->userdata('id') != $r_usr->id) {
					$row[] = '<div class="text-center">
									<a class="btn btn-sm btn-primary" href="'.base_url().'users/edit/'.$r_usr->id.'" title="Ubah">
										<i class="fas fa-edit"></i> Ubah</a>
									<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
											title="Hapus"
											onclick="delete_pengguna('."'".$r_usr->id."'".')">
											<i class="fas fa-trash"></i> Hapus</a>
								</div>';
				}else{
					$row[] = '<div class="text-center">
									<a class="btn btn-sm btn-primary" href="'.base_url().'users/edit/'.$r_usr->id.'" title="Ubah">
										<i class="fas fa-edit"></i> Ubah</a>
								</div>';
				}
            }
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_user->count_all(),
						"recordsFiltered" => $this->Model_user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_user($id){
		$data = $this->Model_user->get_users($id);
		return $data;
	}

	public function get_data_user_json($id){
		$data = $this->Model_user->get_users($id);
		echo json_encode($data);
	}

	public function add()
	{
        // head data
        $head['title_page'] 	= 'Data Pengguna';
        $head['menu_active'] 	= 'pengguna';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
            'pages_caption' 		=> 'Data Pengguna',
            'data_pos' 				=> $this->Model_posyandu->get_posyandu(),
            'data_role' 			=> $this->Model_user->get_roles(),
            'acton_form' 			=> base_url('pengguna/action_process'),
		    'id' 					=> set_value('id'),
		    'role_id' 				=> set_value('role_id'),
		    'pos_id' 				=> set_value('pos_id'),
		    'username' 				=> set_value('username'),
		    'email' 				=> set_value('email'),
		    'password' 				=> set_value('password'),
		    'nama_user' 			=> set_value('nama_user'),
		    'status_user' 			=> set_value('status_user', 1)
		);

		$this->load->view('template/header', $head);
        $this->load->view('user/user_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_usr = $this->get_data_user($id);
		if (empty($r_usr)) {
			redirect(base_url().'users');
		}

        // head data
        $head['title_page'] 	= 'Ubah Data Pengguna';
        $head['menu_active'] 	= 'pengguna';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
            'pages_caption' 		=> 'Ubah Data Pengguna',
            'acton_form' 			=> base_url('posyandu/action_process'),
            'data_pos' 				=> $this->Model_posyandu->get_posyandu(),
            'data_role' 			=> $this->Model_user->get_roles(),
            'acton_form' 			=> base_url('pengguna/action_process'),
		    'id' 					=> set_value('id', $r_usr->id),
		    'role_id' 				=> set_value('role_id', $r_usr->role_id),
		    'pos_id' 				=> set_value('pos_id', $r_usr->pos_id),
		    'username' 				=> set_value('username', $r_usr->username),
		    'email' 				=> set_value('email', $r_usr->email),
		    'password' 				=> set_value('password'),
		    'nama_user' 			=> set_value('nama_user', $r_usr->nama),
		    'status_user' 			=> set_value('status_user', $r_usr->status)
		);

		$this->load->view('template/header', $head);
        $this->load->view('user/user_forms', $data);
        $this->load->view('template/footer');
	}

	public function action_process() 
	{
		// $hashed_password = password_hash($password, PASSWORD_BCRYPT);
		$save_method 			= $this->input->post('save_method');

		$id 					= $this->Model_global->create_id();
		$role_id 				= $this->input->post('role_id');
		$pos_id 				= $this->input->post('pos_id');
		$username 				= $this->input->post('username');
		$email 					= $this->input->post('email');
		$password 				= $this->input->post('password');
		$nama 					= $this->input->post('nama_user');
		$status 				= ($this->input->post('status_user') ? 1 : 0 );
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		
		if (in_array($role_id, ROLE_ADMIN_CONTROL_NAME_LV1)) {
			$pos_id = null;
		}

		$data = array(
			'role_id' 						=> $role_id,
			'pos_id' 						=> $pos_id,
			'username' 						=> $username,
			'email' 						=> $email,
			'password' 						=> password_hash($password, PASSWORD_BCRYPT),
			'nama' 							=> $nama,
			'status' 						=> $status,
		);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$id 					= $this->Model_global->create_id();
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_user->save($data);
		}elseif ($save_method == 'Ubah') {
			$id 					= $this->input->post('id');
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_user->update(array('id' => $id), $data);
		}

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

	public function delete($id)
	{
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$data = array(
			'updated_by' 					=> $updated_by,
			'updated_on' 					=> $updated_on,
			'deleted' 						=> 1
		);

		$r_usr = $this->get_data_user($id);
		if (empty($r_usr)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_user->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

	public function switch($pos_id = null)
	{
		if ($pos_id == null) {
			$this->session->set_flashdata('message1', '
				<div class="alert alert-warning alert-dismissible show fadeIn animated">
					<div class="alert-body">
					<button class="close" data-dismiss="alert"><span>&times;</span></button>
					<strong>Peringatan</strong><br>Akses di batas
					</div>
				</div>
				');
			redirect(base_url().'dashboard');
			return null;
		}

		if ($pos_id == 'pusat') {
			$data_session = array(
				'pos_id' 	=> '',
				'pos_name' 	=> '',
				'desa_id' 	=> '',
				'desa' 		=> '',
			);
			$this->session->set_userdata($data_session);
			$this->session->set_flashdata('message1', '
				<div class="alert alert-success alert-dismissible show fadeIn animated">
	              <div class="alert-body">
	                <button class="close" data-dismiss="alert"><span>&times;</span></button>
	                <strong>Aktifkan Posyandu</strong><br> Informasi posyandu berganti ke data posyandu <b>Pusat</b>
	              </div>
	            </div>
				');
				redirect(base_url().'dashboard');
			return null;
		}

		$get_pos  	= $this->Model_posyandu->get_posyandu($pos_id);
		if (!empty($get_pos)) {
			$data_session = array(
				'pos_id' 	=> $get_pos->id,
				'pos_name' 	=> $get_pos->nama,
				'desa_id' 	=> $get_pos->desa_id,
				'desa' 		=> $get_pos->desa,
			);
			$this->session->set_userdata($data_session);
			$this->session->set_flashdata('message1', '
				<div class="alert alert-success alert-dismissible show fadeIn animated">
	              <div class="alert-body">
	                <button class="close" data-dismiss="alert"><span>&times;</span></button>
	                <strong>Aktifkan Posyandu</strong><br> Informasi posyandu berganti ke data posyandu <b>'.$get_pos->nama.'</b>
	              </div>
	            </div>
				');
				redirect(base_url().'dashboard');
		}else{
			$this->session->set_flashdata('message1', '
				<div class="alert alert-danger alert-dismissible show fadeIn animated">
					<div class="alert-body">
					<button class="close" data-dismiss="alert"><span>&times;</span></button>
					<strong>Gagal Aktifkan Posyandu</strong><br>Data Posyandu yang dipilih tidak ditemukan!.
					</div>
				</div>
				');
			redirect(base_url().'dashboard');
		}

	}

}