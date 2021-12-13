<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // model use
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_global','Model_global');
		$this->load->model('Model_posyandu','Model_posyandu');
		
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
        // head data
        $head['title_page'] = 'Data Master Desa';
        $head['menu_active'] = 'desa';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption'] = 'Data Master Desa';
        
		$this->load->view('template/header', $head);
        $this->load->view('desa/desa_views', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_desa()
	{
		// $this->load->helper('url');

		$list = $this->Model_desa->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_desa) {
			$no++;
			$row = array();

			
			if ($r_desa->status == 1) {
				$status = '<span class="badge badge-primary">Aktif</span>';
			}else{
				$status = '<span class="badge badge-danger">Nonaktif</span>';
			}

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_desa->nama;
			$row[] = '<div class="text-center">'.$status.'</div>';

			//add html for action
			$row[] = '<div class="text-center">
				  		<a class="btn btn-sm btn-primary" href="'.base_url().'desa/edit/'.$r_desa->id.'" title="Ubah">
							<i class="fas fa-edit"></i> Ubah</a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
						  title="Hapus" onclick="delete_desa('."'".$r_desa->id."'".')">
					  	  	<i class="fas fa-trash"></i> Hapus</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_desa->count_all(),
						"recordsFiltered" => $this->Model_desa->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_desa($id){
		$data = $this->Model_desa->get_by_id($id);
		return $data;
	}

	public function get_data_desa_json($id){
		$data = $this->Model_desa->get_by_id($id);
		echo json_encode($data);
	}

	public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Data Desa';
        $head['menu_active'] 	= 'desa';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
            'pages_caption' 		=> 'Tambah Data Desa',
            'acton_form' 			=> base_url('desa/action_process'),
		    'id' 					=> set_value('id'),
		    'nama_desa' 			=> set_value('nama_desa'),
		    'status_desa' 			=> set_value('status_desa', 1)
		);

		$this->load->view('template/header', $head);
        $this->load->view('desa/desa_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_desa = $this->get_data_desa($id);
		if (empty($r_desa)) {
			redirect(base_url().'desa');
		}

        // head data
        $head['title_page'] 	= 'Ubah Data Desa';
        $head['menu_active'] 	= 'desa';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
            'pages_caption' 		=> 'Ubah Data Desa',
            'acton_form' 			=> base_url('desa/action_process'),
		    'id' 					=> set_value('id', $r_desa->id),
		    'nama_desa' 			=> set_value('nama_desa', $r_desa->nama),
		    'status_desa' 			=> set_value('status_desa', $r_desa->status)
		);

		$this->load->view('template/header', $head);
        $this->load->view('desa/desa_forms', $data);
        $this->load->view('template/footer');
	}

	public function action_process() 
	{

		$save_method 			= $this->input->post('save_method');

		$id 					= $this->Model_global->create_id();
		$nama 					= $this->input->post('nama_desa');
		$status 				= ($this->input->post('status_desa') ? 1 : 0 );
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$data = array(
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
			$save = $this->Model_desa->save($data);
		}elseif ($save_method == 'Ubah') {
			$id 					= $this->input->post('id');
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_desa->update(array('id' => $id), $data);
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

		$r_desa = $this->get_data_desa($id);
		if (empty($r_desa)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_desa->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}


}
