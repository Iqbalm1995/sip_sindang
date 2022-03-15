<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan6 extends CI_Model {

	private $t_balita	    = 'blt_balita';
	private $t_bayi	            = 'byi_bayi';
	private $t_bumil	    = 'bml_bumil';
        private $t_bumlin	    = 'bdb_bumlin';
	private $t_wuspus	    = 'wsp_wuspus';
	private $t_posyandu         = 'pos_posyandu';
        private $t_desa		    = 'mst_desa';
        private $t_month	    = 'const_month';

	private $t_kunjungan_balita	= 'blt_kunjungan_balita';
	private $t_kunjungan_bayi	= 'byi_kunjungan_bayi';
	private $t_kunjungan_bumil	= 'bml_kunjungan_bumil';
	private $t_kunjungan_bumlin	= 'bdb_kunjungan_bumlin';
	private $t_kunjungan_wuspus	= 'wsp_kunjungan_wuspus';

	var $column_order = array(null, 'no', 'bulan'); //set column field database for datatable orderable
	var $column_search = array('no','bulan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('cm.id' => 'asc'); // default order 

    
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

        public function get_laporan6($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}

                if (!empty($this->session->userdata('pos_id'))) {
                        $pos_id = $this->session->userdata('pos_id');
                }else{
                        $pos_id = null;
                }

                // START QUERY LAPORAN 6

                //byi_L_0_12bln_new
                $subQuery_1_New_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_1_New_L_comp = $subQuery_1_New_L->get_compiled_select();

                //byi_P_0_12bln_new
                $subQuery_1_New_P = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_1_New_P_comp = $subQuery_1_New_P->get_compiled_select();

                
                //byi_L_0_12bln_old
                $subQuery_2_Old_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_2_Old_L_comp = $subQuery_2_Old_L->get_compiled_select();

                //byi_P_0_12bln_old
                $subQuery_2_Old_P = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_2_Old_P_comp = $subQuery_2_Old_P->get_compiled_select();


                //blt_L_1_5thn_new
                $subQuery_3_Old_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_3_Old_L_comp = $subQuery_3_Old_L->get_compiled_select();

                //blt_P_1_5thn_new
                $subQuery_3_Old_P = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_3_Old_P_comp = $subQuery_3_Old_P->get_compiled_select();


                //blt_L_1_5thn_old
                $subQuery_4_Old_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_4_Old_L_comp = $subQuery_4_Old_L->get_compiled_select();

                //blt_P_1_5thn_old
                $subQuery_4_Old_P = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_4_Old_P_comp = $subQuery_4_Old_P->get_compiled_select();




                //wus
                $subQuery_5 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_wuspus.' b')
                                        ->join($this->t_kunjungan_wuspus.' bk', 'b.id = bk.wuspus_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('bk.wus_pus', 'WUS');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_5_comp = $subQuery_5->get_compiled_select();

                //pus
                $subQuery_6 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_wuspus.' b')
                                        ->join($this->t_kunjungan_wuspus.' bk', 'b.id = bk.wuspus_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('bk.wus_pus', 'PUS');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_6_comp = $subQuery_6->get_compiled_select();

                //ibu_hamil
                $subQuery_7 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_bumil.' b')
                                        ->join($this->t_kunjungan_bumil.' bk', 'b.id = bk.bumil_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.tgl_lahir_bayi', null);
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_7_comp = $subQuery_7->get_compiled_select();

                //ibu_menyusui
                $subQuery_8 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_bumlin.' b')
                                        ->join($this->t_kunjungan_bumlin.' bk', 'b.id = bk.bumlin_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.ibu_menyusui', '1');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_8_comp = $subQuery_8->get_compiled_select();

                //bayi_lahir_L
                $subQuery_9 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(lahir_tanggal) = cm.label_id')
                                        ->where('YEAR(lahir_tanggal)', $tahun)
                                        ->where('bayi_jk', 'L');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_9_comp = $subQuery_9->get_compiled_select();

                //bayi_lahir_P
                $subQuery_10 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(lahir_tanggal) = cm.label_id')
                                        ->where('YEAR(lahir_tanggal)', $tahun)
                                        ->where('bayi_jk', 'P');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_10_comp = $subQuery_10->get_compiled_select();

                //bayi_meninggal_L
                $subQuery_11 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(bayi_meninggal) = cm.label_id')
                                        ->where('YEAR(bayi_meninggal)', $tahun)
                                        ->where('bayi_jk', 'L');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_11_comp = $subQuery_11->get_compiled_select();

                //bayi_meninggal_P
                $subQuery_12 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(bayi_meninggal) = cm.label_id')
                                        ->where('YEAR(bayi_meninggal)', $tahun)
                                        ->where('bayi_jk', 'P');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_12_comp = $subQuery_12->get_compiled_select();



                $this->db->select('cm.label_id AS "no", cm.name AS "bulan"');
                $this->db->select('('.$subQuery_1_New_L_comp.') AS "byi_L_0_12bln_new"');
                $this->db->select('('.$subQuery_1_New_P_comp.') AS "byi_P_0_12bln_new"');
                $this->db->select('('.$subQuery_2_Old_L_comp.') AS "byi_L_0_12bln_old"');
                $this->db->select('('.$subQuery_2_Old_P_comp.') AS "byi_P_0_12bln_old"');

                $this->db->select('('.$subQuery_3_Old_L_comp.') AS "blt_L_1_5thn_new"');
                $this->db->select('('.$subQuery_3_Old_P_comp.') AS "blt_P_1_5thn_new"');

                $this->db->select('('.$subQuery_4_Old_L_comp.') AS "blt_L_1_5thn_old"');
                $this->db->select('('.$subQuery_4_Old_P_comp.') AS "blt_P_1_5thn_old"');


                $this->db->select('('.$subQuery_5_comp.') AS "wus"');
                $this->db->select('('.$subQuery_6_comp.') AS "pus"');
                $this->db->select('('.$subQuery_7_comp.') AS "ibu_hamil"');
                $this->db->select('('.$subQuery_8_comp.') AS "ibu_menyusui"');
                $this->db->select('('.$subQuery_9_comp.') AS "bayi_lahir_L"');
                $this->db->select('('.$subQuery_10_comp.') AS "bayi_lahir_P"');
                $this->db->select('('.$subQuery_11_comp.') AS "bayi_meninggal_L"');
                $this->db->select('('.$subQuery_12_comp.') AS "bayi_meninggal_P"');
                $this->db->from($this->t_month.' cm');

                // END QUERY LAPORAN 6

		$this->db->order_by('cm.id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
    

        private function _get_datatables_query()
	{

		if($this->input->post('filterTahun')) { 
			$tahun = $this->input->post('filterTahun');
		}else{
			$tahun = date('Y');
                }

                if (!empty($this->session->userdata('pos_id'))) {
                        $pos_id = $this->session->userdata('pos_id');
                }else{
                        $pos_id = null;
                }

                // START QUERY LAPORAN 6

                //byi_L_0_12bln_new
                $subQuery_1_New_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_1_New_L_comp = $subQuery_1_New_L->get_compiled_select();

                //byi_P_0_12bln_new
                $subQuery_1_New_P = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_1_New_P_comp = $subQuery_1_New_P->get_compiled_select();

                
                //byi_L_0_12bln_old
                $subQuery_2_Old_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_2_Old_L_comp = $subQuery_2_Old_L->get_compiled_select();

                //byi_P_0_12bln_old
                $subQuery_2_Old_P = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_bayi.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_bayi', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_2_Old_P_comp = $subQuery_2_Old_P->get_compiled_select();


                //blt_L_1_5thn_new
                $subQuery_3_Old_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_3_Old_L_comp = $subQuery_3_Old_L->get_compiled_select();

                //blt_P_1_5thn_new
                $subQuery_3_Old_P = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) = '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_3_Old_P_comp = $subQuery_3_Old_P->get_compiled_select();


                //blt_L_1_5thn_old
                $subQuery_4_Old_L = $this->db->select('COUNT(b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'L');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_4_Old_L_comp = $subQuery_4_Old_L->get_compiled_select();

                //blt_P_1_5thn_old
                $subQuery_4_Old_P = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from('( SELECT * FROM '.$this->t_balita.' WHERE YEAR(created_on) < '.$tahun.' ) b')
                                        ->join($this->t_kunjungan_balita.' bk', 'b.id = bk.balita_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.jk_anak', 'P');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_4_Old_P_comp = $subQuery_4_Old_P->get_compiled_select();




                
                //wus
                $subQuery_5 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_wuspus.' b')
                                        ->join($this->t_kunjungan_wuspus.' bk', 'b.id = bk.wuspus_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('bk.wus_pus', 'WUS');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_5_comp = $subQuery_5->get_compiled_select();

                //pus
                $subQuery_6 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_wuspus.' b')
                                        ->join($this->t_kunjungan_wuspus.' bk', 'b.id = bk.wuspus_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('bk.wus_pus', 'PUS');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_6_comp = $subQuery_6->get_compiled_select();

                //ibu_hamil
                $subQuery_7 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_bumil.' b')
                                        ->join($this->t_kunjungan_bumil.' bk', 'b.id = bk.bumil_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.tgl_lahir_bayi', null);
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_7_comp = $subQuery_7->get_compiled_select();

                //ibu_menyusui
                $subQuery_8 = $this->db->select('COUNT(DISTINCT b.id)')
                                        ->from($this->t_bumlin.' b')
                                        ->join($this->t_kunjungan_bumlin.' bk', 'b.id = bk.bumlin_id')
                                        ->where('b.deleted', 0)
                                        ->where('bk.bulan = cm.label_id')
                                        ->where('bk.tahun', $tahun)
                                        ->where('bk.is_kunjungan', 1)
                                        ->where('b.ibu_menyusui', '1');
                                        if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
                $subQuery_8_comp = $subQuery_8->get_compiled_select();

                //bayi_lahir_L
                $subQuery_9 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(lahir_tanggal) = cm.label_id')
                                        ->where('YEAR(lahir_tanggal)', $tahun)
                                        ->where('bayi_jk', 'L');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_9_comp = $subQuery_9->get_compiled_select();

                //bayi_lahir_P
                $subQuery_10 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(lahir_tanggal) = cm.label_id')
                                        ->where('YEAR(lahir_tanggal)', $tahun)
                                        ->where('bayi_jk', 'P');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_10_comp = $subQuery_10->get_compiled_select();

                //bayi_meninggal_L
                $subQuery_11 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(bayi_meninggal) = cm.label_id')
                                        ->where('YEAR(bayi_meninggal)', $tahun)
                                        ->where('bayi_jk', 'L');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_11_comp = $subQuery_11->get_compiled_select();

                //bayi_meninggal_P
                $subQuery_12 = $this->db->select('COUNT(id)')
                                        ->from($this->t_bumlin)
                                        ->where('deleted', 0)
                                        ->where('MONTH(bayi_meninggal) = cm.label_id')
                                        ->where('YEAR(bayi_meninggal)', $tahun)
                                        ->where('bayi_jk', 'P');
                                        if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
                $subQuery_12_comp = $subQuery_12->get_compiled_select();



                $this->db->select('cm.label_id AS "no", cm.name AS "bulan"');
                $this->db->select('('.$subQuery_1_New_L_comp.') AS "byi_L_0_12bln_new"');
                $this->db->select('('.$subQuery_1_New_P_comp.') AS "byi_P_0_12bln_new"');
                $this->db->select('('.$subQuery_2_Old_L_comp.') AS "byi_L_0_12bln_old"');
                $this->db->select('('.$subQuery_2_Old_P_comp.') AS "byi_P_0_12bln_old"');

                $this->db->select('('.$subQuery_3_Old_L_comp.') AS "blt_L_1_5thn_new"');
                $this->db->select('('.$subQuery_3_Old_P_comp.') AS "blt_P_1_5thn_new"');
                $this->db->select('('.$subQuery_4_Old_L_comp.') AS "blt_L_1_5thn_old"');
                $this->db->select('('.$subQuery_4_Old_P_comp.') AS "blt_P_1_5thn_old"');


                $this->db->select('('.$subQuery_5_comp.') AS "wus"');
                $this->db->select('('.$subQuery_6_comp.') AS "pus"');
                $this->db->select('('.$subQuery_7_comp.') AS "ibu_hamil"');
                $this->db->select('('.$subQuery_8_comp.') AS "ibu_menyusui"');
                $this->db->select('('.$subQuery_9_comp.') AS "bayi_lahir_L"');
                $this->db->select('('.$subQuery_10_comp.') AS "bayi_lahir_P"');
                $this->db->select('('.$subQuery_11_comp.') AS "bayi_meninggal_L"');
                $this->db->select('('.$subQuery_12_comp.') AS "bayi_meninggal_P"');
                $this->db->from($this->t_month.' cm');

                // END QUERY LAPORAN 6


		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->t_month);
		return $this->db->count_all_results();
	}

    
	
}