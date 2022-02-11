<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_posyandu','Model_posyandu');
		$this->load->model('Model_desa','Model_desa');
		$this->load->model('Model_user','Model_user');
		$this->load->model('Model_global','Model_global');
		$this->load->model('Model_laporan6','Model_laporan6');
		$this->load->model('Model_laporan7','Model_laporan7');

        /* Restrict user */
        if($this->session->userdata('login_status') != "login_active"){
			redirect(base_url().'login');
		}

		if (!in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_SUBLV1)) {
			redirect(base_url().'dashboard');
		}
    }


	public function format6()
	{
        // head data
        $head['title_page']     = 'Data Laporan Format 6';
        $head['menu_active']    = 'laporan_pos_1';
        $head['subMenu_active'] = '';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Bumil Dan Bulin';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
        
		$this->load->view('template/header', $head);
        $this->load->view('laporan/laporan_pos_1_views', $data);
        $this->load->view('template/footer');
	}

	public function export_laporan6($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}

		$pos_name 	= $this->session->userdata('pos_name');
		$desa_name 	= $this->session->userdata('desa');

		$list = $this->Model_laporan6->get_laporan6($tahun);

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
                $row['bulan']          			= $r->bulan;

                $row['byi_L_0_12bln_new']          	= $r->byi_L_0_12bln_new;
                $row['byi_P_0_12bln_new']        	= $r->byi_P_0_12bln_new;
                $row['byi_L_0_12bln_old']        	= $r->byi_L_0_12bln_old;
                $row['byi_P_0_12bln_old']   		= $r->byi_P_0_12bln_old;

                $row['blt_L_1_5thn_new']          	= $r->blt_L_1_5thn_new;
                $row['blt_P_1_5thn_new']        	= $r->blt_P_1_5thn_new;
                $row['blt_L_1_5thn_old']        	= $r->blt_L_1_5thn_old;
                $row['blt_P_1_5thn_old']   			= $r->blt_P_1_5thn_old;


                $row['wus']          			= $r->wus;
                $row['pus']      				= $r->pus;
                $row['ibu_hamil']       		= $r->ibu_hamil;
                $row['ibu_menyusui']      		= $r->ibu_menyusui;
                $row['bayi_lahir_L']      		= $r->bayi_lahir_L;
                $row['bayi_lahir_P']      		= $r->bayi_lahir_P;
                $row['bayi_meninggal_L']      	= $r->bayi_meninggal_L;
                $row['bayi_meninggal_P']      	= $r->bayi_meninggal_P;
                
                $data_report[]              	= $row;
            }
		}

		
        $data['filterTahun'] = $tahun;
        $data['report'] = $data_report;

		// echo "<pre>";
		// print_r($data_report);
		// echo "</pre>";

        $this->load->view('laporan/laporan_pos_1_export', $data);

	}


	public function format7()
	{
        // head data
        $head['title_page']     = 'Data Laporan Format 7';
        $head['menu_active']    = 'laporan_pos_2';
        $head['subMenu_active'] = '';
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption']  = 'Data Bumil Dan Bulin';

		$data['data_pos']  	    = $this->Model_posyandu->get_posyandu();
		$data['data_laporan7']  = $this->get_data_laporan7();
        
		$this->load->view('template/header', $head);
        $this->load->view('laporan/laporan_pos_2_views', $data);
        $this->load->view('template/footer');
	}

	public function export_laporan7($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}

		$pos_name 	= $this->session->userdata('pos_name');
		$desa_name 	= $this->session->userdata('desa');

		$list = $this->Model_laporan7->get_laporan7($tahun);

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
                $row['no']  						= $no;
                $row['bulan']          				= $r->bulan;
                $row['Ibu_hamil']          			= $r->Ibu_hamil;
                $row['diperiksa']          			= $r->diperiksa;
                $row['jml_FE_besi']        			= $r->jml_FE_besi;
                $row['menyusui']        			= $r->menyusui;

                $row['kb_kondom']   				= $r->kb_kondom;
                $row['kb_pil']          			= $r->kb_pil;
                $row['kb_implant']      			= $r->kb_implant;
                $row['kb_mop']       				= $r->kb_mop;
                $row['kb_mow']      				= $r->kb_mow;
                $row['kb_iud']      				= $r->kb_iud;
                $row['kb_suntik']      				= $r->kb_suntik;
                $row['kb_lainlain']      			= $r->kb_lainlain;

                $row['jml_balita_L']      			= $r->jml_balita_L;
                $row['jml_balita_P']      			= $r->jml_balita_P;

                $row['jml_balita_timbang_L']      	= $r->jml_balita_timbang_L;
                $row['jml_balita_timbang_P']      	= $r->jml_balita_timbang_P;

                $row['jml_balita_timbang_naik_L']   = $r->jml_balita_timbang_naik_L;
                $row['jml_balita_timbang_naik_P']   = $r->jml_balita_timbang_naik_P;

                $row['jml_vitA_L']      			= $r->jml_vitA_L;
                $row['jml_vitA_P']      			= $r->jml_vitA_P;

                $row['jml_dapat_pmt_L']      		= $r->jml_dapat_pmt_L;
                $row['jml_dapat_pmt_P']      		= $r->jml_dapat_pmt_P;

                $row['jml_imni_tt_1']      			= $r->jml_imni_tt_1;
                $row['jml_imni_tt_2']      			= $r->jml_imni_tt_2;

                $row['jml_bcg_L']      				= $r->jml_bcg_L;
                $row['jml_bcg_P']      				= $r->jml_bcg_P;

                $row['jml_dpt_1_L']      			= $r->jml_dpt_1_L;
                $row['jml_dpt_1_P']      			= $r->jml_dpt_1_P;
                $row['jml_dpt_2_L']      			= $r->jml_dpt_2_L;
                $row['jml_dpt_2_P']      			= $r->jml_dpt_2_P;
                $row['jml_dpt_3_L']      			= $r->jml_dpt_3_L;
                $row['jml_dpt_3_L']      			= $r->jml_dpt_3_L;

                $row['jml_polio_1_L']      			= $r->jml_polio_1_L;
                $row['jml_polio_1_P']      			= $r->jml_polio_1_P;
                $row['jml_polio_2_L']      			= $r->jml_polio_2_L;
                $row['jml_polio_2_P']      			= $r->jml_polio_2_P;
                $row['jml_polio_3_L']      			= $r->jml_polio_3_L;
                $row['jml_polio_3_P']      			= $r->jml_polio_3_P;
                $row['jml_polio_4_L']      			= $r->jml_polio_4_L;
                $row['jml_polio_4_P']      			= $r->jml_polio_4_P;

                $row['jml_campak_L']      			= $r->jml_campak_L;
                $row['jml_campak_P']      			= $r->jml_campak_P;

                $row['jml_hepatitis_1_L']      		= $r->jml_hepatitis_1_L;
                $row['jml_hepatitis_1_P']      		= $r->jml_hepatitis_1_P;
                $row['jml_hepatitis_2_L']      		= $r->jml_hepatitis_2_L;
                $row['jml_hepatitis_2_P']      		= $r->jml_hepatitis_2_P;
                $row['jml_hepatitis_3_L']      		= $r->jml_hepatitis_3_L;
                $row['jml_hepatitis_3_P']      		= $r->jml_hepatitis_3_P;

                $row['jml_diare_L']      			= $r->jml_diare_L;
                $row['jml_diare_P']      			= $r->jml_diare_P;

                $row['jml_punya_kms_L']      		= $r->jml_punya_kms_L;
                $row['jml_punya_kms_P']      		= $r->jml_punya_kms_P;
                
                $data_report[]              	= $row;
            }
		}

		
        $data['filterTahun'] = $tahun;
        $data['report'] = $data_report;

		// echo "<pre>";
		// print_r($data_report);
		// echo "</pre>";

        $this->load->view('laporan/laporan_pos_2_export', $data);

	}

    public function get_data_laporan7(){
		$data = $this->Model_laporan7->get_laporan7();
		return $data;
	}

    public function get_data_laporan6(){
		$data = $this->Model_laporan6->get_laporan6();
		return $data;
	}

    public function datatable_list_laporan6()
	{
		$list = $this->Model_laporan6->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->bulan;
			$row[] = '<div class="text-center">'.$r->byi_L_0_12bln_new.'</div>';
			$row[] = '<div class="text-center">'.$r->byi_P_0_12bln_new.'</div>';
			$row[] = '<div class="text-center">'.$r->byi_L_0_12bln_old.'</div>';
			$row[] = '<div class="text-center">'.$r->byi_P_0_12bln_old.'</div>';

			$row[] = '<div class="text-center">'.$r->blt_L_1_5thn_new.'</div>';
			$row[] = '<div class="text-center">'.$r->blt_P_1_5thn_new.'</div>';
			$row[] = '<div class="text-center">'.$r->blt_L_1_5thn_old.'</div>';
			$row[] = '<div class="text-center">'.$r->blt_P_1_5thn_old.'</div>';

			$row[] = '<div class="text-center">'.$r->wus.'</div>';
			$row[] = '<div class="text-center">'.$r->pus.'</div>';
			$row[] = '<div class="text-center">'.$r->ibu_hamil.'</div>';
			$row[] = '<div class="text-center">'.$r->ibu_menyusui.'</div>';

			$row[] = '<div class="text-center">'.$r->bayi_lahir_L.'</div>';
			$row[] = '<div class="text-center">'.$r->bayi_lahir_P.'</div>';

			$row[] = '<div class="text-center">'.$r->bayi_meninggal_L.'</div>';
			$row[] = '<div class="text-center">'.$r->bayi_meninggal_P.'</div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_laporan6->count_all(),
						"recordsFiltered" => $this->Model_laporan6->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function datatable_list_laporan7()
	{
		$list = $this->Model_laporan7->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r) {
			$no++;
			$row = array();

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->bulan;

			$row[] = '<div class="text-center">'.$r->Ibu_hamil.'</div>';
			$row[] = '<div class="text-center">'.$r->diperiksa.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_FE_besi.'</div>';
			$row[] = '<div class="text-center">'.$r->menyusui.'</div>';

			$row[] = '<div class="text-center">'.$r->kb_kondom.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_pil.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_implant.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_mop.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_mow.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_iud.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_suntik.'</div>';
			$row[] = '<div class="text-center">'.$r->kb_lainlain.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_balita_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_balita_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_punya_kms_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_punya_kms_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_balita_timbang_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_balita_timbang_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_balita_timbang_naik_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_balita_timbang_naik_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_vitA_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_vitA_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_dapat_pmt_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_dapat_pmt_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_imni_tt_1.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_imni_tt_2.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_bcg_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_bcg_P.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_dpt_1_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_dpt_1_P.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_dpt_2_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_dpt_2_P.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_dpt_3_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_dpt_3_L.'</div>';

			$row[] = '<div class="text-center">'.$r->jml_polio_1_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_1_P.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_2_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_2_P.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_3_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_3_P.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_4_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_polio_4_P.'</div>';
			
			$row[] = '<div class="text-center">'.$r->jml_campak_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_campak_P.'</div>';
			
			$row[] = '<div class="text-center">'.$r->jml_hepatitis_1_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_hepatitis_1_P.'</div>';
			
			$row[] = '<div class="text-center">'.$r->jml_hepatitis_2_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_hepatitis_2_P.'</div>';
			
			$row[] = '<div class="text-center">'.$r->jml_hepatitis_3_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_hepatitis_3_P.'</div>';
			
			$row[] = '<div class="text-center">'.$r->jml_diare_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_diare_P.'</div>';
			
			$row[] = '<div class="text-center">'.$r->jml_diare_L.'</div>';
			$row[] = '<div class="text-center">'.$r->jml_diare_P.'</div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_laporan7->count_all(),
						"recordsFiltered" => $this->Model_laporan7->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}




}