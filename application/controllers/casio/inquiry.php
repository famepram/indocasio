<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Inquiry';

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
		$this->_page_path = $this->_root_path.'inquiry/';
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
		$this->_data_load['page_caption'] 	= 'List Inquiry';
		$this->load->model('mod_inquiry');
		$this->load->view('admin/inquiry-list',$this->_data_load);
		
	}

	public function view(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_inquiry','_inquiry',true,$id);
			$this->load->view('admin/inquiry-view',$this->_data_load);
		} else {
			$this->session->set_flashdata('error','Order not found.');
			redirect($this->_root_path.'error_404/');
		}
		
	}

	public function send_info(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			//die("dasdas----------dsada");
			$this->load->model('mod_inquiry','_inquiry',true,$id);
			$this->mod_email->send_email_inquiry($id);
			redirect($this->_page_path.'view/'.$id);

		} else {
			$this->session->set_flashdata('error','Order not found.');
			redirect($this->_root_path.'error_404/');
		}
	}

}