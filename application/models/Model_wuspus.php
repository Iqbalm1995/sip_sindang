<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_wuspus extends CI_Model {

	private $t_wuspus	= 'wsp_wuspus';
	private $t_kunjungan_wuspus	= 'wsp_kunjungan_wuspus';
	private $t_akseptor_wuspus	= 'wsp_akseptor_wuspus';

    var $column_order = array(null, 'pos_name', 'desa_name', 'kms', 'nama', 'umur', 'suami_pus', 
                                    'taha_kan_ks', 'kel_dawis', 'jml_anak_hidup', 'jml_anak_meninggal', 
                                    'umur_anak_meninggal', 'lila', 'keterangan', 'created_on');
    var $column_search = array('pos_name', 'desa_name', 'kms', 'nama', 'umur', 'suami_pus', 
                                    'taha_kan_ks', 'kel_dawis', 'jml_anak_hidup', 'jml_anak_meninggal', 
                                    'umur_anak_meninggal', 'lila', 'keterangan', 'created_on');
    var $order = array('created_on' => 'desc');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_laporan_wuspus($tahun = null, $bulan = null)
	{

		if ($tahun == null) {
			$tahun = date('Y');
		}

		if ($bulan == null) {
			$bulan = date('m');
		}

		$compailed_jenis 	= [];

		foreach (ARRAY_BULAN as $key => $value) { 

			$subQueryJenis = $this->db->select('jenis_akseptor')
								 ->from($this->t_akseptor_wuspus)
								 ->where('wuspus_id = b.id')
								 ->where('bulan', $key)
								 ->where('tahun', $tahun);
       		$subQueryJenis_comp = $subQueryJenis->get_compiled_select();

			array_push($compailed_jenis, $subQueryJenis_comp);

		}

		$this->db->select('b.*');

		// select penimbangan sub query
		$qNo = 0;
		foreach (ARRAY_BULAN as $key => $value) { 
			$this->db->select('('.$compailed_jenis[$qNo].') AS "r'.$key.'_jenis"');
			$qNo++;
		}

		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->from($this->t_wuspus.' b');
		$this->db->where('b.deleted', 0);
		$this->db->where('MONTH(b.created_on)', $bulan);
		$this->db->where('YEAR(b.created_on)', $tahun);
		$this->db->order_by('b.id', 'ASC');
		$query = $this->db->get();
		return $query->result();

	}

    public function get_kunjugan_wuspus($wuspus_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_kunjungan_wuspus);
		$this->db->where('wuspus_id', $wuspus_id);
		if ($tahun == null) {
			$tahun = date('Y');
			$this->db->where('tahun', $tahun);
		}else{
			$this->db->where('tahun', $tahun);
		}
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_akseptor_wuspus($wuspus_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_akseptor_wuspus);
		$this->db->where('wuspus_id', $wuspus_id);
		if ($tahun == null) {
			$tahun = date('Y');
			$this->db->where('tahun', $tahun);
		}else{
			$this->db->where('tahun', $tahun);
		}
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result();
	}

    function get_total_data_wuspus($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_wuspus');
		$this->db->from($this->t_wuspus);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_wuspus;
	}

    function get_total_anak_wuspus($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('SUM(jml_anak_hidup) AS total_anak_hidup');
		$this->db->select('SUM(jml_anak_meninggal) AS total_anak_meninggal');
		$this->db->from($this->t_wuspus);
		$this->db->where('YEAR(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
	}

    public function get_kunjungan_wuspus_total($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}
        $this->db->select('b1.bulan, b1.tahun');
		$this->db->select('(SELECT COUNT(b2.id) FROM '.$this->t_kunjungan_wuspus.' b2 WHERE b2.is_kunjungan = 1 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
		$this->db->from($this->t_kunjungan_wuspus.' b1');
		$this->db->join($this->t_wuspus.' by1', 'by1.id = b1.wuspus_id');
		$this->db->where('b1.tahun', $tahun);
		$this->db->where('by1.deleted', 0);
		$this->db->group_by('b1.bulan, b1.tahun');
		$query = $this->db->get();
		return $query->result();
	}

    private function _get_datatables_query()
	{
		//add custom filter here}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		
		if($this->input->post('searchFilter')) { 
			$this->db->group_start()
                ->or_like('kms', $this->input->post('searchFilter'))
                ->or_like('nama', $this->input->post('searchFilter'))
                ->or_like('umur', $this->input->post('searchFilter'))
            ->group_end();
		}

		$this->db->where('deleted', 0);
		$this->db->from($this->t_wuspus);

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
		$this->db->from($this->t_wuspus);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

    public function get_by_id($id)
	{
		$this->db->from($this->t_wuspus);
		$this->db->where('id',$id);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_kms($kms)
	{
		$this->db->from($this->t_wuspus);
		$this->db->where('kms',$kms);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert($this->t_wuspus, $data);
		$this->db->trans_complete();
		return $save;
	}

    public function save_kunjungan($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_kunjungan_wuspus, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function save_akseptor($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_akseptor_wuspus, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function update($where, $data)
	{
		$this->db->trans_start();
		$save = $this->db->update($this->t_wuspus, $data, $where);
		$this->db->trans_complete();
		return $save;
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->t_wuspus);
	}

    public function clear_kunjungan_data_wuspus($wuspus_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('wuspus_id', $wuspus_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_kunjungan_wuspus);
		$this->db->trans_complete();
	}

    public function clear_akseptor_data_wuspus($wuspus_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('wuspus_id', $wuspus_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_akseptor_wuspus);
		$this->db->trans_complete();
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}

	
}