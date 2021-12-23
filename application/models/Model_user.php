<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

	private $t_users		= 'usr_users';
    private $t_roles		= 'usr_roles';
	private $t_posyandu		= 'pos_posyandu';

	var $column_order = array(null, 'rol.name', 'pos.nama', 'usr.username', 'usr.email', 'usr.nama', 'usr.status'); //set column field database for datatable orderable
	var $column_search = array('usr.nama', 'usr.email', 'usr.username', 'rol.name', 'pos.nama', 'usr.status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('usr.created_on' => 'asc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_users($id = null)
	{
        $this->db->select('usr.id as id, 
                            usr.role_id as role_id, 
                            rol.name as role_name,
                            usr.pos_id as pos_id, 
                            pos.nama as pos_name, 
                            usr.username as username, 
                            usr.email as email, 
                            usr.nama as nama, 
                            usr.password as password, 
                            usr.status as status, 
                            usr.created_by as created_by, 
                            usr.created_on as created_on,
                            usr.updated_by as updated_by,
                            usr.updated_on as updated_on,
                            usr.deleted as deleted
                         ');
		$this->db->from($this->t_users.' usr');
        $this->db->join($this->t_roles.' rol', 'rol.id = usr.role_id');
        $this->db->join($this->t_posyandu.' pos', 'usr.id = usr.pos_id', 'left');
        if ($id !== null) {
            $this->db->where('usr.id', $id);
        }
		$this->db->where('usr.deleted', 0);
		$query = $this->db->get();

        if ($id !== null) {
            $return_final = $query->row();
        }else{
            $return_final = $query->result();
        }

		return $return_final;
	}

	
	public function get_by_username($username)
	{
		$this->db->from($this->t_users);
		$this->db->where('username',$username);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_email($email_invt)
	{
		$this->db->from($this->t_users);
		$this->db->where('email',$email_invt);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

    public function get_roles()
	{
        $this->db->select('*');
		$this->db->from($this->t_roles);
		$this->db->where_in('is_admin', array('0','1'));
		$this->db->where('status', 1);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result();
	}

    public function get_pos()
	{
        $this->db->select('*');
		$this->db->from($this->t_posyandu);
		$this->db->where('status', 1);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_datatables_query()
	{
		//add custom filter here
		if($this->input->post('status_user')) {
			if ($this->input->post('status_user') == 'aktif') {
				$this->db->where('usr.status', 1);
			}else if ($this->input->post('status_user') == 'nonaktif') {
				$this->db->where('usr.status', 0);
			}
		}
		if($this->input->post('roleFilter')) {
			$this->db->where('usr.role_id', $this->input->post('roleFilter'));
		}
		
		if($this->input->post('searchFilter')) { 
			$this->db->group_start()
                ->or_like('usr.username', $this->input->post('searchFilter'))
                ->or_like('usr.email', $this->input->post('searchFilter'))
                ->or_like('usr.nama', $this->input->post('searchFilter'))
            ->group_end();
		}

		if (!empty($this->session->userdata('pos_id'))) {
			$this->db->where('usr.pos_id', $this->session->userdata('pos_id'));
		}

		$this->db->where('usr.deleted', 0);
		
        $this->db->select('usr.id as id, 
                            usr.role_id as role_id, 
                            rol.name as role_name,
                            usr.pos_id as pos_id, 
                            pos.nama as pos_name, 
                            usr.username as username, 
                            usr.email as email, 
                            usr.nama as nama, 
                            usr.password as password, 
                            usr.status as status, 
                            usr.created_by as created_by, 
                            usr.created_on as created_on,
                            usr.updated_by as updated_by,
                            usr.updated_on as updated_on,
                            usr.deleted as deleted
                         ');
        $this->db->from($this->t_users.' usr');
        $this->db->join($this->t_roles.' rol', 'rol.id = usr.role_id');
        $this->db->join($this->t_posyandu.' pos', 'pos.id = usr.pos_id', 'left');

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
		$this->db->from($this->t_users);
		$this->db->where('deleted', 0);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->t_users);
		$this->db->where('id',$id);
		$this->db->where('deleted', 0);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->trans_start();
		$save = $this->db->insert($this->t_users, $data);
		$this->db->trans_complete();
		return $save;
	}

	public function update($where, $data)
	{
		$this->db->trans_start();
		$save = $this->db->update($this->t_users, $data, $where);
		$this->db->trans_complete();
		return $save;
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->t_users);
	}

	function cek($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
}
