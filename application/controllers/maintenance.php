<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends CI_Controller {
    
    protected $_data_load;

    public $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();
        $this->_data_load['page_title'] = "Maintenance";
        $this->_init_user();
    
    }

    protected function _init_user(){
        $this->_customer_id = $this->session->userdata('customer_id');
        if(!empty($this->_customer_id)){
            $this->load->model('mod_customer','_customer',true,$this->_customer_id);
        }        
    }

    public function index(){
        //$this->load->view('maintenance',$this->_data_load);
        $slug = 'maintenance';
        $this->load->model('mod_page','_page',true,'',$slug);
        if(empty($this->_page->data)){
            redirect(base_url().'404/');
        }
        $this->load->view('maintenance',$this->_data_load);
    }

}