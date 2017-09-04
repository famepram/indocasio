<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'User';

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
		$this->_root_path = base_url();
		$this->_page_path = $this->_root_path.'manufacture/';
		$this->_admin_id  = $this->session->userdata('admin_id');

		// if(empty($this->_admin_id)){
		// 	redirect($this->_root_path.'login/');
		// }

		$this->_data_load['root_path'] 		= $this->_root_path;
		$this->_data_load['page_path'] 		= $this->_page_path;
		$this->_data_load['page_name'] 		= $this->_page_name.' | '.GG_APPNAME;
		
		$this->_data_load['menu_index'] 	= $this->_menu_index;
		$this->_data_load['submenu_index'] 	= $this->_submenu_index;
		//$this->_init_admin();
	}

	private function _init_admin(){
		$this->load->model('mod_admin','adm',true,$this->_admin_id);
		$this->_data_load['adm'] 		= $this->adm;
	}

	public function index(){
		$this->load->view('user-list',$this->_data_load);
	}

	public function add(){
		$this->load->view('user-add',$this->_data_load);
	}

	public function update(){
		$this->load->view('user-update',$this->_data_load);
	}

	public function update_pass(){
		$this->load->view('user-update-pass',$this->_data_load);
	}

	public function activity(){
		$this->load->view('user-activity',$this->_data_load);
	}

}