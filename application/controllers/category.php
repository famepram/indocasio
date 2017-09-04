<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
    
    protected $_data_load;

    protected $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }

        $this->_data_load['page_title'] = "Category";
		$this->_init_user();
    
    }

    protected function _init_user(){
    	$this->_user_id = $this->session->userdata('customer_id');
    	if($this->_auth){
    		if(empty($this->_user_id)){
    			redirect(base_url().GG_PATH_NO_ACCESS);
    		}
    		$this->load->model('mod_customer','_customer',true,$this->_user_id);
    		$this->_data_load['user'] = $this->_user;
    	}
    }

    protected function _init_category(){
        $uris = $this->uri->segment_array();
        $len  = count($uris);
        if($len == 1){
            $slug = end($uris);
            $this->load->model('mod_category','_cat',true,'',$slug);
            return $this->_cat;
        } else {
            $pslug = $uris[1];
            $slug = end($uris);
            $this->load->model('mod_category','_cat',true,'',$pslug);
            $_cat = $this->_cat->get_by_parent_slug($this->_cat->id,$slug);
            return $_cat;
        }

    }
    
    public function index(){

        $this->load->model('mod_category');
        $this->_data_load['cats'] = $this->mod_category->get_by_parent(0);
        $this->load->view('home',$this->_data_load);
    }

    public function view(){
        
        $sort = $this->input->get('order_by');
        $page = $this->input->get('page');
        $show = $this->input->get('show');

        $this->sort = empty($sort)?'popular':$sort;
        $this->page = empty($page)?1:$page;
        $this->show = empty($show)?12:$show;

        if($this->sort == 'price') {
            $this->order_by = 'price';
            $this->order_seq = 'asc';
        } else if($this->sort == 'name') {
            $this->order_by = 'code';
            $this->order_seq = 'asc';
        // } else if($this->sort == 'latest') {
        //     $this->order_by = 'cdate';
        //     $this->order_seq = 'desc';
        } else {
            $this->order_by = 'sort';
            $this->order_seq = 'asc';
        }

        $this->from = ($this->page - 1) *  $this->show;


        $_cat = $this->_init_category();
        $slug = end($this->uri->segment_array());
        $this->_data_load['_category'] = $_cat;
        $this->_data_load['cats'] = $_cat->get_by_parent(0);
        $this->load->view('category',$this->_data_load);
    }

}