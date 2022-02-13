<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bumil extends CI_Model {

	private $t_bumil	= 'bml_bumil';
	private $t_kunjungan_bumil	= 'bml_kunjungan_bumil';
    
    var $column_order = array(null, 'pos_name', 'desa_name', 'nik', 'nama_bapak', 'nama_ibu', 'nama_bayi', 
                                    'tgl_lahir_bayi', 'jk_bayi', 'tgl_meninggal_bayi', 'tgl_meninggal_ibu', 'is_risk', 
                                    'keterangan', 'nama_pic', 'created_on');
    var $column_search = array('pos_name', 'desa_name', 'nik', 'nama_bapak', 'nama_ibu', 'nama_bayi', 
                                    'tgl_lahir_bayi', 'jk_bayi', 'tgl_meninggal_bayi', 'tgl_meninggal_ibu', 'is_risk', 
                                    'keterangan', 'nama_pic', 'created_on');
    var $order = array('created_on' => 'desc');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_data_bumil($tahun = null, $bulan = null)
	{

		if ($tahun == null) {
			$tahun = date('Y');
		}

		if ($bulan == null) {
			$bulan = date('m');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('b.pos_id', $this->session->userdata('pos_id'));
		}

		$this->db->select('b.*');
		$this->db->from($this->t_bumil.' b');
		$this->db->join($this->t_kunjungan_bumil.' bk', 'b.id = bk.bumil_id');
		$this->db->where('b.deleted', 0);
		$this->db->where('bk.bulan', $bulan);
		$this->db->where('bk.tahun', $tahun);
		$this->db->where('bk.is_kunjungan', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_kunjugan_bumil($bumil_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_kunjungan_bumil);
		$this->db->where('bumil_id', $bumil_id);
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

	function get_total_data_bumil($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bumil');
		$this->db->from($this->t_bumil);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bumil;
	}

	function get_total_ibu_sudah_melahirkan($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_ibu_sudah_melahirkan');
		$this->db->from($this->t_bumil);
		$this->db->where('YEAR(tgl_lahir_bayi)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_ibu_sudah_melahirkan;
	}

	function get_total_bayi_meninggal($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bayi_meninggal');
		$this->db->from($this->t_bumil);
		$this->db->where('YEAR(tgl_meninggal_bayi)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bayi_meninggal;
	}
	
	function get_total_ibu_meninggal($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_ibu_meninggal');
		$this->db->from($this->t_bumil);
		$this->db->where('YEAR(tgl_meninggal_ibu)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_ibu_meninggal;
	}
	
	function get_total_ibu_beresiko($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_ibu_beresiko');
		$this->db->from($this->t_bumil);
		$this->db->where('is_risk', 1);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_ibu_beresiko;
	}

	public function get_kunjungan_bumil_total($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}
        $this->db->select('b1.bulan, b1.tahun');
		$this->db->select('(SELECT COUNT(b2.id) FROM '.$this->t_kunjungan_bumil.' b2 WHERE b2.is_kunjungan = 1 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
		$this->db->from($this->t_kunjungan_bumil.' b1');
		$this->db->join($this->t_bumil.' by1', 'by1.id = b1.bumil_id');
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

		if (!empty($this->input->post('is_baby_born'))) {
			$this->db->where('tgl_lahir_bayi !=', null);
		}
		
		if (!empty($this->input->post('jkFilter'))) {
			$this->db->where('jk_bayi', $this->input->post('jkFilter'));
		}
		
		if($this->input->post('searchFilter')) { 
			$this->db->group_start()
                ->or_like('nik', $this->input->post('searchFilter'))
                ->or_like('nama_bayi', $this->input->post('searchFilter'))
                ->or_like('nama_bapak', $this->input->post('searchFilter'))
                ->or_like('nama_ibu', $this->input->post('searchFilter'))
            ->group_end();
		}

		$this->db->where('deleted', 0);
		$this->db->from($this->t_bumil);

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
		$this->db->from($this->t_bumil);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->t_bumil);
		$this->db->where('id',$id);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_nik($nik)
	{
		$this->db->from($this->t_bumil);
		$this->db->where('nik',$nik);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert($this->t_bumil, $data);
		$this->db->trans_complete();
		return $save;
	}

    public function save_kunjungan($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_kunjungan_bumil, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function update($where, $data)
	{
		$this->db->trans_start();
		$save = $this->db->update($this->t_bumil, $data, $where);
		$this->db->trans_complete();
		return $save;
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->t_bumil);
	}

    public function clear_kunjungan_data_bumil($bumil_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('bumil_id', $bumil_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_kunjungan_bumil);
		$this->db->trans_complete();
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
}