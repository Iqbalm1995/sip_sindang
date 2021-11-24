<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        // model use
		$this->load->model('Model_desa','Model_desa');

        /* Restrict user */
        // if($this->session->userdata('status') != "login_active"){
		// 	redirect(base_url().'admin');
		// }
    }

	public function index()
	{
        // head data
        $head['title_page'] = 'Data Master Desa';
        $head['menu_active'] = 'desa';

        // body data
        $data['pages_caption'] = 'Data Master Desa';
        
		$this->load->view('template/header', $head);
        $this->load->view('desa/desa_views', $data);
        $this->load->view('template/footer');
	}

    public function datatable_list_desa()
	{
		// $this->load->helper('url');

		$list = $this->Model_desa->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r_desa) {
			$no++;
			$row = array();

			
			if ($r_desa->status == 1) {
				$status = '<span class="badge badge-primary">Aktif</span>';
			}else{
				$status = '<span class="badge badge-danger">Nonaktif</span>';
			}

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r_desa->nama;
			$row[] = '<div class="text-center">'.$status.'</div>';

			//add html for action
			$row[] = '<div class="text-center">
				  		<a class="btn btn-sm btn-primary" href="javascript:void(0)" 
							title="Ubah" 
							onclick="edit_desa('."'".$r_desa->id."'".')">
							<i class="fas fa-edit"></i> Ubah</a>
					  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
					  	  	title="Hapus"
					  	  	onclick="delete_desa('."'".$r_desa->id."'".')">
					  	  	<i class="fas fa-trash"></i> Hapus</a>
                      </div>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_desa->count_all(),
						"recordsFiltered" => $this->Model_desa->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


}
