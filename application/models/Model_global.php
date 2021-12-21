<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_global extends CI_Model {

	private $t_bayi	                = 'byi_bayi';
	private $t_penimbangan_bayi	    = 'byi_penimbangan_bayi';
	private $t_balita	            = 'blt_balita';
	private $t_penimbangan_balita	= 'blt_penimbangan_balita';
	private $t_posyandu		        = 'pos_posyandu';
	private $t_bumil	            = 'bml_bumil';
	private $t_web_config	        = 'sys_applications';

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    function create_id()
    {  
        $query = $this->db->query("SELECT UUID() AS uuid")->row();
        if ($query === FALSE) {
            return null;
        }else{
        	return $query->uuid;
        }
    }
	// sys_config
	function load_sys_config()
    {
		$this->db->from($this->t_web_config);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

    // data bayi
    public function get_timbangan_bayi_total($tahun = null, $jk = null)
	{
        if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}

		if ($tahun == null) {
			$tahun = date('Y');
		}

		$this->db->select('b1.bulan, b1.tahun');
        if ($jk != null) {
            $this->db->where('by1.jk_bayi', $jk);
            $this->db->select('(
                    SELECT COUNT(b2.tinggi_sekarang) 
                    FROM '.$this->t_penimbangan_bayi.' b2 
                    JOIN '.$this->t_bayi.' b3 ON b3.id = b2.bayi_id
                    WHERE b2.tinggi_sekarang > 0 
                    AND b3.jk_bayi = "'.$jk.'"
                    AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) 
                    AND b1.tahun = "'.$tahun.'" 
                ) AS total'
            );
        }else{
            $this->db->select('(SELECT COUNT(b2.tinggi_sekarang) FROM '.$this->t_penimbangan_bayi.' b2 WHERE b2.tinggi_sekarang > 0 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
        }
		$this->db->from($this->t_penimbangan_bayi.' b1');
		$this->db->join($this->t_bayi.' by1', 'by1.id = b1.bayi_id');
		$this->db->where('b1.tahun', $tahun);
		$this->db->where('by1.deleted', 0);
		$this->db->group_by('b1.bulan, b1.tahun');
		$query = $this->db->get();
		return $query->result();
	}

    function byi_total_pyd_syrp_besi_fe1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_syrp_besi_fe1');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_syrp_besi_fe1 !=', NULL);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_syrp_besi_fe2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_syrp_besi_fe2');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_syrp_besi_fe2 !=', NULL);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_vit_a_bln1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_vit_a_bln1');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_vit_a_bln1 !=', NULL);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_vit_a_bln2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_vit_a_bln2');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_vit_a_bln2 !=', NULL);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_oralit($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_oralit');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_oralit', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_bcg($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_bcg');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_bcg', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_dpt1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_dpt1');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_dpt1', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_dpt2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_dpt2');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_dpt2', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_dpt3($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_dpt3');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_dpt3', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_polio1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_polio1');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_polio1', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_polio2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_polio2');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_polio2', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_polio3($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_polio3');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_polio3', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_polio4($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_polio4');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_polio4', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_campak($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_campak');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_campak', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_hepatitis1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_hepatitis1');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_hepatitis1', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_hepatitis2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_hepatitis2');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_hepatitis2', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_pyd_hepatitis3($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_hepatitis3');
		$this->db->from($this->t_bayi);
		$this->db->where('pyd_hepatitis3', 1);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function byi_total_meninggal_bayi($tahun)
    {
		$this->db->select('COUNT(id) AS total_meninggal_bayi');
		$this->db->from($this->t_bayi);
		$this->db->where('tgl_meninggal_bayi', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    // data balita
    public function get_timbangan_balita_total($tahun = null, $jk = null)
	{
        if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}

		if ($tahun == null) {
			$tahun = date('Y');
		}

		$this->db->select('b1.bulan, b1.tahun');
        if ($jk != null) {
            $this->db->where('by1.jk_anak', $jk);
            $this->db->select('(
                    SELECT COUNT(b2.tinggi_sekarang) 
                    FROM '.$this->t_penimbangan_balita.' b2 
                    JOIN '.$this->t_balita.' b3 ON b3.id = b2.balita_id
                    WHERE b2.tinggi_sekarang > 0 
                    AND b3.jk_anak = "'.$jk.'"
                    AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) 
                    AND b1.tahun = "'.$tahun.'" 
                ) AS total'
            );
        }else{
            $this->db->select('(SELECT COUNT(b2.tinggi_sekarang) FROM '.$this->t_penimbangan_balita.' b2 WHERE b2.tinggi_sekarang > 0 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
        }
		$this->db->from($this->t_penimbangan_balita.' b1');
		$this->db->join($this->t_balita.' by1', 'by1.id = b1.balita_id');
		$this->db->where('b1.tahun', $tahun);
		$this->db->where('by1.deleted', 0);
		$this->db->group_by('b1.bulan, b1.tahun');
		$query = $this->db->get();
		return $query->result();
	}

    function blt_total_pyd_syrp_besi_fe1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_syrp_besi_fe1');
		$this->db->from($this->t_balita);
		$this->db->where('pyd_syrp_besi_fe1 !=', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function blt_total_pyd_syrp_besi_fe2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_syrp_besi_fe2');
		$this->db->from($this->t_balita);
		$this->db->where('pyd_syrp_besi_fe2 !=', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function blt_total_pyd_vit_a_bln1($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_vit_a_bln1');
		$this->db->from($this->t_balita);
		$this->db->where('pyd_vit_a_bln1 !=', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function blt_total_pyd_vit_a_bln2($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_vit_a_bln2');
		$this->db->from($this->t_balita);
		$this->db->where('pyd_vit_a_bln2 !=', NULL);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function blt_total_pyd_pmt_pemulihan($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_pmt_pemulihan');
		$this->db->from($this->t_balita);
		$this->db->where('pyd_pmt_pemulihan', 1);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function blt_total_pyd_oralit($tahun)
    {
		$this->db->select('COUNT(id) AS total_pyd_oralit');
		$this->db->from($this->t_balita);
		$this->db->where('pyd_oralit', 1);
		$this->db->where('year(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    // total top
    
    function top_total_pos()
    {
		$this->db->select('COUNT(id) AS total_pos');
		$this->db->from($this->t_posyandu);
		$this->db->where('status', 1);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function top_total_bumil()
    {
		$this->db->select('COUNT(id) AS total_bumil');
		$this->db->from($this->t_bumil);
		$this->db->where('tgl_meninggal_bayi !=', NULL);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }
    function top_total_bayi()
    {
		$this->db->select('COUNT(id) AS total_bayi');
		$this->db->from($this->t_bayi);
		$this->db->where('tgl_meninggal_bayi !=', NULL);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }

    function top_total_balita()
    {
		$this->db->select('COUNT(id) AS total_balita');
		$this->db->from($this->t_balita);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
    }


}