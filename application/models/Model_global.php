<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_global extends CI_Model {

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


}