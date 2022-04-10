<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bumlin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_bumlin','Model_bumlin');
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
        $head['title_page']     = 'Data Bumil Dan Bulin';
        $head['menu_active']    = 'bumlin';
        $head['subMenu_active'] = 'bumlin_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Bumil Dan Bulin';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('bumlin/bumlin_views', $data);
        $this->load->view('template/footer');
	}

	public function layanan()
	{
        // head data
        $head['title_page']     = 'Layanan Bumil Dan Bulin';
        $head['menu_active']    = 'bumlin';
        $head['subMenu_active'] = 'bumlin_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Layanan Bumil Dan Bulin';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('bumlin/bumlin_layanan_views', $data);
        $this->load->view('template/footer');
	}

	public function export($tahun = null, $bulan = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}

		if ($bulan == null) {
			$bulan = date('m');
		}

		$pos_name 	= $this->session->userdata('pos_name');
		$desa_name 	= $this->session->userdata('desa');

		$list = $this->Model_bumlin->get_laporan_bumlin($tahun, $bulan);

        // $data['title'] 			= "Laporan Data Bumil Posyandu ".$pos_name." di desa ".$desa_name ;
		
		$data['pos_name'] 		= $this->session->userdata('pos_name');
		$data['desa_name'] 		= $this->session->userdata('desa');

        $data_report 		= array();
        $no    	 			= 0;

		if(!empty($list))
		{
			foreach ($list as $r) {
                $no++;
                $row    = array();
                $row['no']  					= $no;
                $row['kms']          			= $r->kms;
                $row['nama_bumil']          	= $r->nama_bumil;
                $row['umur']        			= $r->umur;
                $row['kel_dawis']        		= $r->kel_dawis;
                $row['tgl_pendaftaran']         = $r->tgl_pendaftaran;
                $row['umur_kehamilan']      	= $r->umur_kehamilan;
                $row['hamil_ke']       			= $r->hamil_ke;
                $row['pyd_ptdh_fe1']      		= $r->pyd_ptdh_fe1;
                $row['pyd_ptdh_fe2']      		= $r->pyd_ptdh_fe2;
                $row['pyd_ptdh_fe3']      		= $r->pyd_ptdh_fe3;
                $row['pyd_imsi1']      			= $r->pyd_imsi1;
                $row['pyd_imsi2']      			= $r->pyd_imsi2;
                $row['pyd_kapsul_yodium']      	= $r->pyd_kapsul_yodium;
                $row['pyd_resiko']      		= $r->pyd_resiko;
                $row['lahir_tanggal']      		= $r->lahir_tanggal;
                $row['bayi_jk']      			= $r->bayi_jk;
                $row['lahir_pic']      			= $r->lahir_pic;
                $row['bayi_berat']      		= $r->bayi_berat;
                $row['bayi_meninggal']      	= $r->bayi_meninggal;
                $row['ibu_meninggal']      		= $r->ibu_meninggal;
                $row['ibu_menyusui']      		= $r->ibu_menyusui;

                $row['r01_darah']      			= $r->r01_darah;
                $row['r01_berat']      			= $r->r01_berat;
                $row['r02_darah']      			= $r->r02_darah;
                $row['r02_berat']      			= $r->r02_berat;
                $row['r03_darah']      			= $r->r03_darah;
                $row['r03_berat']      			= $r->r03_berat;
                $row['r04_darah']      			= $r->r04_darah;
                $row['r04_berat']      			= $r->r04_berat;
                $row['r05_darah']      			= $r->r05_darah;
                $row['r05_berat']      			= $r->r05_berat;
                $row['r06_darah']      			= $r->r06_darah;
                $row['r06_berat']      			= $r->r06_berat;
                $row['r07_darah']      			= $r->r07_darah;
                $row['r07_berat']      			= $r->r07_berat;
                $row['r08_darah']      			= $r->r08_darah;
                $row['r08_berat']      			= $r->r08_berat;
                $row['r09_darah']      			= $r->r09_darah;
                $row['r09_berat']      			= $r->r09_berat;
                $row['r10_darah']      			= $r->r10_darah;
                $row['r10_berat']      			= $r->r10_berat;
                $row['r11_darah']      			= $r->r11_darah;
                $row['r11_berat']      			= $r->r11_berat;
                $row['r12_darah']      			= $r->r12_darah;
                $row['r12_berat']      			= $r->r12_berat;
				
                $data_report[]              	= $row;
            }
		}

		
        $data['filterBulan'] = ARRAY_BULAN[$bulan];
        $data['filterTahun'] = $tahun;
        $data['report'] = $data_report;

		// echo "<pre>";
		// print_r($list);
		// echo "</pre>";

        $this->load->view('bumlin/bumlin_export', $data);

	}

    public function datatable_list_bumlin()
	{
		$list = $this->Model_bumlin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_bmn) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_bmn->kms;
			$row[] = '<div class="text-center">'.$r_bmn->tgl_pendaftaran.'</div>';
			$row[] = $r_bmn->nama_bumil;
			$row[] = '<div class="text-center">'.$r_bmn->umur.'</div>';
			$row[] = '<div class="text-center">'.$r_bmn->kel_dawis.'</div>';

            $row[] = '<div class="text-center">
                        <div class="btn-group mb-2">
                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.base_url().'bumlin/edit/'.$r_bmn->id.'" title="Ubah"><i class="fas fa-edit"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_bumlin('."'".$r_bmn->id."'".')"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_bumlin->count_all(),
						"recordsFiltered" => $this->Model_bumlin->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function datatable_layanan_bumlin()
	{
		$list = $this->Model_bumlin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_bmn) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_bmn->kms;
			$row[] = '<div class="text-center">'.$r_bmn->tgl_pendaftaran.'</div>';
			$row[] = $r_bmn->nama_bumil;
			$row[] = '<div class="text-center">'.$r_bmn->umur.'</div>';
			$row[] = '<div class="text-center">'.( $r_bmn->pyd_resiko == 1 ? '<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Beresiko<span>' : '-' ).'</div>';

            
            $row[] = '<div class="text-center">
						<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Update Layanan" onclick="layanan_pos('."'".$r_bmn->id."'".')"><i class="fas fa-comment-medical"></i> Layanan Posyandu</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_bumlin->count_all(),
						"recordsFiltered" => $this->Model_bumlin->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function get_total_data_json(){
		$tahun = $this->input->post('filterYear');
		if (empty($tahun)) {
			$tahun = date('Y');
		}
		
		$dataTotal = array(
			'total_bumlin' 			=> (int)$this->Model_bumlin->get_total_data_bumlin($tahun), 
			'total_melahirkan' 		=> (int)$this->Model_bumlin->get_total_data_melahirkan($tahun), 
			'total_beresiko'		=> (int)$this->Model_bumlin->get_total_data_beresiko($tahun), 
			'total_ibu_meninggal' 	=> (int)$this->Model_bumlin->get_total_data_ibu_meninggal($tahun), 
			'total_bayi_meninggal' 	=> (int)$this->Model_bumlin->get_total_data_bayi_meninggal($tahun), 
		);
		echo json_encode($dataTotal);
	}

	public function get_data_bumlin($id){
		$data = $this->Model_bumlin->get_by_id($id);
		return $data;
	}

	public function get_data_bumlin_json($id){
		$data = $this->Model_bumlin->get_by_id($id);
		echo json_encode($data);
	}

    public function cek_data_bumlin($kms){
		$data = $this->Model_bumlin->get_by_kms($kms);
		return $data;
	}

    public function cek_data_bumlin_json($kms){
		$data = $this->Model_bumlin->get_by_kms($kms);
		echo json_encode($data);
	}

    public function get_statistik_bumlin_json(){
		$tahun = $this->input->post('filterYear');
		$data = $this->Model_bumlin->get_kunjungan_bumlin_total($tahun);
		echo json_encode($data);
	}

    public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Bumil Dan Bulin';
        $head['menu_active'] 	= 'bumlin';
        $head['subMenu_active'] = 'bumlin_data';
        $head['pos_session']    = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
            'pages_caption' 		=> 'Tambah Bumil Dan Bulin',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('bumlin/action_process'),
		    'id' 					=> set_value('id'),
		    'pos_id' 				=> set_value('pos_id'),
		    'pos_name' 				=> set_value('pos_name', ( !empty($this->session->userdata('pos_name')) ? $this->session->userdata('pos_name') : "" )),
		    'desa_id' 				=> set_value('desa_id', ( !empty($this->session->userdata('desa_id')) ? $this->session->userdata('desa_id') : "" )),
		    'desa_name' 			=> set_value('desa_name', ( !empty($this->session->userdata('desa')) ? $this->session->userdata('desa') : "" )),
		    'kms' 					=> set_value('kms'),
		    'nama_bumil' 			=> set_value('nama_bumil'),
		    'umur' 				    => set_value('umur'),
		    'tgl_pendaftaran' 	    => set_value('tgl_pendaftaran'),
		    'kel_dawis' 		    => set_value('kel_dawis'),
		    'tgl_daftar' 			=> set_value('tgl_daftar'),
		);

		$this->load->view('template/header', $head);
        $this->load->view('bumlin/bumlin_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_bmn = $this->get_data_bumlin($id);
		if (empty($r_bmn)) {
			redirect(base_url().'bumlin');
		}

        // head data
        $head['title_page'] 	= 'Ubah Data Bumil Dan Bulin';
        $head['menu_active'] 	= 'bumlin';
        $head['subMenu_active'] = 'bumlin_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('bumlin/action_process'),
		    'id' 					=> set_value('id', $r_bmn->id),
			'pos_id' 				=> set_value('pos_id', $r_bmn->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_bmn->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_bmn->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_bmn->desa_name),
            'kms' 					=> set_value('kms', $r_bmn->kms),
		    'nama_bumil' 			=> set_value('nama_bumil', $r_bmn->nama_bumil),
		    'umur' 				    => set_value('umur', $r_bmn->umur),
		    'tgl_pendaftaran' 		=> set_value('tgl_pendaftaran', $r_bmn->tgl_pendaftaran),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_bmn->kel_dawis),
		    'tgl_daftar' 		    => set_value('tgl_daftar', $r_bmn->tgl_daftar),
		);

		$this->load->view('template/header', $head);
        $this->load->view('bumlin/bumlin_forms', $data);
        $this->load->view('template/footer');
	}

    public function update_layanan($id, $year = null)
	{
		if (empty($id)) {
			redirect(base_url().'bumlin/layanan');
			return null;
		}

		if ($year == null) {
			$year = date('Y');
		}

		$r_bmn = $this->get_data_bumlin($id);
		if (empty($r_bmn)) {
			redirect(base_url().'bumlin');
		}

        // head data
        $head['title_page'] 	= 'Ubah Layanan Bumil Dan Bulin';
        $head['menu_active'] 	= 'bumlin';
        $head['subMenu_active'] = 'bumlin_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Update Layanan Bumil Dan Bulin';
		
		// body data
		$data = array(
			'aksi' 					=> 'Ubah',
			'year_assign'			=> $year,
			'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
			'get_pic_melahirkan'    => $this->Model_global->get_pic_melahirkan(),
		    'data_kunjugan' 		=> $this->Model_bumlin->get_kunjugan_bumlin($id, $year),
		    'data_pemeriksaan' 		=> $this->Model_bumlin->get_pemeriksaan_bumlin($id, $year),
		    'id' 					=> set_value('id', $r_bmn->id),
			'pos_id' 				=> set_value('pos_id', $r_bmn->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_bmn->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_bmn->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_bmn->desa_name),
            'kms' 					=> set_value('kms', $r_bmn->kms),
		    'nama_bumil' 			=> set_value('nama_bumil', $r_bmn->nama_bumil),
		    'umur' 				    => set_value('umur', $r_bmn->umur),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_bmn->kel_dawis),
		    'tgl_pendaftaran' 	    => set_value('tgl_pendaftaran', $r_bmn->tgl_pendaftaran),
		    'umur_kehamilan' 		=> set_value('umur_kehamilan', $r_bmn->umur_kehamilan),
		    'hamil_ke' 	            => set_value('hamil_ke', $r_bmn->hamil_ke),
		    'pyd_ptdh_fe1' 	        => set_value('pyd_ptdh_fe1', $r_bmn->pyd_ptdh_fe1),
		    'pyd_ptdh_fe2' 	        => set_value('pyd_ptdh_fe2', $r_bmn->pyd_ptdh_fe2),
		    'pyd_ptdh_fe3' 	        => set_value('pyd_ptdh_fe3', $r_bmn->pyd_ptdh_fe3),
		    'pyd_imsi1' 	        => set_value('pyd_imsi1', $r_bmn->pyd_imsi1),
		    'pyd_imsi2' 	        => set_value('pyd_imsi2', $r_bmn->pyd_imsi2),
		    'pyd_kapsul_yodium' 	=> set_value('pyd_kapsul_yodium', $r_bmn->pyd_kapsul_yodium),
		    'pyd_resiko' 	        => set_value('pyd_resiko', $r_bmn->pyd_resiko),
		    'lahir_tanggal'     	=> set_value('lahir_tanggal', $r_bmn->lahir_tanggal),
		    'lahir_pic' 	        => set_value('lahir_pic', $r_bmn->lahir_pic),
		    'bayi_berat' 	        => set_value('bayi_berat', $r_bmn->bayi_berat),
		    'bayi_jk' 	        	=> set_value('bayi_jk', ($r_bmn->bayi_jk == null ? "L" : $r_bmn->bayi_jk )),
		    'bayi_meninggal' 	    => set_value('bayi_meninggal', $r_bmn->bayi_meninggal),
		    'ibu_meninggal' 	    => set_value('ibu_meninggal', $r_bmn->ibu_meninggal),
		    'ibu_menyusui' 	        => set_value('ibu_menyusui', $r_bmn->ibu_menyusui),
		    'nama_pic' 	            => set_value('nama_pic', $r_bmn->nama_pic),
		    'tgl_daftar' 	        => set_value('tgl_daftar', $r_bmn->tgl_daftar),
		);
        
		$this->load->view('template/header', $head);
        $this->load->view('bumlin/bumlin_layanan_forms', $data);
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
		$nama_bumil 			= $this->input->post('nama_bumil');
		$umur 				    = $this->input->post('umur');
		$tgl_pendaftaran 		= $this->input->post('tgl_daftar');
		$kel_dawis 				= $this->input->post('kel_dawis');
		$tgl_daftar 			= $this->input->post('tgl_daftar');
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
			'nama_bumil' 				=> ucwords($nama_bumil),
			'umur' 						=> $umur,
			'tgl_pendaftaran' 			=> $tgl_daftar,
			'kel_dawis' 				=> $kel_dawis,
			'nama_pic' 					=> $nama_pic,
			'tgl_daftar' 				=> $tgl_daftar,
		);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$id 					= $this->Model_global->create_id();
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bumlin->save($data);
		}elseif ($save_method == 'Ubah') {
			$id 					= $this->input->post('id');
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bumlin->update(array('id' => $id), $data);
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
		$tgl_daftar 			= $this->input->post('tgl_daftar');
		$tgl_pendaftaran 		= $this->input->post('tgl_daftar');

        $umur_kehamilan 		= $this->input->post('umur_kehamilan');
        $hamil_ke 				= $this->input->post('hamil_ke');
        $pyd_ptdh_fe1 	    	= ($this->input->post('status_pyd_ptdh_fe1') ? $this->input->post('pyd_ptdh_fe1') : null );
        $pyd_ptdh_fe2 	    	= ($this->input->post('status_pyd_ptdh_fe2') ? $this->input->post('pyd_ptdh_fe2') : null );
        $pyd_ptdh_fe3 	    	= ($this->input->post('status_pyd_ptdh_fe3') ? $this->input->post('pyd_ptdh_fe3') : null );
        $pyd_imsi1 	            = ($this->input->post('status_pyd_imsi1') ? $this->input->post('pyd_imsi1') : null );
        $pyd_imsi2 	            = ($this->input->post('status_pyd_imsi2') ? $this->input->post('pyd_imsi2') : null );
        $pyd_kapsul_yodium 	    = ($this->input->post('status_pyd_kapsul_yodium') ? $this->input->post('pyd_kapsul_yodium') : null );
        $lahir_tanggal 	        = ($this->input->post('status_lahir_tanggal') ? $this->input->post('lahir_tanggal') : null );
        $lahir_pic 				= ($this->input->post('status_lahir_tanggal') ? $this->input->post('lahir_pic') : null );
        $bayi_jk 	        	= ($this->input->post('status_lahir_tanggal') ? $this->input->post('bayi_jk') : null );
        $bayi_berat 	        = ($this->input->post('status_lahir_tanggal') ? $this->input->post('bayi_berat') : null );
        $bayi_meninggal 	    = ($this->input->post('status_lahir_tanggal') ? ($this->input->post('status_bayi_meninggal') ? $this->input->post('bayi_meninggal') : null ) : null );
        $ibu_meninggal 	    	= ($this->input->post('status_ibu_meninggal') ? $this->input->post('ibu_meninggal') : null );
        $ibu_menyusui 			= $this->input->post('ibu_menyusui');
        $pyd_resiko 	    	= ($this->input->post('pyd_resiko') ? 1 : 0 );
		
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$data = array(
			'umur_kehamilan' 		=> $umur_kehamilan,
			'hamil_ke' 				=> $hamil_ke,
			'pyd_ptdh_fe1' 			=> $pyd_ptdh_fe1,
			'pyd_ptdh_fe2' 			=> $pyd_ptdh_fe2,
			'pyd_ptdh_fe3' 			=> $pyd_ptdh_fe3,
			'pyd_imsi1' 			=> $pyd_imsi1,
			'pyd_imsi2' 			=> $pyd_imsi2,
			'pyd_kapsul_yodium' 	=> $pyd_kapsul_yodium,
			'lahir_tanggal' 		=> $lahir_tanggal,
			'lahir_pic' 			=> $lahir_pic,
			'bayi_berat' 			=> $bayi_berat,
			'bayi_meninggal' 		=> $bayi_meninggal,
			'ibu_meninggal' 		=> $ibu_meninggal,
			'ibu_menyusui' 			=> $ibu_menyusui,
			'pyd_resiko' 			=> $pyd_resiko,
			'pyd_resiko' 			=> $pyd_resiko,
			'bayi_jk' 				=> $bayi_jk,
			'tgl_daftar' 			=> $tgl_daftar,
			'tgl_pendaftaran' 		=> $tgl_daftar,
		);

		// kunjungan ---------------------
		$kunjungan_bumlin_bln 	= $_POST["kunjungan_bumlin_bln"];
        $kunjungan_bumlin_thn 	= $_POST["kunjungan_bumlin_thn"];
        $kunjungan_val 			= $_POST["kunjungan_val"];
        $keterangan 			= $_POST["keterangan"];

		if (count($kunjungan_bumlin_bln) > 0) {

            for ($i=0; $i < count($kunjungan_bumlin_bln) ; $i++) { 
                $data_kunjungan[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'bumlin_id'             => $id, 
                    'bulan'                 => $kunjungan_bumlin_bln[$i], 
                    'tahun'                 => $kunjungan_bumlin_thn[$i], 
                    'is_kunjungan'       	=> (!empty($kunjungan_val[$i])? $kunjungan_val[$i] : 0 ), 
                    'keterangan'        	=> (!empty($keterangan[$i])? $keterangan[$i] : null), 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

            }
        }

        $clear_kunjungan_bumli 		= $this->Model_bumlin->clear_kunjungan_data_bumlin($id, $year_assign);

		// kb ---------------------------

		$pmk_bumlin_bln 		= $_POST["pmk_bumlin_bln"];
        $pmk_bumlin_thn 		= $_POST["pmk_bumlin_thn"];
        $pmk_bumlin_tkn_darah 	= $_POST["pmk_bumlin_tkn_darah"];
        $pmk_bumlin_berat_badan = $_POST["pmk_bumlin_berat_badan"];
        $pmk_bumlin_risk_val 	= $_POST["pmk_bumlin_risk_val"];

		if (count($pmk_bumlin_bln) > 0) {

            for ($i=0; $i < count($pmk_bumlin_bln) ; $i++) { 
                $data_pemeriksaa[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'bumlin_id'             => $id, 
                    'bulan'                 => $pmk_bumlin_bln[$i], 
                    'tahun'                 => $pmk_bumlin_thn[$i], 
                    'tekanan_darah'         => $pmk_bumlin_tkn_darah[$i], 
                    'berat_badan'      		=> $pmk_bumlin_berat_badan[$i], 
                    'is_risk'        		=> (!empty($pmk_bumlin_risk_val[$i])? $pmk_bumlin_risk_val[$i] : 0), 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

            }
        }

        $clear_pemeriksaan_bumli 		= $this->Model_bumlin->clear_pemeriksaan_data_bumlin($id, $year_assign);


		$save = FALSE;
		$data['id'] 			= $id;
		$data['updated_by'] 	= $updated_by;
		$data['updated_on'] 	= $updated_on;
		$save = $this->Model_bumlin->update(array('id' => $id), $data);
		$save_kunjungan_bumlin = $this->Model_bumlin->save_kunjungan($data_kunjungan);
		$save_pemeriksaa_bumlin = $this->Model_bumlin->save_pemeriksaan($data_pemeriksaa);

		$data['clear_kunjungan_bumli'] 		= $clear_kunjungan_bumli;
		$data['data_kunjungan'] 		    = $data_kunjungan;
		$data['clear_pemeriksaan_bumli'] 	= $clear_pemeriksaan_bumli;
		$data['data_pemeriksaa'] 		    = $data_pemeriksaa;
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

		$r_bmn = $this->get_data_bumlin($id);
		if (empty($r_bmn)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_bumlin->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}
}