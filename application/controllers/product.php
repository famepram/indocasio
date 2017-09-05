<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
    
    protected $_data_load;

    protected $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Product";
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

    private function _init_product(){

        $raw_slug = end($this->uri->segment_array());
        $slug = strstr($raw_slug, '.', true); 
        $this->load->model('mod_product','_product',true,'',$slug);
        if(empty($this->_product->data)){
            $this->session->set_flashdata('error','Product not found');
            redirect(base_url());
        }
        return $this->_product ;
    }


    public function view(){
        //die("sdsadsad");
        $_product = $this->_init_product();
        $this->_data_load['_product'] = $this->_product;
        $this->load->model('mod_category','_category',true,$this->_product->category);
        $this->_data_load['_category'] = $this->_category;
        $this->_data_load['cats'] = $this->_category->get_by_parent(0);
        $this->load->view('product',$this->_data_load);
    }

    public function add_to_cart(){
        $response = array('status'=>false,'total_qty'=>null);
        $pid = $this->input->post('pid',true);
        $qty = $this->input->post('pqty',true);
        if(!empty($pid) && !empty($qty)){
            $this->mod_cart->add($pid,$qty);
            $response['status']         = false;
            $response['prod']           = $this->mod_cart->items[$pid];
            $response['total_qty']      = $this->mod_cart->get_total_qty();
        }
        echo json_encode($response);
        
    }

    public function submit_inquiry(){
        $response   = array('status'=>false,'message'=>null);
        $pid        = $this->input->get('product_id',true);
        $name       = $this->input->post('name',true);
        $email      = $this->input->post('email',true);
        $phone      = $this->input->post('phone',true);
        if(!empty($pid) && !empty($name) && !empty($email) && !empty($phone)){
            $this->load->model('mod_inquiry');
            $data = array();
            $data['product_id']         = $pid;
            $data['name']               = $name;
            $data['email']              = $email;
            $data['phone']              = $phone;
            $data['cdate']              = time();
            $data['mdate']              = time();
            $this->mod_inquiry->set_value($data);
            $this->mod_inquiry->add();
            $response['status']         = true;
            $response['message']        = "Kami akan segera memberitahu anda via emai jika stock barang tersedia.";
        }
        echo json_encode($response);
    }

    public function close_inquiry($inquiry_id){
        $this->load->model('mod_inquiry','_inquiry',$inquiry_id);
        $this->mod_cart->add($this->_inquiry->product_id,1);
        $data   = $this->_inquiry->data;
        $data['status'] = 2;
        $data['mdate']  = time();
        $this->_inquiry->set_value($data);
        $this->_inquiry->update();
        redirect(base_url('cart'));
    }

}