<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_balita','Model_balita');
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
        $head['title_page']     = 'Data Balita';
        $head['menu_active']    = 'balita';
        $head['subMenu_active'] = 'balita_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Balita';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('balita/balita_views', $data);
        $this->load->view('template/footer');
	}

	public function layanan()
	{
        // head data
        $head['title_page']     = 'Layanan Balita';
        $head['menu_active']    = 'balita';
        $head['subMenu_active'] = 'balita_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Layanan Balita';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('balita/balita_layanan_views', $data);
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

		$list = $this->Model_balita->get_laporan_balita($tahun, $bulan);

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
                $row['nama_anak']          		= $r->nama_anak;
                $row['tgl_lahir_anak']        	= $r->tgl_lahir_anak;
                $row['jk_anak']        			= $r->jk_anak;
                $row['nama_bapak']          	= $r->nama_bapak;
                $row['nama_ibu']      			= $r->nama_ibu;
                $row['kel_dawis']       		= $r->kel_dawis;
                $row['pyd_syrp_besi_fe1']      	= $r->pyd_syrp_besi_fe1;
                $row['pyd_syrp_besi_fe2']      	= $r->pyd_syrp_besi_fe2;
                $row['pyd_vit_a_bln1']      	= $r->pyd_vit_a_bln1;
                $row['pyd_vit_a_bln2']      	= $r->pyd_vit_a_bln2;
                $row['pyd_pmt_pemulihan']      	= $r->pyd_pmt_pemulihan;
                $row['pyd_oralit']      		= $r->pyd_oralit;

                $row['r01_tinggi']      		= $r->r01_tinggi;
                $row['r01_berat']      			= $r->r01_berat;
                $row['r02_tinggi']      		= $r->r02_tinggi;
                $row['r02_berat']      			= $r->r02_berat;
                $row['r03_tinggi']      		= $r->r03_tinggi;
                $row['r03_berat']      			= $r->r03_berat;
                $row['r04_tinggi']      		= $r->r04_tinggi;
                $row['r04_berat']      			= $r->r04_berat;
                $row['r05_tinggi']      		= $r->r05_tinggi;
                $row['r05_berat']      			= $r->r05_berat;
                $row['r06_tinggi']      		= $r->r06_tinggi;
                $row['r06_berat']      			= $r->r06_berat;
                $row['r07_tinggi']      		= $r->r07_tinggi;
                $row['r07_berat']      			= $r->r07_berat;
                $row['r08_tinggi']      		= $r->r08_tinggi;
                $row['r08_berat']      			= $r->r08_berat;
                $row['r09_tinggi']      		= $r->r09_tinggi;
                $row['r09_berat']      			= $r->r09_berat;
                $row['r10_tinggi']      		= $r->r10_tinggi;
                $row['r10_berat']      			= $r->r10_berat;
                $row['r11_tinggi']      		= $r->r11_tinggi;
                $row['r11_berat']      			= $r->r11_berat;
                $row['r12_tinggi']      		= $r->r12_tinggi;
                $row['r12_berat']      			= $r->r12_berat;
				
                $data_report[]              	= $row;
            }
		}

		
        $data['filterBulan'] = ARRAY_BULAN[$bulan];
        $data['filterTahun'] = $tahun;
        $data['report'] = $data_report;

		// echo "<pre>";
		// print_r($data_report);
		// echo "</pre>";

		

        $this->load->view('balita/balita_export', $data);

	}

	public function update_layanan($id, $year = null)
	{
		if (empty($id)) {
			redirect(base_url().'balita/layanan');
			return null;
		}

		if ($year == null) {
			$year = date('Y');
		}

		$r_bayi = $this->get_data_balita($id);
		if (empty($r_bayi)) {
			redirect(base_url().'balita');
			return null;
		}

        // head data
        $head['title_page']     = 'Update Layanan Balita';
        $head['menu_active']    = 'balita';
        $head['subMenu_active'] = 'balita_layanan';
        $head['pos_session'] 	= $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Update Layanan Balita';
		
		$data = array(
            'aksi' 					=> 'Ubah',
			'year_assign'			=> $year,
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
		    'data_penimbangan' 		=> $this->Model_balita->get_timbangan_balita($id, $year),
		    'arsip_penimbangan' 	=> $this->Model_balita->get_arsip_timbangan_balita($id),
		    'data_kunjugan' 		=> $this->Model_balita->get_kunjugan_balita($id, $year),
		    'id' 					=> set_value('id', $r_bayi->id),
            'pos_id' 				=> set_value('pos_id', $r_bayi->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_bayi->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_bayi->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_bayi->desa_name),
		    'kms' 					=> set_value('kms', $r_bayi->kms),
		    'nama_bapak' 			=> set_value('nama_bapak', $r_bayi->nama_bapak),
		    'nama_ibu' 				=> set_value('nama_ibu', $r_bayi->nama_ibu),
		    'nama_anak' 			=> set_value('nama_anak', $r_bayi->nama_anak),
		    'tgl_lahir_anak' 		=> set_value('tgl_lahir_anak', $r_bayi->tgl_lahir_anak),
		    'jk_anak' 				=> set_value('jk_anak', $r_bayi->jk_anak),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_bayi->kel_dawis),
		    'pyd_syrp_besi_fe1' 	=> set_value('pyd_syrp_besi_fe1', $r_bayi->pyd_syrp_besi_fe1),
		    'pyd_syrp_besi_fe2' 	=> set_value('pyd_syrp_besi_fe2', $r_bayi->pyd_syrp_besi_fe2),
		    'pyd_vit_a_bln1' 	    => set_value('pyd_vit_a_bln1', $r_bayi->pyd_vit_a_bln1),
		    'pyd_vit_a_bln2' 	    => set_value('pyd_vit_a_bln2', $r_bayi->pyd_vit_a_bln2),
		    'pyd_pmt_pemulihan' 	=> set_value('pyd_pmt_pemulihan', $r_bayi->pyd_pmt_pemulihan),
		    'pyd_oralit' 	        => set_value('pyd_oralit', $r_bayi->pyd_oralit),
		    'keterangan' 	        => set_value('keterangan', $r_bayi->keterangan),
			'is_risk' 				=> set_value('is_risk', $r_bayi->is_risk),
			'tgl_daftar' 			=> set_value('tgl_daftar', $r_bayi->tgl_daftar),
		);
        
		$this->load->view('template/header', $head);
        $this->load->view('balita/balita_layanan_forms', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_balita()
	{
		$list = $this->Model_balita->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_balita) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_balita->kms;
			$row[] = $r_balita->nama_anak;
			$row[] = $r_balita->nama_ibu;
			$row[] = $r_balita->nama_bapak;
			$row[] = '<div class="text-center">'.$r_balita->tgl_lahir_anak.'</div>';;
			$row[] = '<div class="text-center">'.$r_balita->jk_anak.'</div>';
			$row[] = ( !empty($r_balita->keterangan) ? $r_balita->keterangan : '<div class="text-center">-</div>' );

			//add html for action
            $row[] = '<div class="text-center">
                        <div class="btn-group mb-2">
                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.base_url().'balita/edit/'.$r_balita->id.'" title="Ubah"><i class="fas fa-edit"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_balita('."'".$r_balita->id."'".')"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_balita->count_all(),
						"recordsFiltered" => $this->Model_balita->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function datatable_layanan_balita()
	{
		$list = $this->Model_balita->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_balita) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_balita->kms;
			$row[] = $r_balita->nama_anak;
			$row[] = '<div class="text-center">'.$r_balita->jk_anak.'</div>';
			$row[] = '<div class="text-center">'.( $r_balita->is_risk == 1 ? '<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Beresiko<span>' : '-' ).'</div>';

			//add html for action
            $row[] = '<div class="text-center">
						<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Update Layanan" onclick="layanan_pos('."'".$r_balita->id."'".')"><i class="fas fa-comment-medical"></i> Layanan Posyandu</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_balita->count_all(),
						"recordsFiltered" => $this->Model_balita->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_balita($id){
		$data = $this->Model_balita->get_by_id($id);
		return $data;
	}

	public function get_data_balita_json($id){
		$data = $this->Model_balita->get_by_id($id);
		echo json_encode($data);
	}

    public function cek_data_balita($kms){
		$data = $this->Model_balita->get_by_kms($kms);
		return $data;
	}

    public function cek_data_balita_json($kms){
		$data = $this->Model_balita->get_by_kms($kms);
		echo json_encode($data);
	}

    public function get_total_data_json(){
		$tahun = $this->input->post('filterYear');
		if (empty($tahun)) {
			$tahun = date('Y');
		}
		$total_penimbang = $this->Model_balita->get_total_data_timbangan_balita($tahun);
		$dataTotal = array(
			'total_balita' => $this->Model_balita->get_total_data_balita($tahun), 
			'total_timbangan_balita' => ( $total_penimbang ? (int)$total_penimbang->total_penimbang : 0 ), 
		);
		echo json_encode($dataTotal);
	}

	public function get_statistik_timbangan_balita_json(){
		$tahun = $this->input->post('filterYear');
		$data = $this->Model_balita->get_timbangan_balita_total($tahun);
		echo json_encode($data);
	}

	public function get_statistik_balita_json(){
		$tahun = $this->input->post('filterYear');
		$data = $this->Model_balita->get_kunjungan_balita_total($tahun);
		echo json_encode($data);
	}

    public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Balita';
        $head['menu_active'] 	= 'balita';
        $head['subMenu_active'] = 'balita_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

		$year = date('Y');

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
			'year_assign'			=> $year,
            'pages_caption' 		=> 'Tambah Balita',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('balita/action_process'),
		    'id' 					=> set_value('id'),
		    'pos_id' 				=> set_value('pos_id'),
		    'pos_name' 				=> set_value('pos_name', ( !empty($this->session->userdata('pos_name')) ? $this->session->userdata('pos_name') : "" )),
		    'desa_id' 				=> set_value('desa_id', ( !empty($this->session->userdata('desa_id')) ? $this->session->userdata('desa_id') : "" )),
		    'desa_name' 			=> set_value('desa_name', ( !empty($this->session->userdata('desa')) ? $this->session->userdata('desa') : "" )),
		    'kms' 					=> set_value('kms'),
		    'nama_bapak' 			=> set_value('nama_bapak'),
		    'nama_ibu' 				=> set_value('nama_ibu'),
		    'nama_anak' 			=> set_value('nama_anak'),
		    'tgl_lahir_anak' 		=> set_value('tgl_lahir_anak'),
		    'jk_anak' 				=> set_value('jk_anak', 'L'),
		    'kel_dawis' 		    => set_value('kel_dawis'),
		    'pyd_syrp_besi_fe1' 	=> set_value('pyd_syrp_besi_fe1'),
		    'pyd_syrp_besi_fe2' 	=> set_value('pyd_syrp_besi_fe2'),
		    'pyd_vit_a_bln1' 	    => set_value('pyd_vit_a_bln1'),
		    'pyd_vit_a_bln2' 	    => set_value('pyd_vit_a_bln2'),
		    'pyd_pmt_pemulihan' 	=> set_value('pyd_pmt_pemulihan'),
		    'pyd_oralit' 	        => set_value('pyd_oralit'),
		    'keterangan' 	        => set_value('keterangan'),
		    'tgl_daftar' 	        => set_value('tgl_daftar'),
		);

		$this->load->view('template/header', $head);
        $this->load->view('balita/balita_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_balita = $this->get_data_balita($id);
		if (empty($r_balita)) {
			redirect(base_url().'balita');
		}

		$year = date('Y');

        // head data
        $head['title_page'] 	= 'Ubah Data Balita';
        $head['menu_active'] 	= 'balita';
        $head['subMenu_active'] = 'balita_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
			'year_assign'			=> $year,
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('balita/action_process'),
		    'id' 					=> set_value('id', $r_balita->id),
            'pos_id' 				=> set_value('pos_id', $r_balita->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_balita->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_balita->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_balita->desa_name),
		    'kms' 					=> set_value('kms', $r_balita->kms),
		    'nama_bapak' 			=> set_value('nama_bapak', $r_balita->nama_bapak),
		    'nama_ibu' 				=> set_value('nama_ibu', $r_balita->nama_ibu),
		    'nama_anak' 			=> set_value('nama_anak', $r_balita->nama_anak),
		    'tgl_lahir_anak' 		=> set_value('tgl_lahir_anak', $r_balita->tgl_lahir_anak),
		    'jk_anak' 				=> set_value('jk_anak', $r_balita->jk_anak),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_balita->kel_dawis),
		    'keterangan' 	        => set_value('keterangan', $r_balita->keterangan),
		    'tgl_daftar' 	        => set_value('tgl_daftar', $r_balita->tgl_daftar),
		);

		$this->load->view('template/header', $head);
        $this->load->view('balita/balita_forms', $data);
        $this->load->view('template/footer');
	}

    public function action_process() 
	{

		$save_method 			= $this->input->post('save_method');

		$id 					= ($save_method == 'Tambah' ? $this->Model_global->create_id() : $this->input->post('id'));
		
		$year_assign 			= $this->input->post('year_assign');
		$pos_id 				= $this->input->post('pos_id');
		$pos_name 				= $this->input->post('pos_name');
		$desa_id 				= $this->input->post('desa_id');
		$desa_name 				= $this->input->post('desa_name');
		$kms 					= $this->input->post('kms');
		$nama_bapak 			= $this->input->post('nama_bapak');
		$nama_ibu 				= $this->input->post('nama_ibu');
		$nama_anak 				= $this->input->post('nama_anak');
		$tgl_lahir_anak 		= $this->input->post('tgl_lahir_anak');
		$jk_anak 				= $this->input->post('jk_anak');
		$kel_dawis 				= $this->input->post('kel_dawis');
		$keterangan 			= $this->input->post('keterangan');
		$tgl_daftar 			= $this->input->post('tgl_daftar');
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

		$data = array(
			'pos_id' 				=> $pos_id,
		    'pos_name' 				=> $pos_name,
		    'desa_id' 				=> $desa_id,
		    'desa_name' 			=> $desa_name,
		    'kms' 					=> $kms,
		    'nama_bapak' 			=> $nama_bapak,
		    'nama_ibu' 				=> $nama_ibu,
		    'nama_anak' 			=> $nama_anak,
		    'tgl_lahir_anak' 		=> $tgl_lahir_anak,
		    'jk_anak' 				=> $jk_anak,
		    'kel_dawis' 		    => $kel_dawis,
		    'keterangan' 	        => $keterangan,
		    'tgl_daftar' 	        => $tgl_daftar,
		);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_balita->save($data);
		}elseif ($save_method == 'Ubah') {
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_balita->update(array('id' => $id), $data);
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

		$pyd_syrp_besi_fe1 		= ($this->input->post('status_pyd_syrp_besi_fe1') ? $this->input->post('pyd_syrp_besi_fe1') : null );
		$pyd_syrp_besi_fe2 		= ($this->input->post('status_pyd_syrp_besi_fe2') ? $this->input->post('pyd_syrp_besi_fe2') : null );
		$pyd_vit_a_bln1 		= ($this->input->post('status_pyd_vit_a_bln1') ? $this->input->post('pyd_vit_a_bln1') : null );
		$pyd_vit_a_bln2 		= ($this->input->post('status_pyd_vit_a_bln2') ? $this->input->post('pyd_vit_a_bln2') : null );
		$pyd_pmt_pemulihan 		= ($this->input->post('status_pyd_pmt_pemulihan') ? $this->input->post('pyd_pmt_pemulihan') : null );
		$pyd_oralit 			= ($this->input->post('status_pyd_oralit') ? $this->input->post('pyd_oralit') : null );
		$is_risk 				= ($this->input->post('is_risk') ? 1 : 0 );
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

        $timbangan_balita_bln 	= $_POST["timbangan_balita_bln"];
        $timbangan_balita_thn 	= $_POST["timbangan_balita_thn"];
        $tinggi_balita 			= $_POST["tinggi_balita"];
        $berat_balita 			= $_POST["berat_balita"];

		$data = array(
		    'pyd_syrp_besi_fe1' 	=> $pyd_syrp_besi_fe1,
		    'pyd_syrp_besi_fe2' 	=> $pyd_syrp_besi_fe2,
		    'pyd_vit_a_bln1' 	    => $pyd_vit_a_bln1,
		    'pyd_vit_a_bln2' 	    => $pyd_vit_a_bln2,
		    'pyd_pmt_pemulihan' 	=> $pyd_pmt_pemulihan,
		    'pyd_oralit' 	        => $pyd_oralit,
			'is_risk' 				=> $is_risk,
			'tgl_daftar' 			=> $tgl_daftar,
		);

        if (count($timbangan_balita_bln) > 0) {
            $tinggi_sebelum = 0;
            $berat_sebelum  = 0;

            for ($i=0; $i < count($timbangan_balita_bln) ; $i++) { 
                $data_timbangan[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'balita_id'             => $id, 
                    'bulan'                 => $timbangan_balita_bln[$i], 
                    'tahun'                 => $timbangan_balita_thn[$i], 
                    'tinggi_sebelum'        => ($tinggi_balita[$i] > 0 ? $tinggi_sebelum : 0 ), 
                    'berat_sebelum'         => ($berat_balita[$i] > 0 ? $berat_sebelum : 0 ), 
                    'tinggi_sekarang'       => $tinggi_balita[$i], 
                    'berat_sekarang'        => $berat_balita[$i], 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

                $tinggi_sebelum = ($tinggi_balita[$i] > 0 ? $tinggi_balita[$i] : $tinggi_sebelum);
                $berat_sebelum  = ($berat_balita[$i] > 0 ? $berat_balita[$i] : $berat_sebelum);

            }
        }

        $clear_timbangan_balita 		= $this->Model_balita->clear_penimbangan_data_balita($id, $year_assign);

		$kunjungan_balita_bln 	= $_POST["kunjungan_balita_bln"];
        $kunjungan_balita_thn 	= $_POST["kunjungan_balita_thn"];
        $kunjungan_val 			= $_POST["kunjungan_val"];
        $keterangan 			= $_POST["keterangan"];

		if (count($kunjungan_balita_bln) > 0) {

            for ($i=0; $i < count($kunjungan_balita_bln) ; $i++) { 
                $data_kunjungan[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'balita_id'               => $id, 
                    'bulan'                 => $kunjungan_balita_bln[$i], 
                    'tahun'                 => $kunjungan_balita_thn[$i], 
                    'is_kunjungan'       	=> (!empty($kunjungan_val[$i])? $kunjungan_val[$i] : 0 ), 
                    'keterangan'        	=> (!empty($keterangan[$i])? $keterangan[$i] : null), 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

            }
        }

        $clear_kunjungan_balita 		= $this->Model_balita->clear_kunjungan_data_balita($id, $year_assign);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_balita->save($data);
            $save_penimbnagan_bayi = $this->Model_balita->save_penimbangan($data_timbangan);
			$save_kunjungan_balita = $this->Model_balita->save_kunjungan($data_kunjungan);
		}elseif ($save_method == 'Ubah') {
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_balita->update(array('id' => $id), $data);
            $save_penimbnagan_bayi = $this->Model_balita->save_penimbangan($data_timbangan);
			$save_kunjungan_balita = $this->Model_balita->save_kunjungan($data_kunjungan);
		}

		$data['clear_timbangan_balita'] 	= $clear_timbangan_balita;
		$data['clear_kunjungan_balita'] 	= $clear_kunjungan_balita;
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

		$r_balita = $this->get_data_balita($id);
		if (empty($r_balita)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_balita->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

}