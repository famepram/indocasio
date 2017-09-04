<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
    
    protected $_data_load;

    protected $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }

        $this->_data_load['page_title'] = "Page";
		$this->_init_user();
    
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




    public function view(){
        $slug = end($this->uri->segment_array());
        //die($slug);
        $this->load->model('mod_page','_page',true,'',$slug);
        if(empty($this->_page->data)){
            redirect(base_url().'404/');
        }
        $this->load->view('page',$this->_data_load);
    }

}