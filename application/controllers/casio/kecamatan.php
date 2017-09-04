<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Kecamatan';

	private $_admin_id;

	private $_menu_index = 1;

	private $_submenu_index = 0;

	private $_data_load = array();

// -------------------------- Default Property -------------------------------------//	

	public function __construct(){
		parent::__construct();
		$this->_init();
	}

	private function _init(){
		$this->_root_path = base_url().DIR_ADMIN;
		$this->_page_path = $this->_root_path.'kecamatan/';
		$this->_admin_id  = $this->session->userdata('admin_id');

		if(empty($this->_admin_id)){
			redirect($this->_root_path.'login/');
		}

		$this->_data_load['root_path'] 		= $this->_root_path;
		$this->_data_load['page_path'] 		= $this->_page_path;
		$this->_data_load['page_name'] 		= $this->_page_name.' | '.GG_APPNAME;
		$this->_data_load['page_caption'] 	= $this->_page_name;
		
		$this->_data_load['menu_index'] 	= $this->_menu_index;
		$this->_data_load['submenu_index'] 	= $this->_submenu_index;

		$this->_data_load['error'] = $this->session->flashdata('error');
		$this->_data_load['success'] = $this->session->flashdata('success');
		$this->_init_admin();
	}

	private function _init_admin(){
		$this->load->model('mod_admin','adm',true,$this->_admin_id);
		$this->_data_load['adm'] 		= $this->adm;
	}

	public function index(){
		$this->_data_load['page_caption'] 	= 'List Kecamatan';
		$city = $this->input->get('city');
		if(!empty($city)){
			$this->load->model('mod_kecamatan');
			$list 	= $this->mod_kecamatan->get_by_city($city);
			$this->_data_load['list'] = $list;
			$this->load->view('admin/kecamatan-list',$this->_data_load);
		} else {
			$this->load->view('admin/kecamatan-pilih',$this->_data_load);
		}
		
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Kecamatan';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/kecamatan-form',$this->_data_load);
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_kecamatan','kecamatan',true,$id);
		$data 					= $this->kecamatan->data;
		$name 					= $this->input->post('name');
		$city_id 				= $this->input->post('city_id');
		$data['name'] 			=  $name;
		$data['city_id'] 		=  $city_id;
		$data['oke'] 			=  $this->input->post('oke');
		$data['oke_et'] 		=  $this->input->post('oke_et');
		$data['reg'] 			=  $this->input->post('reg');
		$data['reg_et'] 		=  $this->input->post('reg_et');
		$data['yes'] 			=  $this->input->post('yes');
		$data['yes_et'] 		=  $this->input->post('yes_et');
		$data['avgojek'] 		=  $this->input->post('avgojek');
		//die($this->input->post('avgojek')."dsadsa------------dsadas");
		$data['mdate'] 			=  time();
		if(empty($id)){
			$data['cdate'] 			=  time();
		}
        $this->kecamatan->set_value($data);
        if(!empty($id)){
        	$this->kecamatan->update();
        	$this->session->set_flashdata('success','Kecamatan has been successfully updated.');
        } else {
			$this->kecamatan->add();
			redirect($this->_root_path.'kecamatan/');
			$this->session->set_flashdata('success','Kecamatan has been successfully added.');
			
        }
        redirect($this->_root_path.'kecamatan/?city='.$city_id);
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_kecamatan','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/kecamatan-form',$this->_data_load);
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function delete(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_kecamatan','object',true,$id);
			$data = $this->object->data;
			$city_id = $this->object->city_id;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Kecamatan has been successfully deleted.');
				redirect($this->_root_path.'kecamatan/?city='.$city_id);
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function get_option_city(){
        $province = $this->input->post('province');
        $options = '<option value=0>Pilih Kota / Kabupaten</option>';
        $json_response = array('options'=>$options.get_option_city($province));
        echo json_encode($json_response);
    }
}