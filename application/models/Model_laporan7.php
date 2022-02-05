<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan7 extends CI_Model {

	private $t_balita	    = 'blt_balita';
	private $t_bayi	        = 'byi_bayi';
	private $t_bumil	    = 'bml_bumil';
    private $t_bumlin	    = 'bdb_bumlin';
	private $t_wuspus	    = 'wsp_wuspus';
	private $t_posyandu		= 'pos_posyandu';
    private $t_desa		    = 'mst_desa';
    private $t_month	    = 'const_month';

	private $t_akseptor_wuspus	= 'wsp_akseptor_wuspus';
	private $t_penimbangan_balita	= 'blt_penimbangan_balita';


	var $column_order = array(null, 'no', 'bulan'); //set column field database for datatable orderable
	var $column_search = array('no','bulan'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('cm.id' => 'asc'); // default order 

    
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function get_laporan7($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}

        if (!empty($this->session->userdata('pos_id'))) {
                $pos_id = $this->session->userdata('pos_id');
        }else{
                $pos_id = null;
        }

       
        //Ibu_hamil
        $subQuery_1 = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('lahir_tanggal', Null);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_1_comp = $subQuery_1->get_compiled_select();

        //diperiksa
        $subQuery_2 = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(tgl_pendaftaran) = cm.label_id')
                                ->where('YEAR(tgl_pendaftaran)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_2_comp = $subQuery_2->get_compiled_select();

        //menyusui
        $subQuery_3 = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('ibu_menyusui', 1);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_3_comp = $subQuery_3->get_compiled_select();

        //kb_kondom
        $subQuery_4 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Kondom');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_4_comp = $subQuery_4->get_compiled_select();

        //kb_pil
        $subQuery_5 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Pil');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_5_comp = $subQuery_5->get_compiled_select();

        //kb_implant
        $subQuery_6 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Implant');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_6_comp = $subQuery_6->get_compiled_select();

        //kb_mop
        $subQuery_7 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'MOP');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_7_comp = $subQuery_7->get_compiled_select();

        //kb_mow
        $subQuery_8 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'MOW');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_8_comp = $subQuery_8->get_compiled_select();

        //kb_iud
        $subQuery_9 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'IUD');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_9_comp = $subQuery_9->get_compiled_select();

        //kb_suntik
        $subQuery_10 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Suntik');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_10_comp = $subQuery_10->get_compiled_select();

        //kb_lainlain
        $subQuery_11 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Lain-lain');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_11_comp = $subQuery_11->get_compiled_select();

        //jml_balita_L
        $subQuery_12 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_12_comp = $subQuery_12->get_compiled_select();

        //jml_balita_P
        $subQuery_13 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_13_comp = $subQuery_13->get_compiled_select();

        //jml_balita_timbang_L
        $subQuery_14 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'L')
                                ->where('pb.berat_sekarang >', 0);
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_14_comp = $subQuery_14->get_compiled_select();

        //jml_balita_timbang_P
        $subQuery_15 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'P')
                                ->where('pb.berat_sekarang >', 0);
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_15_comp = $subQuery_15->get_compiled_select();

        //jml_balita_timbang_naik_L
        $subQuery_16 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'L')
                                ->where('pb.berat_sebelum >', 0)
                                ->where('pb.berat_sebelum < pb.berat_sekarang');
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_16_comp = $subQuery_16->get_compiled_select();

        //jml_balita_timbang_naik_P
        $subQuery_17 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'P')
                                ->where('pb.berat_sebelum >', 0)
                                ->where('pb.berat_sebelum < pb.berat_sekarang');
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_17_comp = $subQuery_17->get_compiled_select();

        //jml_vitA_L
        $subQuery_18a = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln1) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln1)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_18a_comp = $subQuery_18a->get_compiled_select();

        $subQuery_18b = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln2) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln2)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_18b_comp = $subQuery_18b->get_compiled_select();

        //jml_vitA_P
        $subQuery_19a = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln1) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln1)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_19a_comp = $subQuery_19a->get_compiled_select();

        $subQuery_19b = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln2) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln2)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_19b_comp = $subQuery_19b->get_compiled_select();
        
        //jml_dapat_pmt_L
        $subQuery_20 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_pmt_pemulihan) = cm.label_id')
                                ->where('YEAR(pyd_pmt_pemulihan)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_20_comp = $subQuery_20->get_compiled_select();

        //jml_dapat_pmt_P
        $subQuery_21 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_pmt_pemulihan) = cm.label_id')
                                ->where('YEAR(pyd_pmt_pemulihan)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_21_comp = $subQuery_21->get_compiled_select();

        //jml_imni_tt_1
        $subQuery_21a = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_imsi1) = cm.label_id')
                                ->where('YEAR(pyd_imsi1)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_21a_comp = $subQuery_21a->get_compiled_select();


        //jml_imni_tt_2
        $subQuery_21b = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_imsi2) = cm.label_id')
                                ->where('YEAR(pyd_imsi2)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_21b_comp = $subQuery_21b->get_compiled_select();

        //jml_bcg_L
        $subQuery_22a = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_bcg) = cm.label_id')
                                ->where('YEAR(pyd_bcg)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_22a_comp = $subQuery_22a->get_compiled_select();

        //jml_bcg_P
        $subQuery_22b = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_bcg) = cm.label_id')
                                ->where('YEAR(pyd_bcg)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_22b_comp = $subQuery_22b->get_compiled_select();

        //jml_dpt_1_L
        $subQuery_23 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt1) = cm.label_id')
                                ->where('YEAR(pyd_dpt1)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_23_comp = $subQuery_23->get_compiled_select();

        //jml_dpt_1_P
        $subQuery_24 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt1) = cm.label_id')
                                ->where('YEAR(pyd_dpt1)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_24_comp = $subQuery_24->get_compiled_select();

        //jml_dpt_2_L
        $subQuery_25 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt2) = cm.label_id')
                                ->where('YEAR(pyd_dpt2)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_25_comp = $subQuery_25->get_compiled_select();

        //jml_dpt_2_P
        $subQuery_26 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt2) = cm.label_id')
                                ->where('YEAR(pyd_dpt2)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_26_comp = $subQuery_26->get_compiled_select();

        //jml_dpt_3_L
        $subQuery_27 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt3) = cm.label_id')
                                ->where('YEAR(pyd_dpt3)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_27_comp = $subQuery_27->get_compiled_select();

        //jml_dpt_3_P
        $subQuery_28 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt3) = cm.label_id')
                                ->where('YEAR(pyd_dpt3)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_28_comp = $subQuery_28->get_compiled_select();

        //jml_polio_1_L
        $subQuery_29 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio1) = cm.label_id')
                                ->where('YEAR(pyd_polio1)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_29_comp = $subQuery_29->get_compiled_select();

        //jml_polio_1_P
        $subQuery_30 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio1) = cm.label_id')
                                ->where('YEAR(pyd_polio1)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_30_comp = $subQuery_30->get_compiled_select();

        //jml_polio_2_L
        $subQuery_31 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio2) = cm.label_id')
                                ->where('YEAR(pyd_polio2)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_31_comp = $subQuery_31->get_compiled_select();

        //jml_polio_2_P
        $subQuery_32 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio2) = cm.label_id')
                                ->where('YEAR(pyd_polio2)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_32_comp = $subQuery_32->get_compiled_select();

        //jml_polio_3_L
        $subQuery_33 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio3) = cm.label_id')
                                ->where('YEAR(pyd_polio3)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_33_comp = $subQuery_33->get_compiled_select();

        //jml_polio_3_P
        $subQuery_34 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio3) = cm.label_id')
                                ->where('YEAR(pyd_polio3)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_34_comp = $subQuery_34->get_compiled_select();

        //jml_polio_4_L
        $subQuery_35 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio4) = cm.label_id')
                                ->where('YEAR(pyd_polio4)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_35_comp = $subQuery_35->get_compiled_select();

        //jml_polio_4_P
        $subQuery_36 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio4) = cm.label_id')
                                ->where('YEAR(pyd_polio4)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_36_comp = $subQuery_36->get_compiled_select();

        //jml_campak_L
        $subQuery_37 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_campak) = cm.label_id')
                                ->where('YEAR(pyd_campak)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_37_comp = $subQuery_37->get_compiled_select();

        //jml_campak_P
        $subQuery_38 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_campak) = cm.label_id')
                                ->where('YEAR(pyd_campak)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_38_comp = $subQuery_38->get_compiled_select();

        //jml_hepatitis_1_L
        $subQuery_39 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis1) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis1)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_39_comp = $subQuery_39->get_compiled_select();

        //jml_hepatitis_1_P
        $subQuery_40 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis1) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis1)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_40_comp = $subQuery_40->get_compiled_select();

        //jml_hepatitis_2_L
        $subQuery_41 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis2) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis2)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_41_comp = $subQuery_41->get_compiled_select();

        //jml_hepatitis_2_P
        $subQuery_42 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis2) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis2)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_42_comp = $subQuery_42->get_compiled_select();

        //jml_hepatitis_3_L
        $subQuery_43 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis3) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis3)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_43_comp = $subQuery_43->get_compiled_select();

        //jml_hepatitis_3_P
        $subQuery_44 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis3) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis3)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_44_comp = $subQuery_44->get_compiled_select();

        //jml_diare_L
        $subQuery_45 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_oralit) = cm.label_id')
                                ->where('YEAR(pyd_oralit)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_45_comp = $subQuery_45->get_compiled_select();

        //jml_diare_P
        $subQuery_46 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_oralit) = cm.label_id')
                                ->where('YEAR(pyd_oralit)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_46_comp = $subQuery_46->get_compiled_select();

        //jml_punya_kms_L
        $subQuery_47 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'L')
                                ->where('kms !=', null);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_47_comp = $subQuery_47->get_compiled_select();

        //jml_punya_kms_P
        $subQuery_48 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'P')
                                ->where('kms !=', null);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_48_comp = $subQuery_48->get_compiled_select();

        //jml_FE_besi
        $subQuery_49a = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_ptdh_fe1) = cm.label_id')
                                ->where('YEAR(pyd_ptdh_fe1)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_49a_comp = $subQuery_49a->get_compiled_select();

        $subQuery_49b = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_ptdh_fe2) = cm.label_id')
                                ->where('YEAR(pyd_ptdh_fe2)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_49b_comp = $subQuery_49b->get_compiled_select();

        $subQuery_49c = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_ptdh_fe3) = cm.label_id')
                                ->where('YEAR(pyd_ptdh_fe3)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_49c_comp = $subQuery_49c->get_compiled_select();



        $this->db->select('cm.label_id AS "no", cm.name AS "bulan"');
        $this->db->select('('.$subQuery_1_comp.') AS "Ibu_hamil"');
        $this->db->select('('.$subQuery_2_comp.') AS "diperiksa"');
        $this->db->select('(('.$subQuery_49a_comp.') + ('.$subQuery_49b_comp.') + ('.$subQuery_49c_comp.')) AS "jml_FE_besi"');
        $this->db->select('('.$subQuery_3_comp.') AS "menyusui"');
        $this->db->select('('.$subQuery_4_comp.') AS "kb_kondom"');
        $this->db->select('('.$subQuery_5_comp.') AS "kb_pil"');
        $this->db->select('('.$subQuery_6_comp.') AS "kb_implant"');
        $this->db->select('('.$subQuery_7_comp.') AS "kb_mop"');
        $this->db->select('('.$subQuery_8_comp.') AS "kb_mow"');
        $this->db->select('('.$subQuery_9_comp.') AS "kb_iud"');
        $this->db->select('('.$subQuery_10_comp.') AS "kb_suntik"');
        $this->db->select('('.$subQuery_11_comp.') AS "kb_lainlain"');
        $this->db->select('('.$subQuery_12_comp.') AS "jml_balita_L"');
        $this->db->select('('.$subQuery_13_comp.') AS "jml_balita_P"');
        $this->db->select('('.$subQuery_14_comp.') AS "jml_balita_timbang_L"');
        $this->db->select('('.$subQuery_15_comp.') AS "jml_balita_timbang_P"');
        $this->db->select('('.$subQuery_16_comp.') AS "jml_balita_timbang_naik_L"');
        $this->db->select('('.$subQuery_17_comp.') AS "jml_balita_timbang_naik_P"');
        $this->db->select('(('.$subQuery_18a_comp.') + ('.$subQuery_18b_comp.')) AS "jml_vitA_L"');
        $this->db->select('(('.$subQuery_19a_comp.') + ('.$subQuery_19b_comp.')) AS "jml_vitA_P"');
        $this->db->select('('.$subQuery_20_comp.') AS "jml_dapat_pmt_L"');
        $this->db->select('('.$subQuery_21_comp.') AS "jml_dapat_pmt_P"');
        $this->db->select('('.$subQuery_21a_comp.') AS "jml_imni_tt_1"');
        $this->db->select('('.$subQuery_21b_comp.') AS "jml_imni_tt_2"');
        $this->db->select('('.$subQuery_22a_comp.') AS "jml_bcg_L"');
        $this->db->select('('.$subQuery_22b_comp.') AS "jml_bcg_P"');
        $this->db->select('('.$subQuery_23_comp.') AS "jml_dpt_1_L"');
        $this->db->select('('.$subQuery_24_comp.') AS "jml_dpt_1_P"');
        $this->db->select('('.$subQuery_25_comp.') AS "jml_dpt_2_L"');
        $this->db->select('('.$subQuery_26_comp.') AS "jml_dpt_2_P"');
        $this->db->select('('.$subQuery_27_comp.') AS "jml_dpt_3_L"');
        $this->db->select('('.$subQuery_28_comp.') AS "jml_dpt_3_L"');
        $this->db->select('('.$subQuery_29_comp.') AS "jml_polio_1_L"');
        $this->db->select('('.$subQuery_30_comp.') AS "jml_polio_1_P"');
        $this->db->select('('.$subQuery_31_comp.') AS "jml_polio_2_L"');
        $this->db->select('('.$subQuery_32_comp.') AS "jml_polio_2_P"');
        $this->db->select('('.$subQuery_33_comp.') AS "jml_polio_3_L"');
        $this->db->select('('.$subQuery_34_comp.') AS "jml_polio_3_P"');
        $this->db->select('('.$subQuery_35_comp.') AS "jml_polio_4_L"');
        $this->db->select('('.$subQuery_36_comp.') AS "jml_polio_4_P"');
        $this->db->select('('.$subQuery_37_comp.') AS "jml_campak_L"');
        $this->db->select('('.$subQuery_38_comp.') AS "jml_campak_P"');
        $this->db->select('('.$subQuery_39_comp.') AS "jml_hepatitis_1_L"');
        $this->db->select('('.$subQuery_40_comp.') AS "jml_hepatitis_1_P"');
        $this->db->select('('.$subQuery_41_comp.') AS "jml_hepatitis_2_L"');
        $this->db->select('('.$subQuery_42_comp.') AS "jml_hepatitis_2_P"');
        $this->db->select('('.$subQuery_43_comp.') AS "jml_hepatitis_3_L"');
        $this->db->select('('.$subQuery_44_comp.') AS "jml_hepatitis_3_P"');
        $this->db->select('('.$subQuery_45_comp.') AS "jml_diare_L"');
        $this->db->select('('.$subQuery_46_comp.') AS "jml_diare_P"');
        $this->db->select('('.$subQuery_47_comp.') AS "jml_punya_kms_L"');
        $this->db->select('('.$subQuery_48_comp.') AS "jml_punya_kms_P"');
		$this->db->from($this->t_month.' cm');
        
        // END QUERY LAPORAN 7
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


        // START QUERY LAPORAN 7

        //Ibu_hamil
        $subQuery_1 = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('lahir_tanggal', Null);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_1_comp = $subQuery_1->get_compiled_select();

        //diperiksa
        $subQuery_2 = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(tgl_pendaftaran) = cm.label_id')
                                ->where('YEAR(tgl_pendaftaran)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_2_comp = $subQuery_2->get_compiled_select();

        //menyusui
        $subQuery_3 = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('ibu_menyusui', 1);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_3_comp = $subQuery_3->get_compiled_select();

        //kb_kondom
        $subQuery_4 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Kondom');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_4_comp = $subQuery_4->get_compiled_select();

        //kb_pil
        $subQuery_5 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Pil');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_5_comp = $subQuery_5->get_compiled_select();

        //kb_implant
        $subQuery_6 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Implant');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_6_comp = $subQuery_6->get_compiled_select();

        //kb_mop
        $subQuery_7 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'MOP');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_7_comp = $subQuery_7->get_compiled_select();

        //kb_mow
        $subQuery_8 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'MOW');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_8_comp = $subQuery_8->get_compiled_select();

        //kb_iud
        $subQuery_9 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'IUD');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_9_comp = $subQuery_9->get_compiled_select();

        //kb_suntik
        $subQuery_10 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Suntik');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_10_comp = $subQuery_10->get_compiled_select();

        //kb_lainlain
        $subQuery_11 = $this->db->select('COUNT(w.id)')
                                ->from($this->t_wuspus.' w')
                                ->join($this->t_akseptor_wuspus.' aw', 'w.id = aw.wuspus_id')
                                ->where('w.deleted', 0)
                                ->where('aw.bulan = cm.label_id')
                                ->where('aw.tahun', $tahun)
                                ->where('aw.is_akseptor', 1)
                                ->where('aw.jenis_akseptor', 'Lain-lain');
                                if($pos_id != null) { $this->db->where('w.pos_id', $pos_id); };
        $subQuery_11_comp = $subQuery_11->get_compiled_select();

        //jml_balita_L
        $subQuery_12 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_12_comp = $subQuery_12->get_compiled_select();

        //jml_balita_P
        $subQuery_13 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_13_comp = $subQuery_13->get_compiled_select();

        //jml_balita_timbang_L
        $subQuery_14 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'L')
                                ->where('pb.berat_sekarang >', 0);
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_14_comp = $subQuery_14->get_compiled_select();

        //jml_balita_timbang_P
        $subQuery_15 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'P')
                                ->where('pb.berat_sekarang >', 0);
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_15_comp = $subQuery_15->get_compiled_select();

        //jml_balita_timbang_naik_L
        $subQuery_16 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'L')
                                ->where('pb.berat_sebelum >', 0)
                                ->where('pb.berat_sebelum < pb.berat_sekarang');
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_16_comp = $subQuery_16->get_compiled_select();

        //jml_balita_timbang_naik_P
        $subQuery_17 = $this->db->select('COUNT(b.id)')
                                ->from($this->t_balita.' b')
                                ->join($this->t_penimbangan_balita.' pb', 'b.id = pb.balita_id')
                                ->where('b.deleted', 0)
                                ->where('pb.bulan = cm.label_id')
                                ->where('pb.tahun', $tahun)
                                ->where('b.jk_anak', 'P')
                                ->where('pb.berat_sebelum >', 0)
                                ->where('pb.berat_sebelum < pb.berat_sekarang');
                                if($pos_id != null) { $this->db->where('b.pos_id', $pos_id); };
        $subQuery_17_comp = $subQuery_17->get_compiled_select();

        //jml_vitA_L
        $subQuery_18a = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln1) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln1)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_18a_comp = $subQuery_18a->get_compiled_select();

        $subQuery_18b = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln2) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln2)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_18b_comp = $subQuery_18b->get_compiled_select();

        //jml_vitA_P
        $subQuery_19a = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln1) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln1)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_19a_comp = $subQuery_19a->get_compiled_select();

        $subQuery_19b = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_vit_a_bln2) = cm.label_id')
                                ->where('YEAR(pyd_vit_a_bln2)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_19b_comp = $subQuery_19b->get_compiled_select();
        
        //jml_dapat_pmt_L
        $subQuery_20 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_pmt_pemulihan) = cm.label_id')
                                ->where('YEAR(pyd_pmt_pemulihan)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_20_comp = $subQuery_20->get_compiled_select();

        //jml_dapat_pmt_P
        $subQuery_21 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_pmt_pemulihan) = cm.label_id')
                                ->where('YEAR(pyd_pmt_pemulihan)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_21_comp = $subQuery_21->get_compiled_select();

        //jml_imni_tt_1
        $subQuery_21a = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_imsi1) = cm.label_id')
                                ->where('YEAR(pyd_imsi1)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_21a_comp = $subQuery_21a->get_compiled_select();


        //jml_imni_tt_2
        $subQuery_21b = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_imsi2) = cm.label_id')
                                ->where('YEAR(pyd_imsi2)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_21b_comp = $subQuery_21b->get_compiled_select();

        //jml_bcg_L
        $subQuery_22a = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_bcg) = cm.label_id')
                                ->where('YEAR(pyd_bcg)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_22a_comp = $subQuery_22a->get_compiled_select();

        //jml_bcg_P
        $subQuery_22b = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_bcg) = cm.label_id')
                                ->where('YEAR(pyd_bcg)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_22b_comp = $subQuery_22b->get_compiled_select();

        //jml_dpt_1_L
        $subQuery_23 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt1) = cm.label_id')
                                ->where('YEAR(pyd_dpt1)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_23_comp = $subQuery_23->get_compiled_select();

        //jml_dpt_1_P
        $subQuery_24 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt1) = cm.label_id')
                                ->where('YEAR(pyd_dpt1)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_24_comp = $subQuery_24->get_compiled_select();

        //jml_dpt_2_L
        $subQuery_25 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt2) = cm.label_id')
                                ->where('YEAR(pyd_dpt2)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_25_comp = $subQuery_25->get_compiled_select();

        //jml_dpt_2_P
        $subQuery_26 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt2) = cm.label_id')
                                ->where('YEAR(pyd_dpt2)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_26_comp = $subQuery_26->get_compiled_select();

        //jml_dpt_3_L
        $subQuery_27 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt3) = cm.label_id')
                                ->where('YEAR(pyd_dpt3)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_27_comp = $subQuery_27->get_compiled_select();

        //jml_dpt_3_P
        $subQuery_28 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_dpt3) = cm.label_id')
                                ->where('YEAR(pyd_dpt3)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_28_comp = $subQuery_28->get_compiled_select();

        //jml_polio_1_L
        $subQuery_29 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio1) = cm.label_id')
                                ->where('YEAR(pyd_polio1)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_29_comp = $subQuery_29->get_compiled_select();

        //jml_polio_1_P
        $subQuery_30 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio1) = cm.label_id')
                                ->where('YEAR(pyd_polio1)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_30_comp = $subQuery_30->get_compiled_select();

        //jml_polio_2_L
        $subQuery_31 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio2) = cm.label_id')
                                ->where('YEAR(pyd_polio2)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_31_comp = $subQuery_31->get_compiled_select();

        //jml_polio_2_P
        $subQuery_32 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio2) = cm.label_id')
                                ->where('YEAR(pyd_polio2)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_32_comp = $subQuery_32->get_compiled_select();

        //jml_polio_3_L
        $subQuery_33 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio3) = cm.label_id')
                                ->where('YEAR(pyd_polio3)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_33_comp = $subQuery_33->get_compiled_select();

        //jml_polio_3_P
        $subQuery_34 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio3) = cm.label_id')
                                ->where('YEAR(pyd_polio3)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_34_comp = $subQuery_34->get_compiled_select();

        //jml_polio_4_L
        $subQuery_35 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio4) = cm.label_id')
                                ->where('YEAR(pyd_polio4)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_35_comp = $subQuery_35->get_compiled_select();

        //jml_polio_4_P
        $subQuery_36 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_polio4) = cm.label_id')
                                ->where('YEAR(pyd_polio4)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_36_comp = $subQuery_36->get_compiled_select();

        //jml_campak_L
        $subQuery_37 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_campak) = cm.label_id')
                                ->where('YEAR(pyd_campak)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_37_comp = $subQuery_37->get_compiled_select();

        //jml_campak_P
        $subQuery_38 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_campak) = cm.label_id')
                                ->where('YEAR(pyd_campak)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_38_comp = $subQuery_38->get_compiled_select();

        //jml_hepatitis_1_L
        $subQuery_39 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis1) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis1)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_39_comp = $subQuery_39->get_compiled_select();

        //jml_hepatitis_1_P
        $subQuery_40 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis1) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis1)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_40_comp = $subQuery_40->get_compiled_select();

        //jml_hepatitis_2_L
        $subQuery_41 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis2) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis2)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_41_comp = $subQuery_41->get_compiled_select();

        //jml_hepatitis_2_P
        $subQuery_42 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis2) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis2)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_42_comp = $subQuery_42->get_compiled_select();

        //jml_hepatitis_3_L
        $subQuery_43 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis3) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis3)', $tahun)
                                ->where('jk_bayi', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_43_comp = $subQuery_43->get_compiled_select();

        //jml_hepatitis_3_P
        $subQuery_44 = $this->db->select('COUNT(id)')
                                ->from($this->t_bayi)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_hepatitis3) = cm.label_id')
                                ->where('YEAR(pyd_hepatitis3)', $tahun)
                                ->where('jk_bayi', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_44_comp = $subQuery_44->get_compiled_select();

        //jml_diare_L
        $subQuery_45 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_oralit) = cm.label_id')
                                ->where('YEAR(pyd_oralit)', $tahun)
                                ->where('jk_anak', 'L');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_45_comp = $subQuery_45->get_compiled_select();

        //jml_diare_P
        $subQuery_46 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_oralit) = cm.label_id')
                                ->where('YEAR(pyd_oralit)', $tahun)
                                ->where('jk_anak', 'P');
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_46_comp = $subQuery_46->get_compiled_select();

        //jml_punya_kms_L
        $subQuery_47 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'L')
                                ->where('kms !=', null);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_47_comp = $subQuery_47->get_compiled_select();

        //jml_punya_kms_P
        $subQuery_48 = $this->db->select('COUNT(id)')
                                ->from($this->t_balita)
                                ->where('deleted', 0)
                                ->where('MONTH(created_on) = cm.label_id')
                                ->where('YEAR(created_on)', $tahun)
                                ->where('jk_anak', 'P')
                                ->where('kms !=', null);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_48_comp = $subQuery_48->get_compiled_select();

        //jml_FE_besi
        $subQuery_49a = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_ptdh_fe1) = cm.label_id')
                                ->where('YEAR(pyd_ptdh_fe1)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_49a_comp = $subQuery_49a->get_compiled_select();

        $subQuery_49b = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_ptdh_fe2) = cm.label_id')
                                ->where('YEAR(pyd_ptdh_fe2)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_49b_comp = $subQuery_49b->get_compiled_select();

        $subQuery_49c = $this->db->select('COUNT(id)')
                                ->from($this->t_bumlin)
                                ->where('deleted', 0)
                                ->where('MONTH(pyd_ptdh_fe3) = cm.label_id')
                                ->where('YEAR(pyd_ptdh_fe3)', $tahun);
                                if($pos_id != null) { $this->db->where('pos_id', $pos_id); };
        $subQuery_49c_comp = $subQuery_49c->get_compiled_select();



        $this->db->select('cm.label_id AS "no", cm.name AS "bulan"');
        $this->db->select('('.$subQuery_1_comp.') AS "Ibu_hamil"');
        $this->db->select('('.$subQuery_2_comp.') AS "diperiksa"');
        $this->db->select('(('.$subQuery_49a_comp.') + ('.$subQuery_49b_comp.') + ('.$subQuery_49c_comp.')) AS "jml_FE_besi"');
        $this->db->select('('.$subQuery_3_comp.') AS "menyusui"');
        $this->db->select('('.$subQuery_4_comp.') AS "kb_kondom"');
        $this->db->select('('.$subQuery_5_comp.') AS "kb_pil"');
        $this->db->select('('.$subQuery_6_comp.') AS "kb_implant"');
        $this->db->select('('.$subQuery_7_comp.') AS "kb_mop"');
        $this->db->select('('.$subQuery_8_comp.') AS "kb_mow"');
        $this->db->select('('.$subQuery_9_comp.') AS "kb_iud"');
        $this->db->select('('.$subQuery_10_comp.') AS "kb_suntik"');
        $this->db->select('('.$subQuery_11_comp.') AS "kb_lainlain"');
        $this->db->select('('.$subQuery_12_comp.') AS "jml_balita_L"');
        $this->db->select('('.$subQuery_13_comp.') AS "jml_balita_P"');
        $this->db->select('('.$subQuery_14_comp.') AS "jml_balita_timbang_L"');
        $this->db->select('('.$subQuery_15_comp.') AS "jml_balita_timbang_P"');
        $this->db->select('('.$subQuery_16_comp.') AS "jml_balita_timbang_naik_L"');
        $this->db->select('('.$subQuery_17_comp.') AS "jml_balita_timbang_naik_P"');
        $this->db->select('(('.$subQuery_18a_comp.') + ('.$subQuery_18b_comp.')) AS "jml_vitA_L"');
        $this->db->select('(('.$subQuery_19a_comp.') + ('.$subQuery_19b_comp.')) AS "jml_vitA_P"');
        $this->db->select('('.$subQuery_20_comp.') AS "jml_dapat_pmt_L"');
        $this->db->select('('.$subQuery_21_comp.') AS "jml_dapat_pmt_P"');
        $this->db->select('('.$subQuery_21a_comp.') AS "jml_imni_tt_1"');
        $this->db->select('('.$subQuery_21b_comp.') AS "jml_imni_tt_2"');
        $this->db->select('('.$subQuery_22a_comp.') AS "jml_bcg_L"');
        $this->db->select('('.$subQuery_22b_comp.') AS "jml_bcg_P"');
        $this->db->select('('.$subQuery_23_comp.') AS "jml_dpt_1_L"');
        $this->db->select('('.$subQuery_24_comp.') AS "jml_dpt_1_P"');
        $this->db->select('('.$subQuery_25_comp.') AS "jml_dpt_2_L"');
        $this->db->select('('.$subQuery_26_comp.') AS "jml_dpt_2_P"');
        $this->db->select('('.$subQuery_27_comp.') AS "jml_dpt_3_L"');
        $this->db->select('('.$subQuery_28_comp.') AS "jml_dpt_3_L"');
        $this->db->select('('.$subQuery_29_comp.') AS "jml_polio_1_L"');
        $this->db->select('('.$subQuery_30_comp.') AS "jml_polio_1_P"');
        $this->db->select('('.$subQuery_31_comp.') AS "jml_polio_2_L"');
        $this->db->select('('.$subQuery_32_comp.') AS "jml_polio_2_P"');
        $this->db->select('('.$subQuery_33_comp.') AS "jml_polio_3_L"');
        $this->db->select('('.$subQuery_34_comp.') AS "jml_polio_3_P"');
        $this->db->select('('.$subQuery_35_comp.') AS "jml_polio_4_L"');
        $this->db->select('('.$subQuery_36_comp.') AS "jml_polio_4_P"');
        $this->db->select('('.$subQuery_37_comp.') AS "jml_campak_L"');
        $this->db->select('('.$subQuery_38_comp.') AS "jml_campak_P"');
        $this->db->select('('.$subQuery_39_comp.') AS "jml_hepatitis_1_L"');
        $this->db->select('('.$subQuery_40_comp.') AS "jml_hepatitis_1_P"');
        $this->db->select('('.$subQuery_41_comp.') AS "jml_hepatitis_2_L"');
        $this->db->select('('.$subQuery_42_comp.') AS "jml_hepatitis_2_P"');
        $this->db->select('('.$subQuery_43_comp.') AS "jml_hepatitis_3_L"');
        $this->db->select('('.$subQuery_44_comp.') AS "jml_hepatitis_3_P"');
        $this->db->select('('.$subQuery_45_comp.') AS "jml_diare_L"');
        $this->db->select('('.$subQuery_46_comp.') AS "jml_diare_P"');
        $this->db->select('('.$subQuery_47_comp.') AS "jml_punya_kms_L"');
        $this->db->select('('.$subQuery_48_comp.') AS "jml_punya_kms_P"');
		$this->db->from($this->t_month.' cm');
        
        // END QUERY LAPORAN 7


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