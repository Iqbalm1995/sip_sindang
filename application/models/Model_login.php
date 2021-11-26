<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	private $t_users		= 'usr_users';
    private $t_roles		= 'usr_roles';
	private $t_posyandu		= 'pos_posyandu';

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    function get_user_login($uname, $pass) { 
		
        $this->db->select('usr.id AS id, 
                            usr.role_id AS role_id, 
                            rol.name AS role_name,
                            usr.pos_id AS pos_id, 
                            pos.nama AS pos_name, 
                            usr.username AS username, 
                            usr.email AS email, 
                            usr.nama AS nama, 
                            usr.password AS password, 
                            usr.status AS status, 
                            usr.created_by AS created_by, 
                            usr.created_on AS created_on,
                            usr.updated_by AS updated_by,
                            usr.updated_on AS updated_on,
                            usr.deleted AS deleted
                         ');
		$this->db->from($this->t_users.' usr');
        $this->db->join($this->t_roles.' rol', 'rol.id = usr.role_id');
        $this->db->join($this->t_posyandu.' pos', 'pos.id = usr.pos_id', 'left');
		$this->db->where('usr.status', 1);   
		$this->db->where('rol.status', 1);    
		$this->db->where('usr.deleted', 0);    
	    $this->db->where('usr.username', $uname);
	    $result = $this->validation_user($pass);

	    if (!empty($result)) {
	        return $result;
	    } else {
	        return null;
	    }
	}

    function validation_user($pass) {
	    $query = $this->db->get();
	    $result = $query->row();
	    if ($query->num_rows() > 0) {
	        $result = $query->row();
	        if (password_verify($pass, $result->password)) {
	            //We're good
	            return $result;
	        } else {
	            //Wrong password
	            return array();
	        }

	    } else {
	        return array();
	    }
	}


}