<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bayi extends CI_Model {

	private $t_bayi	= 'byi_bayi';
	private $t_penimbangan_bayi	= 'byi_penimbangan_bayi';
	private $t_kunjungan_bayi	= 'byi_kunjungan_bayi';
    
    var $column_order = array(null, 'pos_name', 'desa_name', 'kms', 'nama_bayi', 'tgl_lahir_bayi', 'jk_bayi', 
                                    'bbl', 'nama_bapak', 'nama_ibu', 'kel_dawis', 'tgl_meninggal_bayi', 'keterangan', 'nama_pic', 'created_on');
    var $column_search = array(null, 'pos_name', 'desa_name', 'kms', 'nama_bayi', 'tgl_lahir_bayi', 'jk_bayi', 
                                     'bbl', 'nama_bapak', 'nama_ibu', 'kel_dawis', 'tgl_meninggal_bayi', 'keterangan', 'nama_pic', 'created_on');
    var $order = array('created_on' => 'desc');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_laporan_bayi($tahun = null, $bulan = null)
	{

		if ($tahun == null) {
			$tahun = date('Y');
		}

		if ($bulan == null) {
			$bulan = date('m');
		}

		$compailed_query_tinggi 	= [];
		$compailed_query_berat 		= [];

		foreach (ARRAY_BULAN as $key => $value) { 

			$subQueryTinggi = $this->db->select('tinggi_sekarang')
								 ->from($this->t_penimbangan_bayi)
								 ->where('bayi_id = b.id')
								 ->where('bulan', $key)
								 ->where('tahun', $tahun);
       		$subQueryTinggi_comp = $subQueryTinggi->get_compiled_select();

			$subQueryBerat = $this->db->select('berat_sekarang')
								->from($this->t_penimbangan_bayi)
								->where('bayi_id = b.id')
								->where('bulan', $key)
								->where('tahun', $tahun);
			$subQueryBerat_comp = $subQueryBerat->get_compiled_select();

			array_push($compailed_query_tinggi, $subQueryTinggi_comp);
			array_push($compailed_query_berat, $subQueryBerat_comp);

		}

		$this->db->select('b.*');

		// select penimbangan sub query
		$qNo = 0;
		foreach (ARRAY_BULAN as $key => $value) { 
			$this->db->select('('.$compailed_query_tinggi[$qNo].') AS "r'.$key.'_tinggi"');
			$this->db->select('('.$compailed_query_berat[$qNo].') AS "r'.$key.'_berat"');
			$qNo++;
		}

		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('b.pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->from($this->t_bayi.' b');
		$this->db->join($this->t_kunjungan_bayi.' bk', 'b.id = bk.bayi_id');
		$this->db->where('b.deleted', 0);
		$this->db->where('bk.bulan', $bulan);
		$this->db->where('bk.tahun', $tahun);
		$this->db->where('bk.is_kunjungan', 1);
		$this->db->order_by('b.id', 'ASC');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_kunjugan_bayi($bayi_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_kunjungan_bayi);
		$this->db->where('bayi_id', $bayi_id);
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

    public function get_timbangan_bayi($bayi_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_penimbangan_bayi);
		$this->db->where('bayi_id', $bayi_id);
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

    public function get_arsip_timbangan_bayi($bayi_id)
	{
		$this->db->select('b1.tahun AS tahun, by1.id AS bayi_id');
		$this->db->from($this->t_penimbangan_bayi.' b1');
		$this->db->join($this->t_bayi.' by1', 'by1.id = b1.bayi_id');
		$this->db->group_start()
				 ->where('b1.tinggi_sekarang !=', 0)
				 ->where('b1.berat_sekarang !=', 0)
		->group_end();
		$this->db->where('by1.deleted', 0);
		$this->db->where('by1.id', $bayi_id);
		$this->db->group_by('b1.tahun');
		$this->db->order_by('b1.tahun', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

    public function get_total_data_timbangan_bayi($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(DISTINCT by1.id) AS total_penimbang');
		$this->db->from($this->t_penimbangan_bayi.' b1');
		$this->db->join($this->t_bayi.' by1', 'by1.id = b1.bayi_id');
		$this->db->group_start()
				 ->where('b1.tinggi_sekarang !=', 0)
				 ->where('b1.berat_sekarang !=', 0)
		->group_end();
		$this->db->where('by1.deleted', 0);
		$this->db->where('b1.tahun', $tahun);
		$this->db->group_by('b1.bulan, b1.tahun');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

    public function get_total_data_bayi_meninggal($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		
		$this->db->select('COUNT(id) AS total_bayi_meninggal');
		$this->db->from($this->t_bayi);
		$this->db->where('YEAR(created_on)', $tahun);
		$this->db->where('tgl_meninggal_bayi IS NOT NULL');
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row();
	}

    public function get_total_data_bayi_baru_lahir($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->from($this->t_bayi);
		$this->db->where('YEAR(created_on)', $tahun);
		$this->db->where('bbl', 1);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

    public function get_total_data_bayi()
	{
		$this->db->from($this->t_bayi);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

    public function get_timbangan_bayi_total($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}
        $this->db->select('b1.bulan, b1.tahun');
		$this->db->select('(SELECT COUNT(b2.tinggi_sekarang) FROM byi_penimbangan_bayi b2 WHERE b2.tinggi_sekarang > 0 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
		$this->db->from($this->t_penimbangan_bayi.' b1');
		$this->db->join($this->t_bayi.' by1', 'by1.id = b1.bayi_id');
		$this->db->where('b1.tahun', $tahun);
		$this->db->where('by1.deleted', 0);
		$this->db->group_by('b1.bulan, b1.tahun');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_kunjungan_bayi_total($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}
        $this->db->select('b1.bulan, b1.tahun');
		$this->db->select('(SELECT COUNT(b2.id) FROM '.$this->t_kunjungan_bayi.' b2 WHERE b2.is_kunjungan = 1 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
		$this->db->from($this->t_kunjungan_bayi.' b1');
		$this->db->join($this->t_bayi.' by1', 'by1.id = b1.bayi_id');
		$this->db->where('b1.tahun', $tahun);
		$this->db->where('by1.deleted', 0);
		$this->db->group_by('b1.bulan, b1.tahun');
		$query = $this->db->get();
		return $query->result();
	}

    private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('is_pass_away')) { $this->db->where('tgl_meninggal_bayi IS NULL'); }
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		if($this->input->post('jkFilter')) { $this->db->like('jk_bayi', $this->input->post('jkFilter')); }
		
		if($this->input->post('searchFilter')) { 
			$this->db->group_start()
                ->or_like('kms', $this->input->post('searchFilter'))
                ->or_like('nama_bayi', $this->input->post('searchFilter'))
                ->or_like('nama_bapak', $this->input->post('searchFilter'))
                ->or_like('nama_ibu', $this->input->post('searchFilter'))
            ->group_end();
		}

		$this->db->where('deleted', 0);
		$this->db->from($this->t_bayi);

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
		$this->db->from($this->t_bayi);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->t_bayi);
		$this->db->where('id',$id);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_kms($kms)
	{
		$this->db->from($this->t_bayi);
		$this->db->where('kms',$kms);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert($this->t_bayi, $data);
		$this->db->trans_complete();
		return $save;
	}

    public function save_penimbangan($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_penimbangan_bayi, $data);
		$this->db->trans_complete();
		return $save;
	}

    public function save_kunjungan($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_kunjungan_bayi, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function update($where, $data)
	{
		$this->db->trans_start();
		$save = $this->db->update($this->t_bayi, $data, $where);
		$this->db->trans_complete();
		return $save;
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->t_bayi);
	}

    public function clear_penimbangan_data_bayi($bayi_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('bayi_id', $bayi_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_penimbangan_bayi);
		$this->db->trans_complete();
	}

    public function clear_kunjungan_data_bayi($bayi_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('bayi_id', $bayi_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_kunjungan_bayi);
		$this->db->trans_complete();
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
}