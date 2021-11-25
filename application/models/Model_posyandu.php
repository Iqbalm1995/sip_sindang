<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_posyandu extends CI_Model {

	private $t_posyandu		= 'pos_posyandu';
    private $t_desa		    = 'mst_desa';

	var $column_order = array(null, 'pos.nama', 'des.nama', 'pos.status'); //set column field database for datatable orderable
	var $column_search = array('pos.nama', 'des.nama', 'pos.status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('pos.nama' => 'asc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_posyandu()
	{
        $this->db->select('pos.id as id, 
                            pos.desa_id as desa_id, 
                            pos.nama as nama, 
                            des.nama as desa, 
                            pos.status as status, 
                            pos.created_by as created_by, 
                            pos.created_on as created_on,
                            pos.updated_by as updated_by,
                            pos.updated_on as updated_on,
                            pos.deleted as deleted
                         ');
		$this->db->from($this->t_posyandu.' pos');
        $this->db->join($this->t_desa.' des', 'des.id = pos.desa_id');
		$this->db->where('pos.status', 1);
		$this->db->where('pos.deleted', 0);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('pos.nama'))
		{
			$this->db->like('pos.nama', $this->input->post('nama'));
		}
		if($this->input->post('des.nama'))
		{
			$this->db->like('des.nama', $this->input->post('desa'));
		}
		if($this->input->post('pos.status'))
		{
			$this->db->where('pos.status', $this->input->post('status'));
		}

		$this->db->where('pos.deleted', 0);
		
        $this->db->select('pos.id as id, 
                            pos.desa_id as desa_id, 
                            pos.nama as nama, 
                            des.nama as desa, 
                            pos.status as status, 
                            pos.created_by as created_by, 
                            pos.created_on as created_on,
                            pos.updated_by as updated_by,
                            pos.updated_on as updated_on,
                            pos.deleted as deleted
                         ');
		$this->db->from($this->t_posyandu.' pos');
        $this->db->join($this->t_desa.' des', 'des.id = pos.desa_id');

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
		$this->db->from($this->t_posyandu);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->t_posyandu);
		$this->db->where('id',$id);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert($this->t_posyandu, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function update($where, $data)
	{
		$this->db->trans_start();
		$save = $this->db->update($this->t_posyandu, $data, $where);
		$this->db->trans_complete();
		return $save;
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->t_posyandu);
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
}
