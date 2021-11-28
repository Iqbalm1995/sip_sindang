<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posyandu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // model use
		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
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
        // head data
        $head['title_page'] = 'Data Master Posyandu';
        $head['menu_active'] = 'posyandu';

        // body data
        $data['pages_caption'] = 'Data Master Posyandu';
        
		$this->load->view('template/header', $head);
        $this->load->view('posyandu/posyandu_views', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_posyandu()
	{
		// $this->load->helper('url');

		$list = $this->Model_posyandu->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_pos) {
			$no++;
			$row = array();

			if ($r_pos->status == 1) {
				$status = '<span class="badge badge-primary">Aktif</span>';
			}else{
				$status = '<span class="badge badge-danger">Nonaktif</span>';
			}

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_pos->nama;
			$row[] = $r_pos->desa;
			$row[] = '<div class="text-center">'.$status.'</div>';

			//add html for action
			$row[] = '<div class="text-center">
						<a class="btn btn-sm btn-primary" href="'.base_url().'posyandu/edit/'.$r_pos->id.'" title="Ubah">
							<i class="fas fa-edit"></i> Ubah</a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	title="Hapus"
					  	  	onclick="delete_posyandu('."'".$r_pos->id."'".')">
					  	  	<i class="fas fa-trash"></i> Hapus</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_posyandu->count_all(),
						"recordsFiltered" => $this->Model_posyandu->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_posyandu($id){
		$data = $this->Model_posyandu->get_by_id($id);
		return $data;
	}

	public function get_data_posyandu_json($id){
		$data = $this->Model_posyandu->get_by_id($id);
		echo json_encode($data);
	}

	public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Data Posyandu';
        $head['menu_active'] 	= 'posyandu';

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
            'pages_caption' 		=> 'Tambah Data Posyandu',
            'data_desa' 			=> $this->Model_desa->get_desa(),
            'acton_form' 			=> base_url('posyandu/action_process'),
		    'id' 					=> set_value('id'),
		    'desa_id' 				=> set_value('desa_id'),
		    'nama_pos' 				=> set_value('nama_pos'),
		    'status_pos' 			=> set_value('status_pos', 1)
		);

		$this->load->view('template/header', $head);
        $this->load->view('posyandu/posyandu_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_pos = $this->get_data_posyandu($id);
		if (empty($r_pos)) {
			redirect(base_url().'posyandu');
		}

        // head data
        $head['title_page'] 	= 'Ubah Data Posyandu';
        $head['menu_active'] 	= 'posyandu';

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
            'pages_caption' 		=> 'Ubah Data Posyandu',
            'acton_form' 			=> base_url('posyandu/action_process'),
            'data_desa' 			=> $this->Model_desa->get_desa(),
		    'id' 					=> set_value('id', $r_pos->id),
			'desa_id' 				=> set_value('desa_id', $r_pos->desa_id),
		    'nama_pos' 				=> set_value('nama_pos', $r_pos->nama),
		    'status_pos' 			=> set_value('status_pos', $r_pos->status)
		);

		$this->load->view('template/header', $head);
        $this->load->view('posyandu/posyandu_forms', $data);
        $this->load->view('template/footer');
	}

	public function action_process() 
	{

		$save_method 			= $this->input->post('save_method');

		$id 					= $this->Model_global->create_id();
		$nama 					= $this->input->post('nama_pos');
		$desa_id 				= $this->input->post('desa_pos');
		$status 				= ($this->input->post('status_pos') ? 1 : 0 );
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$data = array(
			'desa_id' 						=> $desa_id,
			'nama' 							=> $nama,
			'status' 						=> $status,
		);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$id 			= $this->Model_global->create_id();
			$data['id'] 	= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_posyandu->save($data);
		}elseif ($save_method == 'Ubah') {
			$id 					= $this->input->post('id');
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_posyandu->update(array('id' => $id), $data);
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

		$r_pos = $this->get_data_posyandu($id);
		if (empty($r_pos)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_posyandu->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

}
