<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    protected $_data_load;

    public $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Home";
		$this->_init_user();
    
    }

    protected function _init_user(){
    	$this->_customer_id = $this->session->userdata('customer_id');
        if(!empty($this->_customer_id)){
            $this->load->model('mod_customer','_customer',true,$this->_customer_id);
        }
		
    }

    
    public function index(){
        $this->load->model('mod_banner');
        $this->load->model('mod_ads');
        $this->load->model('mod_testimoni');
        $this->load->model('mod_category');
        $this->_error = $this->session->flashdata('error');
        $this->_success = $this->session->flashdata('success');
        $this->_data_load['cats'] = $this->mod_category->get_by_parent(0);
        $this->load->view('home',$this->_data_load);
    }

    public function subscribe(){
        $email = $this->input->post('email',true);
        if(!empty($email)){
            $this->db->where('email', $email);
            $this->db->from('newsletter');
            $count = $this->db->count_all_results();
            if(empty($count)){
                $data = array(
                   'email' => $email ,
                   'fname' => '' ,
                   'lname' => '' ,
                   'mdate' => time()
                );
                $this->db->insert('newsletter', $data); 
                $this->session->set_flashdata('success','Email Address Has Been Succesfully Subscribed');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('error','Email Address Already Subscribed');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error','Email Address Not Valid');
            redirect(base_url());
        }
    }

    public function verifikasi(){
        $this->load->view('googleb6aed53f742baa2c.html');
    }

}