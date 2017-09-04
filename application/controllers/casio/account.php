<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Account';

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
		$this->_page_path = $this->_root_path.'account/';
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
		$this->_data_load['page_caption'] 	= 'List Account';
		$this->load->model('mod_account');
		$list 	= $this->mod_account->get_all();
		$this->_data_load['list'] = $list;
		$this->load->view('admin/account-list',$this->_data_load);
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Account';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/account-form',$this->_data_load);
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_account','account',true,$id);
		$data 		= $this->account->data;
		$acc_no 	= $this->input->post('acc_no');
		$acc_name 	= $this->input->post('acc_name');
		$bank_name 	= $this->input->post('bank_name');
		$status		= $this->input->post('status');
		$data['acc_no'] 	=  $acc_no;
		$data['acc_name'] 	=  $acc_name;
		$data['bank_name'] 	=  $bank_name;
		$data['status'] 	=  $status;
		$data['mdate'] = time();


        if(empty($id)){
        	$data['cdate'] = time();
        } 
        $this->account->set_value($data);
        if(!empty($id)){
        	$this->account->update();
        	$this->session->set_flashdata('success','Account has been successfully updated.');
        } else {
			$this->account->add();
			redirect($this->_root_path.'account/');
			$this->session->set_flashdata('success','Account has been successfully added.');
			
        }
        redirect($this->_root_path.'account/');
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_account','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/account-form',$this->_data_load);
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
			$this->load->model('mod_account','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Account has been successfully deleted.');
				redirect($this->_root_path.'account/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}
}