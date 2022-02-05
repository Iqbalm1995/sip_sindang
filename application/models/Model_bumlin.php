<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bumlin extends CI_Model {

    private $t_bumlin	= 'bdb_bumlin';
	private $t_kunjungan_bumlin	= 'bdb_kunjungan_bumlin';
	private $t_pemeriksaan_bumlin	= 'bdb_pemeriksaan_bumlin';

    var $column_order = array(null, 'pos_name', 'desa_name', 'kms', 'nama_bumil', 'umur', 'kel_dawis', 
                                    'tgl_pendaftaran', 'umur_kehamilan', 'hamil_ke', 'keterangan', 'created_on');
    var $column_search = array('pos_name', 'desa_name', 'kms', 'nama_bumil', 'umur', 'kel_dawis', 
                              'tgl_pendaftaran', 'umur_kehamilan', 'hamil_ke', 'keterangan', 'created_on');
    var $order = array('created_on' => 'desc');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_laporan_bumlin($tahun = null, $bulan = null)
	{

		if ($tahun == null) {
			$tahun = date('Y');
		}

		if ($bulan == null) {
			$bulan = date('m');
		}

		$compailed_query_darah 		= [];
		$compailed_query_berat 		= [];

		foreach (ARRAY_BULAN as $key => $value) { 

			$subQueryDarah = $this->db->select('tekanan_darah')
								 ->from($this->t_pemeriksaan_bumlin)
								 ->where('bumlin_id = b.id')
								 ->where('bulan', $key)
								 ->where('tahun', $tahun);
       		$subQueryDarah_comp = $subQueryDarah->get_compiled_select();

			$subQueryBerat = $this->db->select('berat_badan')
								->from($this->t_pemeriksaan_bumlin)
								->where('bumlin_id = b.id')
								->where('bulan', $key)
								->where('tahun', $tahun);
			$subQueryBerat_comp = $subQueryBerat->get_compiled_select();

			array_push($compailed_query_darah, $subQueryDarah_comp);
			array_push($compailed_query_berat, $subQueryBerat_comp);

		}

		$this->db->select('b.*');

		// select penimbangan sub query
		$qNo = 0;
		foreach (ARRAY_BULAN as $key => $value) { 
			$this->db->select('('.$compailed_query_darah[$qNo].') AS "r'.$key.'_darah"');
			$this->db->select('('.$compailed_query_berat[$qNo].') AS "r'.$key.'_berat"');
			$qNo++;
		}

		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->from($this->t_bumlin.' b');
		$this->db->where('b.deleted', 0);
		$this->db->where('MONTH(b.created_on)', $bulan);
		$this->db->where('YEAR(b.created_on)', $tahun);
		$this->db->order_by('b.id', 'ASC');
		$query = $this->db->get();
		return $query->result();

	}

    public function get_kunjugan_bumlin($bumlin_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_kunjungan_bumlin);
		$this->db->where('bumlin_id', $bumlin_id);
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

    public function get_pemeriksaan_bumlin($bumlin_id, $tahun = null)
	{
        $this->db->select('*');
		$this->db->from($this->t_pemeriksaan_bumlin);
		$this->db->where('bumlin_id', $bumlin_id);
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

    function get_total_data_bumlin($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bumlin');
		$this->db->from($this->t_bumlin);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bumlin;
	}

    function get_total_data_melahirkan($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bumlin');
		$this->db->from($this->t_bumlin);
		$this->db->where('lahir_tanggal != ', null);
		$this->db->where('YEAR(lahir_tanggal)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bumlin;
	}

    function get_total_data_beresiko($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bumlin');
		$this->db->from($this->t_bumlin);
		$this->db->where('pyd_resiko', 1);
		$this->db->where('YEAR(created_on)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bumlin;
	}

    function get_total_data_ibu_meninggal($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bumlin');
		$this->db->from($this->t_bumlin);
		$this->db->where('ibu_meninggal != ', null);
		$this->db->where('YEAR(ibu_meninggal)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bumlin;
	}

    function get_total_data_bayi_meninggal($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('pos_id', $this->session->userdata('pos_id'));
		}
		$this->db->select('COUNT(id) AS total_bumlin');
		$this->db->from($this->t_bumlin);
		$this->db->where('bayi_meninggal != ', null);
		$this->db->where('YEAR(bayi_meninggal)', $tahun);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row()->total_bumlin;
	}

    public function get_kunjungan_bumlin_total($tahun = null)
	{
		if ($tahun == null) {
			$tahun = date('Y');
		}
		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('by1.pos_id', $this->session->userdata('pos_id'));
		}
        $this->db->select('b1.bulan, b1.tahun');
		$this->db->select('(SELECT COUNT(b2.id) FROM '.$this->t_kunjungan_bumlin.' b2 WHERE b2.is_kunjungan = 1 AND ( b2.bulan = b1.bulan AND b2.tahun = b1.tahun ) AND b1.tahun = "'.$tahun.'" ) AS total');
		$this->db->from($this->t_kunjungan_bumlin.' b1');
		$this->db->join($this->t_bumlin.' by1', 'by1.id = b1.bumlin_id');
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
                ->or_like('nama_bumil', $this->input->post('searchFilter'))
                ->or_like('umur', $this->input->post('searchFilter'))
            ->group_end();
		}

		$this->db->where('deleted', 0);
		$this->db->from($this->t_bumlin);

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
		$this->db->from($this->t_bumlin);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

    public function get_by_id($id)
	{
		$this->db->from($this->t_bumlin);
		$this->db->where('id',$id);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_kms($kms)
	{
		$this->db->from($this->t_bumlin);
		$this->db->where('kms',$kms);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert($this->t_bumlin, $data);
		$this->db->trans_complete();
		return $save;
	}

    public function save_kunjungan($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_kunjungan_bumlin, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function save_pemeriksaan($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert_batch($this->t_pemeriksaan_bumlin, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function update($where, $data)
	{
		$this->db->trans_start();
		$save = $this->db->update($this->t_bumlin, $data, $where);
		$this->db->trans_complete();
		return $save;
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->t_bumlin);
	}

    public function clear_kunjungan_data_bumlin($bumlin_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('bumlin_id', $bumlin_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_kunjungan_bumlin);
		$this->db->trans_complete();
	}

    public function clear_pemeriksaan_data_bumlin($bumlin_id, $year)
	{
		$this->db->trans_start();
		$this->db->where('bumlin_id', $bumlin_id);
		$this->db->where('tahun', $year);
		$this->db->delete($this->t_pemeriksaan_bumlin);
		$this->db->trans_complete();
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}

}