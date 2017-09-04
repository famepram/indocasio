<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    
    protected $_data_load;

    protected $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Register";
		$this->_init_user();

        $this->_error = $this->session->flashdata('error');
        //$this->session->keep_flashdata('success'); 
        $this->_success = $this->session->flashdata('success');
    
    }

    protected function _init_user(){
    	$this->_customer_id = $this->session->userdata('customer_id');
    	if($this->_auth){
    		if(empty($this->_customer_id)){
    			redirect(base_url().GG_PATH_NO_ACCESS);
    		}

    		$this->load->model('mod_customer','_customer',true,$this->_customer_id);
    		$this->_data_load['user'] = $this->_user;
    	}
    }

    
    
    public function index(){
        if(!empty($this->_customer_id)){
            redirect(base_url());
        }
        $redirect = $this->input->get('redirect',true);
        $this->_data_load['redirect'] = urlencode($redirect);
        $this->load->view('register',$this->_data_load);
    }

    public function post(){
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');        
        $this->form_validation->set_rules('pass', 'Password', 'required');
        $this->form_validation->set_rules('conpass', 'Username', 'matches[pass]');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('register',$this->_data_load);
        } else {
            $this->load->model('mod_customer');
            $data = array();
            $data['fname'] = $this->input->post('fname');
            $data['lname'] = $this->input->post('lname');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $pass = $this->input->post('pass');
            $data['password']  = $this->mod_customer->hash_pass($pass);
            $data['last_login'] = time();
            $data['cdate'] = time();
            $data['mdate'] = time();
            $this->mod_customer->set_value($data);
            if($this->mod_customer->add()){
                $this->session->set_userdata('customer_id',$this->mod_customer->id);
                // sending email
                $redirect = $this->input->get('redirect',true);
                if(isset($redirect) && !empty($redirect)){
                    $url_red = urldecode($redirect);
                    redirect($url_red);
                } else {
                    redirect(base_url().'register/success/');
                }
            } else {
                $this->_data_load['error'] = 'Something error, try again later';
                $this->load->view('register',$this->_data_load);
                $this->session->set_flashdata('error','Something error, try again later');
            }
        }
    }

    public function success(){
        if(!empty($this->_customer_id)){
            redirect(base_url());
        }
        $this->load->view('login',$this->_data_load);
    }



    public function view(){
        $_cat = $this->_init_category();
        $slug = end($this->uri->segment_array());
        $this->_data_load['_category'] = $_cat;
        $this->_data_load['cats'] = $_cat->get_by_parent(0);
        $this->load->view('category',$this->_data_load);
    }

    public function forget_pass(){
        if(!empty($this->_customer_id)){
            redirect(base_url());
        }
        $redirect = $this->input->get('redirect',true);
        $this->load->view('forget-pass',$this->_data_load);
    }



    public function fp_post(){
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('forget-pass',$this->_data_load);
        } else {
            $email = $this->input->post('email');
            $this->load->model('mod_customer','_cust',true,'',$email);
            if(!empty($this->_cust->data)){
                $data = $this->_cust->data;
                $rand = $this->_cust->id.random_string('alnum', 16);
                $data['fp_token'] = $rand;
                $this->_cust->set_value($data);
                $this->_cust->update();
                $this->mod_email->send_email_fp($this->_cust->id);
                $this->session->set_flashdata('success','We have sent link into your email to reset your password');
            } else {
                $this->session->set_flashdata('error','email not found');
            }
            redirect(base_url().'register/forget_pass/','refresh');
        }
    }

    public function reset_pass(){
        if(!empty($this->_customer_id)){
            redirect(base_url());
        }
        $token = $this->input->get('token',true);
        $row = $this->db->get_where('customer',array('fp_token'=>$token))->row();
        if(!empty($row)){
            $this->load->view('reset-password',$this->_data_load);
        } else {
            $this->session->set_flashdata('error','Link Not valid');
            redirect(base_url().'forget_pass/','refresh');
        }
        
    }

    public function rp_post(){
        $this->form_validation->set_rules('pass', 'Password', 'required');
        $this->form_validation->set_rules('conpass', 'Username', 'matches[pass]');
        $token = $this->input->get('token',true);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error','password you not valid');
            redirect(base_url().'reset_pass/?token='.$token,'refresh');
        } else {
            $email = $this->input->post('email');
            $this->load->model('mod_customer');
            $row = $this->db->get_where('customer',array('fp_token'=>$token))->row_array();
            if(!empty($row)){
                $this->mod_customer->set_value($row);
                //$this->mod_customer->update();
                $data = $this->mod_customer->data;
                $pass = $this->input->post('pass');
                $data['password']  = $this->mod_customer->hash_pass($pass);
                $data['mdate'] = time();
                $this->mod_customer->set_value($row);
                $this->mod_customer->update();
                $this->session->set_flashdata('success','Password has been successfuly reset');
                redirect(base_url().'login/','refresh');
            } else {
                $this->session->set_flashdata('error','customer not found');
            }
            redirect(base_url().'forget_pass/','refresh');
        }
    }

}