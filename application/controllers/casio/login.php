<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Login';

	private $_admin_id;

	private $_data_load = array();

// -------------------------- Default Property -------------------------------------//	

	public function __construct(){
		parent::__construct();
		$this->_init();
	}

	private function _init(){
		$this->_root_path = base_url().DIR_ADMIN;
		$this->_page_path = $this->_root_path.'login/';
		$this->_admin_id  = $this->session->userdata('admin_id');
		$this->_data_load['root_path'] 	= $this->_root_path;
		$this->_data_load['page_path'] 	= $this->_page_path;
		$this->_data_load['page_name'] 	= $this->_page_name.' | '.GG_APPNAME;
		$this->_data_load['error'] = $this->session->flashdata('error');
		$this->_data_load['success'] = $this->session->flashdata('success');
	}
	
	public function index(){
		// if(!empty($this->admin_id)){
		// 	redirect($this->root_path.'dashboard/');
		// }
		$this->load->view('admin/login',$this->_data_load);
	}

	public function process(){
		$user = $this->input->post('username',true);
		$pass = $this->input->post('password',true);
		$this->load->model('mod_admin','adm',true,'',$user);
		$data = $this->adm->data;
		$hashpass = sha1(SALT_ADM.$pass);
		//die($hashpass);
		if(!empty($data)){
			if($this->adm->password == $hashpass){
				$data['lastlogin'] = time();
				$data['mdate']		= time();
				$this->adm->set_value($data);
				$this->adm->update();
				$this->session->set_userdata('admin_id',$this->adm->id);
				$this->session->set_flashdata('success','Login success!');
				redirect($this->_root_path.'dashboard/');
			} else {
				$this->session->set_flashdata('error','Username and password not match!');
				redirect($this->_root_path.'login/');
			}
		} else {
			$this->data_load['error'] = 'Account not found';
			$this->load->view('admin/login',$this->_data_load);
			$this->session->set_flashdata('error','Account not found!');
			redirect($this->_root_path.'login/');
		}
	}

	public function off(){
        $this->session->sess_destroy();
        redirect($this->_root_path);
    }

    public function authenticate_cross(){
    	$token_key = $this->input->get('key');

    	$this->load->model('mod_admin');
    	$data = $this->mod_admin->get_by_pass($token_key);
    	//die(json_encode($data));
    	if(!empty($data)){
    		$this->mod_admin->set_value($data);
    		$this->session->set_userdata('admin_id',$this->mod_admin->id);
    		$raw_url = $this->input->get('next');
    		$url = urldecode($raw_url);
    		redirect($url);
    	} else {
    		$this->session->set_flashdata('error','Authentaicating Failed');
			redirect($this->_root_path.'login/');
    	}
    	

    }
}