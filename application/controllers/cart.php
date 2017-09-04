<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {
    
    protected $_data_load;

    public $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Cart";
        $this->_init_user();

    
    }

    protected function _init_user(){
        $this->_customer_id = $this->session->userdata('customer_id');
        if(!empty($this->_customer_id)){
            $this->load->model('mod_customer','_customer',true,$this->_customer_id);
        }        
    }

    public function index(){
        $this->load->view('cart',$this->_data_load);
    }

    public function remove(){
        $json_response = array('status'=>true,'total'=>0,'total_price'=>0);
        $id = $this->input->post('id');
        if(!empty($id)){
            $this->mod_cart->remove($id);
            $json_response['total'] = $this->mod_cart->get_total_qty();
            $json_response['total_price']   = $this->mod_cart->total_price_format;
            
        }
        echo json_encode($json_response);
    }

}