<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    protected $_data_load;

    protected $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Login";
        $this->_data_load['error'] = $this->session->flashdata('error');
        $this->_data_load['success'] = $this->session->flashdata('success');
		$this->_init_user();
    
    }

    protected function _init_user(){
    	$this->_customer_id = $this->session->userdata('customer_id');
        if(!empty($this->_customer_id)){
            $this->load->model('mod_customer','_customer',true,$this->_customer_id);
        }
    }

    public function index(){
        if(!empty($this->_customer_id)){
            redirect(base_url());
        }
        $this->load->view('login',$this->_data_load);
    }

    public function post(){
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('pass', 'Passwrd', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->_data_load['error'] = "Login failed";
            $this->load->view('login',$this->_data_load);
        } else {
            $redirect = $this->input->get('redirect');
            $email = $this->input->post('email');
            $pass = $this->input->post('pass');
            $this->load->model('mod_customer','_customer');
            $login = $this->_customer->login($email,$pass);
            if($login){
                $this->session->set_userdata('customer_id',$this->_customer->id);
                $data = $this->_customer->data;
                $data['last_login'] = time();
                $data['mdate'] = time();
                $this->_customer->set_value($data);
                $this->_customer->update();
                if(isset($redirect) && !empty($redirect)){
                    $url_red = urldecode($redirect);
                    redirect($url_red);
                } else {
                    redirect(base_url());
                }
                
            } else {
                $this->session->set_flashdata('error','Something error, try again later');
                redirect(base_url().'login/');
            }
        }
    }

    public function off(){
        $this->session->unset_userdata('customer_id');
        redirect(base_url());
    }

}