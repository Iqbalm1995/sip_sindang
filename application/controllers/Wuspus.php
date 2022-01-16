<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wuspus extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_wuspus','Model_wuspus');
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
        $head['title_page']     = 'Data Wus Pus';
        $head['menu_active']    = 'wuspus';
        $head['subMenu_active'] = 'wuspus_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Wus Pus';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('wuspus/wuspus_views', $data);
        $this->load->view('template/footer');
	}

	public function layanan()
	{
        // head data
        $head['title_page']     = 'Layanan Wus Pus';
        $head['menu_active']    = 'wuspus';
        $head['subMenu_active'] = 'wuspus_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Layanan Wus Pus';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('wuspus/wuspus_layanan_views', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_wuspus()
	{
		$list = $this->Model_wuspus->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_wps) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_wps->kms;
			$row[] = $r_wps->nama;
			$row[] = '<div class="text-center">'.$r_wps->umur.'</div>';
			$row[] = $r_wps->suami_pus;
			$row[] = '<div class="text-center">'.$r_wps->kel_dawis.'</div>';
			$row[] = '<div class="text-center">'.$r_wps->jml_anak_hidup.'</div>';
			$row[] = '<div class="text-center">'.$r_wps->jml_anak_meninggal.'</div>';

            $row[] = '<div class="text-center">
                        <div class="btn-group mb-2">
                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.base_url().'wuspus/edit/'.$r_wps->id.'" title="Ubah"><i class="fas fa-edit"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_wuspus('."'".$r_wps->id."'".')"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_wuspus->count_all(),
						"recordsFiltered" => $this->Model_wuspus->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function datatable_layanan_wuspus()
	{
		$list = $this->Model_wuspus->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_wps) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_wps->kms;
			$row[] = $r_wps->nama;
			$row[] = '<div class="text-center">'.$r_wps->umur.'</div>';

            
            $row[] = '<div class="text-center">
						<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Update Layanan" onclick="layanan_pos('."'".$r_wps->id."'".')"><i class="fas fa-comment-medical"></i> Layanan Posyandu</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_wuspus->count_all(),
						"recordsFiltered" => $this->Model_wuspus->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_wuspus($id){
		$data = $this->Model_wuspus->get_by_id($id);
		return $data;
	}

	public function get_data_wuspus_json($id){
		$data = $this->Model_wuspus->get_by_id($id);
		echo json_encode($data);
	}

    public function cek_data_wuspus($kms){
		$data = $this->Model_wuspus->get_by_kms($kms);
		return $data;
	}

    public function cek_data_wuspus_json($kms){
		$data = $this->Model_wuspus->get_by_kms($kms);
		echo json_encode($data);
	}

    public function get_total_data_json(){
		$tahun = $this->input->post('filterYear');
		if (empty($tahun)) {
			$tahun = date('Y');
		}
		
		$dataTotal = array(
			'total_wuspus' => (int)$this->Model_wuspus->get_total_data_wuspus($tahun), 
			'total_anak_hidup' => (int)$this->Model_wuspus->get_total_anak_wuspus($tahun)->total_anak_hidup, 
			'total_anak_meninggal' => (int)$this->Model_wuspus->get_total_anak_wuspus($tahun)->total_anak_meninggal, 
		);
		echo json_encode($dataTotal);
	}

    public function get_statistik_wuspus_json(){
		$tahun = $this->input->post('filterYear');
		$data = $this->Model_wuspus->get_kunjungan_wuspus_total($tahun);
		echo json_encode($data);
	}

    
	public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Wus Pus';
        $head['menu_active'] 	= 'wuspus';
        $head['subMenu_active'] = 'wuspus_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
            'pages_caption' 		=> 'Tambah Wus Pus',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('wuspus/action_process'),
		    'id' 					=> set_value('id'),
		    'pos_id' 				=> set_value('pos_id'),
		    'pos_name' 				=> set_value('pos_name', ( !empty($this->session->userdata('pos_name')) ? $this->session->userdata('pos_name') : "" )),
		    'desa_id' 				=> set_value('desa_id', ( !empty($this->session->userdata('desa_id')) ? $this->session->userdata('desa_id') : "" )),
		    'desa_name' 			=> set_value('desa_name', ( !empty($this->session->userdata('desa')) ? $this->session->userdata('desa') : "" )),
		    'kms' 					=> set_value('kms'),
		    'nama' 			        => set_value('nama'),
		    'umur' 				    => set_value('umur'),
		    'suami_pus' 			=> set_value('suami_pus'),
		    'taha_kan_ks' 		    => set_value('taha_kan_ks'),
		    'kel_dawis' 		    => set_value('kel_dawis'),
		    'jml_anak_hidup' 	    => set_value('jml_anak_hidup', 0),
		    'jml_anak_meninggal' 	=> set_value('jml_anak_meninggal', 0),
		    // 'nama_pic' 				=> set_value('nama_pic'),
		);

		$this->load->view('template/header', $head);
        $this->load->view('wuspus/wuspus_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_wps = $this->get_data_wuspus($id);
		if (empty($r_wps)) {
			redirect(base_url().'wuspus');
		}

        // head data
        $head['title_page'] 	= 'Ubah Data Wus Pus';
        $head['menu_active'] 	= 'wuspus';
        $head['subMenu_active'] = 'wuspus_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('wuspus/action_process'),
		    'id' 					=> set_value('id', $r_wps->id),
			'pos_id' 				=> set_value('pos_id', $r_wps->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_wps->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_wps->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_wps->desa_name),
            'kms' 					=> set_value('kms', $r_wps->kms),
		    'nama' 			        => set_value('nama', $r_wps->nama),
		    'umur' 				    => set_value('umur', $r_wps->umur),
		    'suami_pus' 			=> set_value('suami_pus', $r_wps->suami_pus),
		    'taha_kan_ks' 		    => set_value('taha_kan_ks', $r_wps->taha_kan_ks),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_wps->kel_dawis),
		    'jml_anak_hidup' 	    => set_value('jml_anak_hidup', $r_wps->jml_anak_hidup),
		    'jml_anak_meninggal' 	=> set_value('jml_anak_meninggal', $r_wps->jml_anak_meninggal),
		);

		$this->load->view('template/header', $head);
        $this->load->view('wuspus/wuspus_forms', $data);
        $this->load->view('template/footer');
	}

    public function update_layanan($id, $year = null)
	{
		if (empty($id)) {
			redirect(base_url().'wuspus/layanan');
			return null;
		}

		if ($year == null) {
			$year = date('Y');
		}

		$r_wps = $this->get_data_wuspus($id);
		if (empty($r_wps)) {
			redirect(base_url().'wuspus');
		}

        // head data
        $head['title_page'] 	= 'Ubah Layanan Wus Pus';
        $head['menu_active'] 	= 'wuspus';
        $head['subMenu_active'] = 'wuspus_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Update Layanan  Wus Pus';

		// body data
		$data = array(
			'aksi' 					=> 'Ubah',
			'year_assign'			=> $year,
			'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
		    'data_kunjugan' 		=> $this->Model_wuspus->get_kunjugan_wuspus($id, $year),
		    'id' 					=> set_value('id', $r_wps->id),
			'pos_id' 				=> set_value('pos_id', $r_wps->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_wps->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_wps->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_wps->desa_name),
            'kms' 					=> set_value('kms', $r_wps->kms),
		    'nama' 			        => set_value('nama', $r_wps->nama),
		    'umur' 				    => set_value('umur', $r_wps->umur),
		    'suami_pus' 			=> set_value('suami_pus', $r_wps->suami_pus),
		    'taha_kan_ks' 		    => set_value('taha_kan_ks', $r_wps->taha_kan_ks),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_wps->kel_dawis),
		    'jml_anak_hidup' 	    => set_value('jml_anak_hidup', $r_wps->jml_anak_hidup),
		    'jml_anak_meninggal' 	=> set_value('jml_anak_meninggal', $r_wps->jml_anak_meninggal),
		    'umur_anak_meninggal' 	=> set_value('umur_anak_meninggal', $r_wps->umur_anak_meninggal),
		    'lila' 	                => set_value('lila', $r_wps->lila),
		    'pyd_kapsul_yodium' 	=> set_value('pyd_kapsul_yodium', $r_wps->pyd_kapsul_yodium),
		    'pyd_imsi1' 	        => set_value('pyd_imsi1', $r_wps->pyd_imsi1),
		    'pyd_imsi2' 	        => set_value('pyd_imsi2', $r_wps->pyd_imsi2),
		    'pyd_imsi_lengkap'     	=> set_value('pyd_imsi_lengkap', $r_wps->pyd_imsi_lengkap),
		    'kb_kontrasepsi' 	    => set_value('kb_kontrasepsi', $r_wps->kb_kontrasepsi),
		    'kb_pgn_tgl' 	        => set_value('kb_pgn_tgl', $r_wps->kb_pgn_tgl),
		    'kb_pgn_jenis' 	        => set_value('kb_pgn_jenis', $r_wps->kb_pgn_jenis),
		);
        
		$this->load->view('template/header', $head);
        $this->load->view('wuspus/wuspus_layanan_forms', $data);
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
		$kms 					= $this->input->post('kms');
		$nama 			        = $this->input->post('nama');
		$umur 				    = $this->input->post('umur');
		$taha_kan_ks 			= $this->input->post('taha_kan_ks');
		$suami_pus 				= $this->input->post('suami_pus');
		$kel_dawis 				= $this->input->post('kel_dawis');
		$jml_anak_hidup 		= $this->input->post('jml_anak_hidup');
		$jml_anak_meninggal 	= $this->input->post('jml_anak_meninggal');
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
			'kms' 						=> $kms,
			'nama' 				        => ucwords($nama),
			'umur' 						=> $umur,
			'suami_pus' 			    => ucwords($suami_pus),
			'kel_dawis' 				=> $kel_dawis,
			'jml_anak_hidup' 			=> $jml_anak_hidup,
			'jml_anak_meninggal' 		=> $jml_anak_meninggal,
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
			$save = $this->Model_wuspus->save($data);
		}elseif ($save_method == 'Ubah') {
			$id 					= $this->input->post('id');
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_wuspus->update(array('id' => $id), $data);
		}

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

    public function action_process_services()
	{
		$save_method 			= $this->input->post('save_method');

		if ($save_method != 'Ubah') {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return FALSE;
		}

		$id 					= $this->input->post('id');
		$year_assign 			= $this->input->post('year_assign');

        $jml_anak_hidup 		= $this->input->post('jml_anak_hidup');
        $jml_anak_meninggal 	= $this->input->post('jml_anak_meninggal');
        $umur_anak_meninggal 	= $this->input->post('umur_anak_meninggal');
        $lila 				    = $this->input->post('lila');
        
        $pyd_kapsul_yodium 	    = ($this->input->post('status_pyd_kapsul_yodium') ? $this->input->post('pyd_kapsul_yodium') : null );
        $pyd_imsi1 	            = ($this->input->post('status_pyd_imsi1') ? $this->input->post('pyd_imsi1') : null );
        $pyd_imsi2 	            = ($this->input->post('status_pyd_imsi2') ? $this->input->post('pyd_imsi2') : null );
        $pyd_imsi_lengkap 	    = ($this->input->post('status_pyd_imsi_lengkap') ? $this->input->post('pyd_imsi_lengkap') : null );
        $kb_pgn_tgl 	        = ($this->input->post('status_kb_pgn_tgl') ? $this->input->post('kb_pgn_tgl') : null );
        $kb_kontrasepsi 		= $this->input->post('kb_kontrasepsi');
        $kb_pgn_jenis 			= $this->input->post('kb_pgn_jenis');
		
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$kunjungan_wuspus_bln 	= $_POST["kunjungan_wuspus_bln"];
        $kunjungan_wuspus_thn 	= $_POST["kunjungan_wuspus_thn"];
        $kunjungan_val 			= $_POST["kunjungan_val"];
        $keterangan 			= $_POST["keterangan"];

		$data = array(
			'jml_anak_hidup' 			=> $jml_anak_hidup,
			'jml_anak_meninggal' 		=> $jml_anak_meninggal,
			'umur_anak_meninggal' 		=> $umur_anak_meninggal,
			'lila' 		                => $lila,
			'pyd_kapsul_yodium' 		=> $pyd_kapsul_yodium,
			'pyd_imsi1' 		        => $pyd_imsi1,
			'pyd_imsi2' 		        => $pyd_imsi2,
			'pyd_imsi_lengkap' 		    => $pyd_imsi_lengkap,
			'kb_pgn_tgl' 		        => $kb_pgn_tgl,
			'kb_kontrasepsi' 			=> (!empty($kb_kontrasepsi) ? ucwords($kb_kontrasepsi) : null),
			'kb_pgn_jenis' 				=> (!empty($kb_pgn_jenis) ? ucwords($kb_pgn_jenis) : null),
		);

		if (count($kunjungan_wuspus_bln) > 0) {

            for ($i=0; $i < count($kunjungan_wuspus_bln) ; $i++) { 
                $data_kunjungan[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'wuspus_id'             => $id, 
                    'bulan'                 => $kunjungan_wuspus_bln[$i], 
                    'tahun'                 => $kunjungan_wuspus_thn[$i], 
                    'is_kunjungan'       	=> (!empty($kunjungan_val[$i])? $kunjungan_val[$i] : 0 ), 
                    'keterangan'        	=> (!empty($keterangan[$i])? $keterangan[$i] : null), 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

            }
        }

        $clear_kunjungan_wuspus 		= $this->Model_wuspus->clear_kunjungan_data_wuspus($id, $year_assign);

		$save = FALSE;
		$data['id'] 			= $id;
		$data['updated_by'] 	= $updated_by;
		$data['updated_on'] 	= $updated_on;
		$save = $this->Model_wuspus->update(array('id' => $id), $data);
		$save_kunjungan_wuspus = $this->Model_wuspus->save_kunjungan($data_kunjungan);

		$data['clear_kunjungan_wuspus'] 	= $clear_kunjungan_wuspus;
		$data['data_kunjungan'] 		    = $data_kunjungan;
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

		$r_wps = $this->get_data_wuspus($id);
		if (empty($r_wps)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_wuspus->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

}