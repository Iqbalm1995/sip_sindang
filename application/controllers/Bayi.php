<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_bayi','Model_bayi');
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
        $head['title_page']     = 'Data Bayi';
        $head['menu_active']    = 'bayi';
        $head['subMenu_active'] = 'bayi_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Bayi';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
		
        
		$this->load->view('template/header', $head);
        $this->load->view('bayi/bayi_views', $data);
        $this->load->view('template/footer');
	}

	public function layanan()
	{
        // head data
        $head['title_page']     = 'Layanan Bayi';
        $head['menu_active']    = 'bayi';
        $head['subMenu_active'] = 'bayi_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Layanan Bayi';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('bayi/bayi_layanan_views', $data);
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

		$list = $this->Model_bayi->get_laporan_bayi($tahun, $bulan);

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
                $row['nama_bayi']          		= $r->nama_bayi;
                $row['tgl_lahir_bayi']        	= $r->tgl_lahir_bayi;
                $row['jk_bayi']        			= $r->jk_bayi;
                $row['bbl']   					= $r->bbl;
                $row['nama_bapak']          	= $r->nama_bapak;
                $row['nama_ibu']      			= $r->nama_ibu;
                $row['kel_dawis']       		= $r->kel_dawis;
                $row['pyd_syrp_besi_fe1']      	= $r->pyd_syrp_besi_fe1;
                $row['pyd_syrp_besi_fe2']      	= $r->pyd_syrp_besi_fe2;
                $row['pyd_vit_a_bln1']      	= $r->pyd_vit_a_bln1;
                $row['pyd_vit_a_bln2']      	= $r->pyd_vit_a_bln2;
                $row['pyd_oralit']      		= $r->pyd_oralit;
                $row['pyd_bcg']      			= $r->pyd_bcg;
                $row['pyd_dpt1']      			= $r->pyd_dpt1;
                $row['pyd_dpt2']      			= $r->pyd_dpt2;
                $row['pyd_dpt3']      			= $r->pyd_dpt3;
                $row['pyd_polio1']      		= $r->pyd_polio1;
                $row['pyd_polio2']      		= $r->pyd_polio2;
                $row['pyd_polio3']      		= $r->pyd_polio3;
                $row['pyd_polio4']      		= $r->pyd_polio4;
                $row['pyd_campak']      		= $r->pyd_campak;
                $row['pyd_hepatitis1']      	= $r->pyd_hepatitis1;
                $row['pyd_hepatitis2']      	= $r->pyd_hepatitis2;
                $row['pyd_hepatitis3']      	= $r->pyd_hepatitis3;
                $row['tgl_meninggal_bayi']      = $r->tgl_meninggal_bayi;

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

		

        $this->load->view('bayi/bayi_export', $data);

	}

	public function update_layanan($id, $year = null)
	{
		if (empty($id)) {
			redirect(base_url().'bayi/layanan');
			return null;
		}

		if ($year == null) {
			$year = date('Y');
		}

		$r_bayi = $this->get_data_bayi($id);
		if (empty($r_bayi)) {
			redirect(base_url().'bayi');
			return null;
		}

        // head data
        $head['title_page']     = 'Update Layanan Bayi';
        $head['menu_active']    = 'bayi';
        $head['subMenu_active'] = 'bayi_layanan';
        $head['pos_session'] 	= $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Update Layanan Bayi';
		
		$data = array(
            'aksi' 					=> 'Ubah',
			'year_assign'			=> $year,
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
		    'data_penimbangan' 		=> $this->Model_bayi->get_timbangan_bayi($id, $year),
		    'arsip_penimbangan' 	=> $this->Model_bayi->get_arsip_timbangan_bayi($id),
		    'data_kunjugan' 		=> $this->Model_bayi->get_kunjugan_bayi($id, $year),
		    'id' 					=> set_value('id', $r_bayi->id),
            'pos_id' 				=> set_value('pos_id', $r_bayi->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_bayi->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_bayi->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_bayi->desa_name),
		    'kms' 					=> set_value('kms', $r_bayi->kms),
		    'nama_bapak' 			=> set_value('nama_bapak', $r_bayi->nama_bapak),
		    'nama_ibu' 				=> set_value('nama_ibu', $r_bayi->nama_ibu),
		    'nama_bayi' 			=> set_value('nama_bayi', $r_bayi->nama_bayi),
		    'tgl_lahir_bayi' 		=> set_value('tgl_lahir_bayi', $r_bayi->tgl_lahir_bayi),
		    'jk_bayi' 				=> set_value('jk_bayi', $r_bayi->jk_bayi),
		    'bbl' 			        => set_value('bbl', $r_bayi->bbl),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_bayi->kel_dawis),
		    'pyd_syrp_besi_fe1' 	=> set_value('pyd_syrp_besi_fe1', $r_bayi->pyd_syrp_besi_fe1),
		    'pyd_syrp_besi_fe2' 	=> set_value('pyd_syrp_besi_fe2', $r_bayi->pyd_syrp_besi_fe2),
		    'pyd_vit_a_bln1' 	    => set_value('pyd_vit_a_bln1', $r_bayi->pyd_vit_a_bln1),
		    'pyd_vit_a_bln2' 	    => set_value('pyd_vit_a_bln2', $r_bayi->pyd_vit_a_bln2),
		    'pyd_oralit' 	        => set_value('pyd_oralit', $r_bayi->pyd_oralit),
		    'pyd_bcg' 	            => set_value('pyd_bcg', $r_bayi->pyd_bcg),
		    'pyd_dpt1' 	            => set_value('pyd_dpt1', $r_bayi->pyd_dpt1),
		    'pyd_dpt2' 	            => set_value('pyd_dpt2', $r_bayi->pyd_dpt2),
		    'pyd_dpt3' 	            => set_value('pyd_dpt3', $r_bayi->pyd_dpt3),
		    'pyd_polio1' 	        => set_value('pyd_polio1', $r_bayi->pyd_polio1),
		    'pyd_polio2' 	        => set_value('pyd_polio2', $r_bayi->pyd_polio2),
		    'pyd_polio3' 	        => set_value('pyd_polio3', $r_bayi->pyd_polio3),
		    'pyd_polio4' 	        => set_value('pyd_polio4', $r_bayi->pyd_polio4),
		    'pyd_campak' 	        => set_value('pyd_campak', $r_bayi->pyd_campak),
		    'pyd_hepatitis1' 	    => set_value('pyd_hepatitis1', $r_bayi->pyd_hepatitis1),
		    'pyd_hepatitis2' 	    => set_value('pyd_hepatitis2', $r_bayi->pyd_hepatitis2),
		    'pyd_hepatitis3' 	    => set_value('pyd_hepatitis3', $r_bayi->pyd_hepatitis3),
		    'tgl_meninggal_bayi' 	=> set_value('tgl_meninggal_bayi', $r_bayi->tgl_meninggal_bayi),
		    'keterangan' 	        => set_value('keterangan', $r_bayi->keterangan),
			'is_risk' 				=> set_value('is_risk', $r_bayi->is_risk)
		);
        
		$this->load->view('template/header', $head);
        $this->load->view('bayi/bayi_layanan_forms', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_bayi()
	{
		$list = $this->Model_bayi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_bayi) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_bayi->kms;
			$row[] = $r_bayi->nama_bayi;
			$row[] = $r_bayi->nama_ibu;
			$row[] = $r_bayi->nama_bapak;
			$row[] = '<div class="text-center">'.$r_bayi->tgl_lahir_bayi.'</div>';;
			$row[] = '<div class="text-center">'.$r_bayi->jk_bayi.'</div>';
			$row[] = '<div class="text-center">'.( !empty($r_bayi->tgl_meninggal_bayi) ? $r_bayi->tgl_meninggal_bayi : '-' ).'</div>';
			$row[] = '<div class="text-center">'.( !empty($r_bayi->bbl) ? 'Ya' : 'Tidak' ).'</div>';
			$row[] = ( !empty($r_bayi->keterangan) ? $r_bayi->keterangan : '<div class="text-center">-</div>' );

			//add html for action
            $row[] = '<div class="text-center">
                        <div class="btn-group mb-2">
                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.base_url().'bayi/edit/'.$r_bayi->id.'" title="Ubah"><i class="fas fa-edit"></i> Ubah</a>
                            <a class="dropdown-item" href="javascript:void(0)" title="Hapus" onclick="delete_bayi('."'".$r_bayi->id."'".')"><i class="fas fa-trash"></i> Hapus</a>
                            <a class="dropdown-item" href="'.base_url().'bayi/detail/'.$r_bayi->id.'" title="Detail"><i class="fas fa-info-circle"></i> Detail</a>
                        </div>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_bayi->count_all(),
						"recordsFiltered" => $this->Model_bayi->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function datatable_layanan_bayi()
	{
		$list = $this->Model_bayi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_bayi) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_bayi->kms;
			$row[] = $r_bayi->nama_bayi;
			$row[] = '<div class="text-center">'.$r_bayi->jk_bayi.'</div>';
			$row[] = '<div class="text-center">'.( $r_bayi->is_risk == 1 ? '<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Beresiko<span>' : '-' ).'</div>';

			//add html for action
            $row[] = '<div class="text-center">
						<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Update Layanan" onclick="layanan_pos('."'".$r_bayi->id."'".')"><i class="fas fa-comment-medical"></i> Layanan Posyandu</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_bayi->count_all(),
						"recordsFiltered" => $this->Model_bayi->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function get_data_bayi($id){
		$data = $this->Model_bayi->get_by_id($id);
		return $data;
	}

	public function get_data_bayi_json($id){
		$data = $this->Model_bayi->get_by_id($id);
		echo json_encode($data);
	}

    public function cek_data_bayi($kms){
		$data = $this->Model_bayi->get_by_kms($kms);
		return $data;
	}

    public function cek_data_bayi_json($kms){
		$data = $this->Model_bayi->get_by_kms($kms);
		echo json_encode($data);
	}

    public function get_total_data_json(){
		$tahun = $this->input->post('filterYear');
		if (empty($tahun)) {
			$tahun = date('Y');
		}
		$total_penimbang = $this->Model_bayi->get_total_data_timbangan_bayi($tahun);
		$dataTotal = array(
			'total_bayi' => $this->Model_bayi->get_total_data_bayi($tahun), 
			'total_bayi_baru_lahir' => $this->Model_bayi->get_total_data_bayi_baru_lahir($tahun), 
			'total_bayi_bayi_meninggal' => (int)$this->Model_bayi->get_total_data_bayi_meninggal($tahun)->total_bayi_meninggal, 
			'total_timbangan_bayi' => ( $total_penimbang ? (int)$total_penimbang->total_penimbang : 0 ), 
		);
		echo json_encode($dataTotal);
	}

	public function get_statistik_timbangan_bayi_json(){
		$tahun = $this->input->post('filterYear');
		$data = $this->Model_bayi->get_timbangan_bayi_total($tahun);
		echo json_encode($data);
	}

	public function get_statistik_bumil_json(){
		$tahun = $this->input->post('filterYear');
		$data = $this->Model_bayi->get_kunjungan_bayi_total($tahun);
		echo json_encode($data);
	}


    public function add()
	{
        // head data
        $head['title_page'] 	= 'Tambah Bayi';
        $head['menu_active'] 	= 'bayi';
        $head['subMenu_active'] = 'bayi_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

		$year = date('Y');

        // body data
		$data = array(
            'aksi' 					=> 'Tambah',
			'year_assign'			=> $year,
            'pages_caption' 		=> 'Tambah Bayi',
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('bayi/action_process'),
		    'id' 					=> set_value('id'),
		    'pos_id' 				=> set_value('pos_id'),
		    'pos_name' 				=> set_value('pos_name', ( !empty($this->session->userdata('pos_name')) ? $this->session->userdata('pos_name') : "" )),
		    'desa_id' 				=> set_value('desa_id', ( !empty($this->session->userdata('desa_id')) ? $this->session->userdata('desa_id') : "" )),
		    'desa_name' 			=> set_value('desa_name', ( !empty($this->session->userdata('desa')) ? $this->session->userdata('desa') : "" )),
		    'kms' 					=> set_value('kms'),
		    'nama_bapak' 			=> set_value('nama_bapak'),
		    'nama_ibu' 				=> set_value('nama_ibu'),
		    'nama_bayi' 			=> set_value('nama_bayi'),
		    'tgl_lahir_bayi' 		=> set_value('tgl_lahir_bayi'),
		    'jk_bayi' 				=> set_value('jk_bayi', 'L'),
		    'bbl' 			        => set_value('bbl', '0'),
		    'kel_dawis' 		    => set_value('kel_dawis'),
		    'pyd_syrp_besi_fe1' 	=> set_value('pyd_syrp_besi_fe1'),
		    'pyd_syrp_besi_fe2' 	=> set_value('pyd_syrp_besi_fe2'),
		    'pyd_vit_a_bln1' 	    => set_value('pyd_vit_a_bln1'),
		    'pyd_vit_a_bln2' 	    => set_value('pyd_vit_a_bln2'),
		    'pyd_oralit' 	        => set_value('pyd_oralit'),
		    'pyd_bcg' 	            => set_value('pyd_bcg'),
		    'pyd_dpt1' 	            => set_value('pyd_dpt1'),
		    'pyd_dpt2' 	            => set_value('pyd_dpt2'),
		    'pyd_dpt3' 	            => set_value('pyd_dpt3'),
		    'pyd_polio1' 	        => set_value('pyd_polio1'),
		    'pyd_polio2' 	        => set_value('pyd_polio2'),
		    'pyd_polio3' 	        => set_value('pyd_polio3'),
		    'pyd_polio4' 	        => set_value('pyd_polio4'),
		    'pyd_campak' 	        => set_value('pyd_campak'),
		    'pyd_hepatitis1' 	    => set_value('pyd_hepatitis1'),
		    'pyd_hepatitis2' 	    => set_value('pyd_hepatitis2'),
		    'pyd_hepatitis3' 	    => set_value('pyd_hepatitis3'),
		    'tgl_meninggal_bayi' 	=> set_value('tgl_meninggal_bayi'),
		    'keterangan' 	        => set_value('keterangan'),
		);

		$this->load->view('template/header', $head);
        $this->load->view('bayi/bayi_forms', $data);
        $this->load->view('template/footer');
	}

	public function edit($id)
	{
		$r_bayi = $this->get_data_bayi($id);
		if (empty($r_bayi)) {
			redirect(base_url().'bayi');
		}

		$year = date('Y');

        // head data
        $head['title_page'] 	= 'Ubah Data Bayi';
        $head['menu_active'] 	= 'bayi';
        $head['subMenu_active'] = 'bayi_layanan';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
		$data = array(
            'aksi' 					=> 'Ubah',
			'year_assign'			=> $year,
            'data_pos' 			    => $this->Model_posyandu->get_posyandu(),
            'acton_form' 			=> base_url('bayi/action_process'),
		    'id' 					=> set_value('id', $r_bayi->id),
            'pos_id' 				=> set_value('pos_id', $r_bayi->pos_id),
		    'pos_name' 				=> set_value('pos_name', $r_bayi->pos_name),
		    'desa_id' 				=> set_value('desa_id', $r_bayi->desa_id),
		    'desa_name' 			=> set_value('desa_name', $r_bayi->desa_name),
		    'kms' 					=> set_value('kms', $r_bayi->kms),
		    'nama_bapak' 			=> set_value('nama_bapak', $r_bayi->nama_bapak),
		    'nama_ibu' 				=> set_value('nama_ibu', $r_bayi->nama_ibu),
		    'nama_bayi' 			=> set_value('nama_bayi', $r_bayi->nama_bayi),
		    'tgl_lahir_bayi' 		=> set_value('tgl_lahir_bayi', $r_bayi->tgl_lahir_bayi),
		    'jk_bayi' 				=> set_value('jk_bayi', $r_bayi->jk_bayi),
		    'bbl' 			        => set_value('bbl', $r_bayi->bbl),
		    'kel_dawis' 		    => set_value('kel_dawis', $r_bayi->kel_dawis),
		    'pyd_syrp_besi_fe1' 	=> set_value('pyd_syrp_besi_fe1', $r_bayi->pyd_syrp_besi_fe1),
		    'pyd_syrp_besi_fe2' 	=> set_value('pyd_syrp_besi_fe2', $r_bayi->pyd_syrp_besi_fe2),
		    'pyd_vit_a_bln1' 	    => set_value('pyd_vit_a_bln1', $r_bayi->pyd_vit_a_bln1),
		    'pyd_vit_a_bln2' 	    => set_value('pyd_vit_a_bln2', $r_bayi->pyd_vit_a_bln2),
		    'pyd_oralit' 	        => set_value('pyd_oralit', $r_bayi->pyd_oralit),
		    'pyd_bcg' 	            => set_value('pyd_bcg', $r_bayi->pyd_bcg),
		    'pyd_dpt1' 	            => set_value('pyd_dpt1', $r_bayi->pyd_dpt1),
		    'pyd_dpt2' 	            => set_value('pyd_dpt2', $r_bayi->pyd_dpt2),
		    'pyd_dpt3' 	            => set_value('pyd_dpt3', $r_bayi->pyd_dpt3),
		    'pyd_polio1' 	        => set_value('pyd_polio1', $r_bayi->pyd_polio1),
		    'pyd_polio2' 	        => set_value('pyd_polio2', $r_bayi->pyd_polio2),
		    'pyd_polio3' 	        => set_value('pyd_polio3', $r_bayi->pyd_polio3),
		    'pyd_polio4' 	        => set_value('pyd_polio4', $r_bayi->pyd_polio4),
		    'pyd_campak' 	        => set_value('pyd_campak', $r_bayi->pyd_campak),
		    'pyd_hepatitis1' 	    => set_value('pyd_hepatitis1', $r_bayi->pyd_hepatitis1),
		    'pyd_hepatitis2' 	    => set_value('pyd_hepatitis2', $r_bayi->pyd_hepatitis2),
		    'pyd_hepatitis3' 	    => set_value('pyd_hepatitis3', $r_bayi->pyd_hepatitis3),
		    'tgl_meninggal_bayi' 	=> set_value('tgl_meninggal_bayi', $r_bayi->tgl_meninggal_bayi),
		    'keterangan' 	        => set_value('keterangan', $r_bayi->keterangan),
		);

		$this->load->view('template/header', $head);
        $this->load->view('bayi/bayi_forms', $data);
        $this->load->view('template/footer');
	}

	public function detail($id)
	{
		$r_bayi = $this->get_data_bayi($id);
		if (empty($r_bayi)) {
			redirect(base_url().'bayi');
		}

        // head data
        $head['title_page'] 	= 'Detail Data Bayi '.$r_bayi->nama_ibu;
        $head['menu_active'] 	= 'bayi';
        $head['subMenu_active'] = 'bayi_data';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['aksi'] 				= 'Detail';
        $data['data_bayi'] 			= $r_bayi;
		$data['arsip_penimbangan'] 	= $this->Model_bayi->get_arsip_timbangan_bayi($id);

		$this->load->view('template/header', $head);
        $this->load->view('bayi/bayi_details', $data);
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
		$nama_bayi 				= $this->input->post('nama_bayi');
		$tgl_lahir_bayi 		= $this->input->post('tgl_lahir_bayi');
		$jk_bayi 				= $this->input->post('jk_bayi');
		$bbl 				    = $this->input->post('bbl');
		$kel_dawis 				= $this->input->post('kel_dawis');
		// $pyd_syrp_besi_fe1 		= ($this->input->post('status_pyd_syrp_besi_fe1') ? $this->input->post('pyd_syrp_besi_fe1') : null );
		// $pyd_syrp_besi_fe2 		= ($this->input->post('status_pyd_syrp_besi_fe2') ? $this->input->post('pyd_syrp_besi_fe2') : null );
		// $pyd_vit_a_bln1 		= ($this->input->post('status_pyd_vit_a_bln1') ? $this->input->post('pyd_vit_a_bln1') : null );
		// $pyd_vit_a_bln2 		= ($this->input->post('status_pyd_vit_a_bln2') ? $this->input->post('pyd_vit_a_bln2') : null );
		// $pyd_oralit 			= ($this->input->post('pyd_oralit') ? 1 : 0);
		// $pyd_bcg 				= ($this->input->post('pyd_bcg') ? 1 : 0);
		// $pyd_dpt1 				= ($this->input->post('pyd_dpt1') ? 1 : 0);
		// $pyd_dpt2 				= ($this->input->post('pyd_dpt2') ? 1 : 0);
		// $pyd_dpt3 				= ($this->input->post('pyd_dpt3') ? 1 : 0);
		// $pyd_polio1 			= ($this->input->post('pyd_polio1') ? 1 : 0);
		// $pyd_polio2 			= ($this->input->post('pyd_polio2') ? 1 : 0);
		// $pyd_polio3 			= ($this->input->post('pyd_polio3') ? 1 : 0);
		// $pyd_polio4 			= ($this->input->post('pyd_polio4') ? 1 : 0);
		// $pyd_campak 			= ($this->input->post('pyd_campak') ? 1 : 0);
		// $pyd_hepatitis1 		= ($this->input->post('pyd_hepatitis1') ? 1 : 0);
		// $pyd_hepatitis2 		= ($this->input->post('pyd_hepatitis2') ? 1 : 0);
		// $pyd_hepatitis3 		= ($this->input->post('pyd_hepatitis3') ? 1 : 0);
		$tgl_meninggal_bayi 	= ($this->input->post('status_meninggal_bayi') ? $this->input->post('tgl_meninggal_bayi') : null );
		$keterangan 			= $this->input->post('keterangan');
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

        // $timbangan_bayi_bln 	= $_POST["timbangan_bayi_bln"];
        // $timbangan_bayi_thn 	= $_POST["timbangan_bayi_thn"];
        // $tinggi_bayi 			= $_POST["tinggi_bayi"];
        // $berat_bayi 			= $_POST["berat_bayi"];

		$data = array(
			'pos_id' 				=> $pos_id,
		    'pos_name' 				=> $pos_name,
		    'desa_id' 				=> $desa_id,
		    'desa_name' 			=> $desa_name,
		    'kms' 					=> $kms,
		    'nama_bapak' 			=> $nama_bapak,
		    'nama_ibu' 				=> $nama_ibu,
		    'nama_bayi' 			=> $nama_bayi,
		    'tgl_lahir_bayi' 		=> $tgl_lahir_bayi,
		    'jk_bayi' 				=> $jk_bayi,
		    'bbl' 			        => $bbl,
		    'kel_dawis' 		    => $kel_dawis,
		    // 'pyd_syrp_besi_fe1' 	=> $pyd_syrp_besi_fe1,
		    // 'pyd_syrp_besi_fe2' 	=> $pyd_syrp_besi_fe2,
		    // 'pyd_vit_a_bln1' 	    => $pyd_vit_a_bln1,
		    // 'pyd_vit_a_bln2' 	    => $pyd_vit_a_bln2,
		    // 'pyd_oralit' 	        => $pyd_oralit,
		    // 'pyd_bcg' 	            => $pyd_bcg,
		    // 'pyd_dpt1' 	            => $pyd_dpt1,
		    // 'pyd_dpt2' 	            => $pyd_dpt2,
		    // 'pyd_dpt3' 	            => $pyd_dpt3,
		    // 'pyd_polio1' 	        => $pyd_polio1,
		    // 'pyd_polio2' 	        => $pyd_polio2,
		    // 'pyd_polio3' 	        => $pyd_polio3,
		    // 'pyd_polio4' 	        => $pyd_polio4,
		    // 'pyd_campak' 	        => $pyd_campak,
		    // 'pyd_hepatitis1' 	    => $pyd_hepatitis1,
		    // 'pyd_hepatitis2' 	    => $pyd_hepatitis2,
		    // 'pyd_hepatitis3' 	    => $pyd_hepatitis3,
		    'tgl_meninggal_bayi' 	=> $tgl_meninggal_bayi,
		    'keterangan' 	        => $keterangan,
		);

        // if (count($timbangan_bayi_bln) > 0) {
        //     $tinggi_sebelum = 0;
        //     $berat_sebelum  = 0;

        //     for ($i=0; $i < count($timbangan_bayi_bln) ; $i++) { 
        //         $data_timbangan[$i] = array(
        //             'id'                    => $this->Model_global->create_id(), 
        //             'bayi_id'               => $id, 
        //             'bulan'                 => $timbangan_bayi_bln[$i], 
        //             'tahun'                 => $timbangan_bayi_thn[$i], 
        //             'tinggi_sebelum'        => ($tinggi_bayi[$i] > 0 ? $tinggi_sebelum : 0 ), 
        //             'berat_sebelum'         => ($berat_bayi[$i] > 0 ? $berat_sebelum : 0 ), 
        //             'tinggi_sekarang'       => $tinggi_bayi[$i], 
        //             'berat_sekarang'        => $berat_bayi[$i], 
        //             'created_by'            => $created_by, 
        //             'created_on'            => $created_on, 
        //             'updated_by'            => $updated_by, 
        //             'updated_on'            => $updated_on, 
        //         );

        //         $tinggi_sebelum = ($tinggi_bayi[$i] > 0 ? $tinggi_bayi[$i] : $tinggi_sebelum);
        //         $berat_sebelum  = ($berat_bayi[$i] > 0 ? $berat_bayi[$i] : $berat_sebelum);

        //     }
        // }

        // $clear_timbangan_bayi 		= $this->Model_bayi->clear_penimbangan_data_bayi($id, $year_assign);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bayi->save($data);
            // $save_penimbnagan_bayi = $this->Model_bayi->save_penimbangan($data_timbangan);
		}elseif ($save_method == 'Ubah') {
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bayi->update(array('id' => $id), $data);
            // $save_penimbnagan_bayi = $this->Model_bayi->save_penimbangan($data_timbangan);
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
		$pyd_syrp_besi_fe1 		= ($this->input->post('status_pyd_syrp_besi_fe1') ? $this->input->post('pyd_syrp_besi_fe1') : null );
		$pyd_syrp_besi_fe2 		= ($this->input->post('status_pyd_syrp_besi_fe2') ? $this->input->post('pyd_syrp_besi_fe2') : null );
		$pyd_vit_a_bln1 		= ($this->input->post('status_pyd_vit_a_bln1') ? $this->input->post('pyd_vit_a_bln1') : null );
		$pyd_vit_a_bln2 		= ($this->input->post('status_pyd_vit_a_bln2') ? $this->input->post('pyd_vit_a_bln2') : null );
		$pyd_oralit 			= ($this->input->post('status_pyd_oralit') ? $this->input->post('pyd_oralit') : null );
		$pyd_bcg 				= ($this->input->post('status_pyd_bcg') ? $this->input->post('pyd_bcg') : null );
		$pyd_dpt1 				= ($this->input->post('status_pyd_dpt1') ? $this->input->post('pyd_dpt1') : null );
		$pyd_dpt2 				= ($this->input->post('status_pyd_dpt2') ? $this->input->post('pyd_dpt2') : null );
		$pyd_dpt3 				= ($this->input->post('status_pyd_dpt3') ? $this->input->post('pyd_dpt3') : null );
		$pyd_polio1 			= ($this->input->post('status_pyd_polio1') ? $this->input->post('pyd_polio1') : null );
		$pyd_polio2 			= ($this->input->post('status_pyd_polio2') ? $this->input->post('pyd_polio2') : null );
		$pyd_polio3 			= ($this->input->post('status_pyd_polio3') ? $this->input->post('pyd_polio3') : null );
		$pyd_polio4 			= ($this->input->post('status_pyd_polio4') ? $this->input->post('pyd_polio4') : null );
		$pyd_campak 			= ($this->input->post('status_pyd_campak') ? $this->input->post('pyd_campak') : null );
		$pyd_hepatitis1 		= ($this->input->post('status_pyd_hepatitis1') ? $this->input->post('pyd_hepatitis1') : null );
		$pyd_hepatitis2 		= ($this->input->post('status_pyd_hepatitis2') ? $this->input->post('pyd_hepatitis2') : null );
		$pyd_hepatitis3 		= ($this->input->post('status_pyd_hepatitis3') ? $this->input->post('pyd_hepatitis3') : null );
		$tgl_meninggal_bayi 	= ($this->input->post('status_meninggal_bayi') ? $this->input->post('tgl_meninggal_bayi') : null );
		$is_risk 				= ($this->input->post('is_risk') ? 1 : 0 );
		$nama_pic 				= $this->session->userdata('nama');
		$created_by 			= $this->session->userdata('id');
		$created_on 			= date('Y-m-d H:i:s');
		$updated_by 			= $this->session->userdata('id');
		$updated_on 			= date('Y-m-d H:i:s');

        $timbangan_bayi_bln 	= $_POST["timbangan_bayi_bln"];
        $timbangan_bayi_thn 	= $_POST["timbangan_bayi_thn"];
        $tinggi_bayi 			= $_POST["tinggi_bayi"];
        $berat_bayi 			= $_POST["berat_bayi"];

		$data = array(
		    'pyd_syrp_besi_fe1' 	=> $pyd_syrp_besi_fe1,
		    'pyd_syrp_besi_fe2' 	=> $pyd_syrp_besi_fe2,
		    'pyd_vit_a_bln1' 	    => $pyd_vit_a_bln1,
		    'pyd_vit_a_bln2' 	    => $pyd_vit_a_bln2,
		    'pyd_oralit' 	        => $pyd_oralit,
		    'pyd_bcg' 	            => $pyd_bcg,
		    'pyd_dpt1' 	            => $pyd_dpt1,
		    'pyd_dpt2' 	            => $pyd_dpt2,
		    'pyd_dpt3' 	            => $pyd_dpt3,
		    'pyd_polio1' 	        => $pyd_polio1,
		    'pyd_polio2' 	        => $pyd_polio2,
		    'pyd_polio3' 	        => $pyd_polio3,
		    'pyd_polio4' 	        => $pyd_polio4,
		    'pyd_campak' 	        => $pyd_campak,
		    'pyd_hepatitis1' 	    => $pyd_hepatitis1,
		    'pyd_hepatitis2' 	    => $pyd_hepatitis2,
		    'pyd_hepatitis3' 	    => $pyd_hepatitis3,
		    'tgl_meninggal_bayi' 	=> $tgl_meninggal_bayi,
			'is_risk' 					=> $is_risk,
		);

        if (count($timbangan_bayi_bln) > 0) {
            $tinggi_sebelum = 0;
            $berat_sebelum  = 0;

            for ($i=0; $i < count($timbangan_bayi_bln) ; $i++) { 
                $data_timbangan[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'bayi_id'               => $id, 
                    'bulan'                 => $timbangan_bayi_bln[$i], 
                    'tahun'                 => $timbangan_bayi_thn[$i], 
                    'tinggi_sebelum'        => ($tinggi_bayi[$i] > 0 ? $tinggi_sebelum : 0 ), 
                    'berat_sebelum'         => ($berat_bayi[$i] > 0 ? $berat_sebelum : 0 ), 
                    'tinggi_sekarang'       => $tinggi_bayi[$i], 
                    'berat_sekarang'        => $berat_bayi[$i], 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

                $tinggi_sebelum = ($tinggi_bayi[$i] > 0 ? $tinggi_bayi[$i] : $tinggi_sebelum);
                $berat_sebelum  = ($berat_bayi[$i] > 0 ? $berat_bayi[$i] : $berat_sebelum);

            }
        }

        $clear_timbangan_bayi 		= $this->Model_bayi->clear_penimbangan_data_bayi($id, $year_assign);

		$kunjungan_bayi_bln 	= $_POST["kunjungan_bayi_bln"];
        $kunjungan_bayi_thn 	= $_POST["kunjungan_bayi_thn"];
        $kunjungan_val 			= $_POST["kunjungan_val"];
        $keterangan 			= $_POST["keterangan"];

		if (count($kunjungan_bayi_bln) > 0) {

            for ($i=0; $i < count($kunjungan_bayi_bln) ; $i++) { 
                $data_kunjungan[$i] = array(
                    'id'                    => $this->Model_global->create_id(), 
                    'bayi_id'               => $id, 
                    'bulan'                 => $kunjungan_bayi_bln[$i], 
                    'tahun'                 => $kunjungan_bayi_thn[$i], 
                    'is_kunjungan'       	=> (!empty($kunjungan_val[$i])? $kunjungan_val[$i] : 0 ), 
                    'keterangan'        	=> (!empty($keterangan[$i])? $keterangan[$i] : null), 
                    'created_by'            => $created_by, 
                    'created_on'            => $created_on, 
                    'updated_by'            => $updated_by, 
                    'updated_on'            => $updated_on, 
                );

            }
        }

        $clear_kunjungan_bayi 		= $this->Model_bayi->clear_kunjungan_data_bayi($id, $year_assign);

		$save = FALSE;
		if ($save_method == 'Tambah') {
			$data['id'] 			= $id;
			$data['created_by'] 	= $created_by;
			$data['created_on'] 	= $created_on;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bayi->save($data);
            $save_penimbnagan_bayi = $this->Model_bayi->save_penimbangan($data_timbangan);
			$save_kunjungan_bayi = $this->Model_bayi->save_kunjungan($data_kunjungan);
		}elseif ($save_method == 'Ubah') {
			$data['id'] 			= $id;
			$data['updated_by'] 	= $updated_by;
			$data['updated_on'] 	= $updated_on;
			$save = $this->Model_bayi->update(array('id' => $id), $data);
            $save_penimbnagan_bayi = $this->Model_bayi->save_penimbangan($data_timbangan);
			$save_kunjungan_bayi = $this->Model_bayi->save_kunjungan($data_kunjungan);
		}

		$data['clear_timbangan_bayi'] 	= $clear_timbangan_bayi;
		$data['clear_kunjungan_bayi'] 	= $clear_kunjungan_bayi;
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

		$r_bayi = $this->get_data_bayi($id);
		if (empty($r_bayi)) {
			$data['status_save'] 	= FALSE;
			echo json_encode($data);
			return false;
		}

		
		$data['id'] 	= $id;
		$save = $this->Model_bayi->update(array('id' => $id), $data);

		if ($save) {
			$data['status_save'] 	= TRUE;
		}else{
			$data['status_save'] 	= FALSE;
		}
		
		echo json_encode($data);
	}

}