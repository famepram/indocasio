<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
    
    protected $_data_load;

    protected $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Search";
		$this->_init_user();
    
    }

    protected function _init_user(){
    	$this->_user_id = $this->session->userdata('customer_id');
    	if($this->_auth){
    		if(empty($this->_user_id)){
    			redirect(base_url().GG_PATH_NO_ACCESS);
    		}
    		$this->load->model('mod_customer','_customer',true,$this->_user_id);
    		$this->_data_load['_customer'] = $this->_customer;
    	}
    	
    }

    protected function _init_product(){
        $raw_slug = end($this->uri->segment_array());
        $slug = strstr($raw_slug, '.', true); 
        $this->load->model('mod_product','_product',true,'',$slug);
        return $this->_product ;
    }


    public function index(){
        $this->q = $this->input->get('q',true);
        $this->list = array();
        if(!empty($this->q)){
            $this->load->model('mod_product');
            $this->list = $this->mod_product->search($this->q);
        }
        $this->load->model('mod_category');
        $this->_data_load['cats'] = $this->mod_category->get_by_parent(0);
        $this->load->view('search',$this->_data_load);
    }

    public function add_to_cart(){
        $response = array('status'=>false,'total_qty'=>null);
        $pid = $this->input->post('pid',true);
        $qty = $this->input->post('pqty',true);
        if(!empty($pid) && !empty($qty)){
            $this->mod_cart->add($pid,$qty);
            $response['status'] = false;
            $response['total_qty'] = $this->mod_cart->get_total_qty();
        }
        echo json_encode($response);
        
    }

}