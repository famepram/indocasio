<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Admin';

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
		$this->_page_path = $this->_root_path.'admin/';
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
		$this->_data_load['page_caption'] 	= 'List Admin';
		$this->load->model('mod_admin');
		$list 	= $this->mod_admin->get_all();
		$this->_data_load['list'] = $list;
		$this->load->view('admin/admin-list',$this->_data_load);
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Admin';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/admin-form',$this->_data_load);
	}

	public function updater(){

		$id = $this->input->post('id');
		$this->load->model('mod_admin','_admin',true,$id);      
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('username','Username','required');

        if($this->form_validation->run()){
    		$data = $this->_admin->data;
    		$username = $this->input->post('username');
    		$data['name']                   = $this->input->post('name');
	        $data['username']               = $username;
	        if(empty($id)){
	        	$password = $this->input->post('pass');
    			$hashpass = sha1(SALT_ADM.$password);
				$data['password']           = $hashpass;
	        }
    		
	        if(empty($id)) {
	        	$data['cdate']          = time();
	        }
	        $data['mdate']              = time();  
	        $this->_admin->set_value($data);
	        if(!empty($id)){
	            $process = 'updated';
	            $return = $this->_admin->update();
	        } else {
	            $process = 'added';
	            $return = $this->_admin->add();
	        }

	        if($return){
	        	$this->session->set_flashdata('success','Data admin successfully '.$process);
	        } else {
	        	$this->session->set_flashdata('error','Something error in the system ');
	        }
		} else {
			$this->session->set_flashdata('error','Something error in the system ');
		}
		redirect($this->_root_path.'admin/');
        
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_admin','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/admin-form',$this->_data_load);
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function update_pass(){

		$this->load->view('admin/admin-pass-form',$this->_data_load); 
	}

	public function pass_updater(){
		$pass = $this->input->post('oldpass');
		$hasspass = sha1(SALT_ADM.$pass);
		if($this->adm->password == $hasspass){
			$newpass = $this->input->post('pass');
			$conpass = $this->input->post('conpass');
			if($newpass = $conpass){
				$hass_newpass = sha1(SALT_ADM.$newpass);
				$data = $this->adm->data;
				$data['password'] = $hass_newpass;
				$this->adm->set_value($data);
				$this->adm->update();
				$this->session->set_flashdata('success','password has been successfully updated.');
			} else {
				$this->session->set_flashdata('error','password doesnt match to confirm password.');
			}
		} else {
			$this->session->set_flashdata('error','current password not valid.');
		}
		redirect($this->_root_path.'admin/');	
	}

	public function delete(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_admin','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Admin has been successfully deleted.');
				redirect($this->_root_path.'admin/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}
}