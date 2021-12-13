<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bumil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_bumil','Model_bumil');
		$this->load->model('Model_global','Model_global');

        /* Restrict user */
        if($this->session->userdata('login_status') != "login_active"){
			redirect(base_url().'login');
		}

		if (!in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_SUBLV1)) {
			redirect(base_url().'dashboard');
		}
    }

	public function index()
	{
        // head data
        $head['title_page']     = 'Data Bumil';
        $head['menu_active']    = 'bumil';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Bumil';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('bumil/bumil_views', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_bumil()
	{
		$list = $this->Model_bumil->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_bml) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_bml->nik;
			$row[] = $r_bml->nama_ibu;
			$row[] = $r_bml->nama_bapak;
			$row[] = $r_bml->nama_bayi;
			$row[] = '<div class="text-center">'.$r_bml->tgl_lahir_bayi.'</div>';;
			$row[] = '<div class="text-center">'.$r_bml->jk_bayi.'</div>';
			$row[] = '<div class="text-center">'.( !empty($r_bml->tgl_meninggal_bayi) ? $r_bml->tgl_meninggal_bayi : '-' ).'</div>';
			$row[] = '<div class="text-center">'.( !empty($r_bml->tgl_meninggal_ibu) ? $r_bml->tgl_meninggal_ibu : '-' ).'</div>';
			$row[] = ( !empty($r_bml->keterangan) ? $r_bml->keterangan : '<div class="text-center">-</div>' );

			//add html for action
            // $row[] = '<div class="text-center">
            //                 <a class="btn btn-sm btn-primary" href="'.base_url().'bumil/edit/'.$r_bml->id.'" title="Ubah">
            //                     <i class="fas fa-edit"></i> Ubah</a>
            //                 <a class="btn btn-sm btn-danger" href="javascript:void(0)" 
            //                         title="Hapus"
            //                         onclick="delete_bumil('."'".$r_bml->id."'".')">
            //                         <i class="fas fa-trash"></i> Hapus</a>
            //             </div>';
            $row[] = '<div class="text-center">
                        <div class="btn-group mb-2">
                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.base_url().'bumil/edit/'.$r_bml->id.'" title="Ubah"><i class="fas fa-edit"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_bumil('."'".$r_bml->id."'".')"><i class="fas fa-trash"></i> Hapus</a>
                            <a class="dropdown-item" href="'.base_url().'bumil/detail/'.$r_bml->id.'" title="Detail"><i class="fas fa-info-circle"></i> Detail</a>
                        </div>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_bumil->count_all(),
						"recordsFiltered" => $this->Model_bumil->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_bumil($id){
		$data = $this->Model_bumil->get_by_id($id);
		return $data;
	}

	public function get_data_bumil_json($id){
		$data = $this->Model_bumil->get_by_id($id);
		echo json_encode($data);
	}

    public function cek_data_bumil($nik){
		$data = $this->Model_bumil->get_by_nik($nik);
		return $data;
	}

    public function cek_data_bumil_json($nik){
		$data = $this->Model_bumil->get_by_nik($nik);
		echo json_encode($data);
	}

	public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Bumil';
        $head['menu_active'] 	= 'bumil';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
            'pages_caption' 		=> 'Tambah Bumil',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('bumil/action_process'),
		    'id' 					=> set_value('id'),
		    'pos_id' 				=> set_value('pos_id'),
		    'pos_name' 				=> set_value('pos_name', ( !empty($this->session->userdata('pos_name')) ? $this->session->userdata('pos_name') : "" )),
		    'desa_id' 				=> set_value('desa_id', ( !empty($this->session->userdata('desa_id')) ? $this->session->userdata('desa_id') : "" )),
		    'desa_name' 			=> set_value('desa_name', ( !empty($this->session->userdata('desa')) ? $this->session->userdata('desa') : "" )),
		    'nik' 					=> set_value('nik'),
		    'nama_bapak' 			=> set_value('nama_bapak'),
		    'nama_ibu' 				=> set_value('nama_ibu'),
		    'nama_bayi' 			=> set_value('nama_bayi'),
		    'tgl_lahir_bayi' 		=> set_value('tgl_lahir_bayi'),
		    'jk_bayi' 				=> set_value('jk_bayi'),
		    'tgl_meninggal_bayi' 	=> set_value('tgl_meninggal_bayi'),
		    'tgl_meninggal_ibu' 	=> set_value('tgl_meninggal_ibu'),
		    'keterangan' 			=> set_value('keterangan'),
		    // 'nama_pic' 				=> set_value('nama_pic'),
		);

		$this->load->view('template/header', $head);
        $this->load->view('bumil/bumil_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_bml = $this->get_data_bumil($id);
		if (empty($r_bml)) {
			redirect(base_url().'bumil');
		}

        // head data
        $head['title_page'] 	= 'Ubah Data Bumil';
        $head['menu_active'] 	= 'bumil';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('bumil/action_process'),
		    'id' 					=> set_value('id', $r_bml->id),
			'pos_id' 				=> set_value('pos_id', $r_bml->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_bml->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_bml->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_bml->desa_name),
		    'nik' 					=> set_value('nik', $r_bml->nik),
		    'nama_bapak' 			=> set_value('nama_bapak', $r_bml->nama_bapak),
		    'nama_ibu' 				=> set_value('nama_ibu', $r_bml->nama_ibu),
		    'nama_bayi' 			=> set_value('nama_bayi', $r_bml->nama_bayi),
		    'tgl_lahir_bayi' 		=> set_value('tgl_lahir_bayi', $r_bml->tgl_lahir_bayi),
		    'jk_bayi' 				=> set_value('jk_bayi', $r_bml->jk_bayi),
		    'tgl_meninggal_bayi' 	=> set_value('tgl_meninggal_bayi', $r_bml->tgl_meninggal_bayi),
		    'tgl_meninggal_ibu' 	=> set_value('tgl_meninggal_ibu', $r_bml->tgl_meninggal_ibu),
		    'keterangan' 			=> set_value('keterangan', $r_bml->keterangan),
		);

		$this->load->view('template/header', $head);
        $this->load->view('bumil/bumil_forms', $data);
        $this->load->view('template/footer');
	}

	public function detail($id)
	{
		$r_bml = $this->get_data_bumil($id);
		if (empty($r_bml)) {
			redirect(base_url().'bumil');
		}

        // head data
        $head['title_page'] 	= 'Detail Data Ibu Hamil '.$r_bml->nama_ibu;
        $head['menu_active'] 	= 'bumil';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['aksi'] 			= 'Detail';
        $data['data_bml'] 		= $r_bml;

		$this->load->view('template/header', $head);
        $this->load->view('bumil/bumil_details', $data);
        $this->load->view('template/footer');
	}

	public function action_process() 
	{

		$save_method 			= $this->input->post('save_method');

		$id 					= $this->Model_global->create_id();
		$pos_id 				= $this->input->post('pos_id');
		$pos_name 				= $this->input->post('pos_name');
		$desa_id 				= $this->input->post('desa_id');
		$desa_name 				= $this->input->post('desa_name');
		$nik 					= $this->input->post('nik');
		$nama_bapak 			= $this->input->post('nama_bapak');
		$nama_ibu 				= $this->input->post('nama_ibu');
		$nama_bayi 				= $this->input->post('nama_bayi');
		$tgl_lahir_bayi 		= $this->input->post('tgl_lahir_bayi');
		$jk_bayi 				= $this->input->post('jk_bayi');
		$tgl_meninggal_bayi 	= ($this->input->post('status_meninggal_bayi') ? $this->input->post('tgl_meninggal_bayi') : null );
		$tgl_meninggal_ibu 		= ($this->input->post('status_meninggal_ibu') ? $this->input->post('tgl_meninggal_ibu') : null );
		$keterangan 			= $this->input->post('keterangan');
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$data = array(
			'pos_id' 					=> $pos_id,
			'pos_name' 					=> $pos_name,
			'desa_id' 					=> $desa_id,
			'desa_name' 				=> $desa_name,
			'nik' 						=> $nik,
			'nama_bapak' 				=> $nama_bapak,
			'nama_ibu' 					=> $nama_ibu,
			'nama_bayi' 				=> $nama_bayi,
			'tgl_lahir_bayi' 			=> $tgl_lahir_bayi,
			'jk_bayi' 					=> $jk_bayi,
			'tgl_meninggal_bayi' 		=> $tgl_meninggal_bayi,
			'tgl_meninggal_ibu' 		=> $tgl_meninggal_ibu,
			'keterangan' 				=> $keterangan,
			'nama_pic' 					=> $nama_pic,
		);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$id 					= $this->Model_global->create_id();
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bumil->save($data);
		}elseif ($save_method == 'Ubah') {
			$id 					= $this->input->post('id');
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bumil->update(array('id' => $id), $data);
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

		$r_bml = $this->get_data_bumil($id);
		if (empty($r_bml)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_bumil->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

}