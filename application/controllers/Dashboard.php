<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

		$this->load->model('Model_global','Model_global');
		$this->load->model('Model_posyandu','Model_posyandu');
        /* Restrict user */
        if($this->session->userdata('login_status') != "login_active"){
			redirect(base_url().'login');
		}
    }

	public function index()
	{
        // head data
        $head['title_page'] = 'Dashboard';
        $head['menu_active'] = 'dashboard';
        $head['subMenu_active'] = null;
        $head['pos_session'] = $this->Model_posyandu->get_posyandu();

        // body data
        $data['pages_caption'] = 'Dashboard';
        
		$this->load->view('template/header', $head);
        $this->load->view('dashboard/dashboard_views', $data);
        $this->load->view('template/footer');
	}

    function get_stat_timbangan_bayi() 
    {
		$tahun = ( !empty($this->input->post('filterYear')) ? $this->input->post('filterYear') : date('Y') );
		$bulan = ( !empty($this->input->post('filterMonth')) ? $this->input->post('filterMonth') : date('m') );
        $dataStats = array(
            'stat_tbg_bayi_L' => $this->Model_global->get_timbangan_bayi_total($tahun, 'L'),
            'stat_tbg_bayi_P' => $this->Model_global->get_timbangan_bayi_total($tahun, 'P'),
        );
        
		echo json_encode($dataStats);
    }

    function get_stat_timbangan_balita() 
    {
		$tahun = ( !empty($this->input->post('filterYear')) ? $this->input->post('filterYear') : date('Y') );
		$bulan = ( !empty($this->input->post('filterMonth')) ? $this->input->post('filterMonth') : date('m') );
        $dataStats = array(
            'stat_tbg_balita_L' => $this->Model_global->get_timbangan_balita_total($tahun, 'L'),
            'stat_tbg_balita_P' => $this->Model_global->get_timbangan_balita_total($tahun, 'P'),
        );
        
		echo json_encode($dataStats);
    }

    function get_stat_pelayanan_bayi()
    {
		$tahun = ( !empty($this->input->post('filterYear')) ? $this->input->post('filterYear') : date('Y') );
		$bulan = ( !empty($this->input->post('filterMonth')) ? $this->input->post('filterMonth') : date('m') );
        $dataStats = array(
            'total_pyd_syrp_besi_fe1'   => $this->Model_global->byi_total_pyd_syrp_besi_fe1($tahun, $bulan)->total_pyd_syrp_besi_fe1,
            'total_pyd_syrp_besi_fe2'   => $this->Model_global->byi_total_pyd_syrp_besi_fe2($tahun, $bulan)->total_pyd_syrp_besi_fe2,
            'total_pyd_vit_a_bln1'      => $this->Model_global->byi_total_pyd_vit_a_bln1($tahun, $bulan)->total_pyd_vit_a_bln1,
            'total_pyd_vit_a_bln2'      => $this->Model_global->byi_total_pyd_vit_a_bln2($tahun, $bulan)->total_pyd_vit_a_bln2,
            'total_pyd_oralit'          => $this->Model_global->byi_total_pyd_oralit($tahun, $bulan)->total_pyd_oralit,
            'total_pyd_bcg'             => $this->Model_global->byi_total_pyd_bcg($tahun, $bulan)->total_pyd_bcg,
            'total_pyd_dpt1'            => $this->Model_global->byi_total_pyd_dpt1($tahun, $bulan)->total_pyd_dpt1,
            'total_pyd_dpt2'            => $this->Model_global->byi_total_pyd_dpt2($tahun, $bulan)->total_pyd_dpt2,
            'total_pyd_dpt3'            => $this->Model_global->byi_total_pyd_dpt3($tahun, $bulan)->total_pyd_dpt3,
            'total_pyd_polio1'          => $this->Model_global->byi_total_pyd_polio1($tahun, $bulan)->total_pyd_polio1,
            'total_pyd_polio2'          => $this->Model_global->byi_total_pyd_polio2($tahun, $bulan)->total_pyd_polio2,
            'total_pyd_polio3'          => $this->Model_global->byi_total_pyd_polio3($tahun, $bulan)->total_pyd_polio3,
            'total_pyd_polio4'          => $this->Model_global->byi_total_pyd_polio4($tahun, $bulan)->total_pyd_polio4,
            'total_pyd_campak'          => $this->Model_global->byi_total_pyd_campak($tahun, $bulan)->total_pyd_campak,
            'total_pyd_hepatitis1'      => $this->Model_global->byi_total_pyd_hepatitis1($tahun, $bulan)->total_pyd_hepatitis1,
            'total_pyd_hepatitis2'      => $this->Model_global->byi_total_pyd_hepatitis2($tahun, $bulan)->total_pyd_hepatitis2,
            'total_pyd_hepatitis3'      => $this->Model_global->byi_total_pyd_hepatitis3($tahun, $bulan)->total_pyd_hepatitis3
        );

		echo json_encode($dataStats);
    }

    function get_stat_pelayanan_balita()
    {
		$tahun = ( !empty($this->input->post('filterYear')) ? $this->input->post('filterYear') : date('Y') );
		$bulan = ( !empty($this->input->post('filterMonth')) ? $this->input->post('filterMonth') : date('m') );
        $dataStats = array(
            'total_pyd_syrp_besi_fe1'   => $this->Model_global->blt_total_pyd_syrp_besi_fe1($tahun, $bulan)->total_pyd_syrp_besi_fe1,
            'total_pyd_syrp_besi_fe2'   => $this->Model_global->blt_total_pyd_syrp_besi_fe2($tahun, $bulan)->total_pyd_syrp_besi_fe2,
            'total_pyd_vit_a_bln1'      => $this->Model_global->blt_total_pyd_vit_a_bln1($tahun, $bulan)->total_pyd_vit_a_bln1,
            'total_pyd_vit_a_bln2'      => $this->Model_global->blt_total_pyd_vit_a_bln2($tahun, $bulan)->total_pyd_vit_a_bln2,
            'total_pyd_oralit'          => $this->Model_global->blt_total_pyd_oralit($tahun, $bulan)->total_pyd_oralit,
            'total_pyd_pmt_pemulihan'   => $this->Model_global->blt_total_pyd_pmt_pemulihan($tahun, $bulan)->total_pyd_pmt_pemulihan
        );

		echo json_encode($dataStats);
    }

    function get_top_jumlah_total()
    {
		$tahun = ( !empty($this->input->post('filterYear')) ? $this->input->post('filterYear') : date('Y') );
		$bulan = ( !empty($this->input->post('filterMonth')) ? $this->input->post('filterMonth') : date('m') );

        $dataStats = array(
            'total_pos'         => $this->Model_global->top_total_pos()->total_pos,
            'total_bumil'       => $this->Model_global->top_total_bumil($tahun, $bulan)->total_bumil,
            'total_bayi'        => $this->Model_global->top_total_bayi($tahun, $bulan)->total_bayi,
            'total_balita'      => $this->Model_global->top_total_balita($tahun, $bulan)->total_balita,
        );

		echo json_encode($dataStats);
    }

}
