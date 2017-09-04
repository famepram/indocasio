<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    
    protected $_data_load;

    public $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    protected $_error = ''; 

    public $_success = ''; 

    public function __construct() {
        parent::__construct();
        $this->_data_load['page_title'] = "Category";
		$this->_init_user();
        //$this->session->keep_flashdata('error'); 
        $this->_error = $this->session->flashdata('error');
        //$this->session->keep_flashdata('success'); 
        $this->_success = $this->session->flashdata('success');
        //die($this->_success.'---------------dsadasdsa------------------');

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }

    
    }

    protected function _init_user(){
    	$this->_customer_id = $this->session->userdata('customer_id');
        if(!empty($this->_customer_id)){
            $this->load->model('mod_customer','_customer',true,$this->_customer_id);
        } else {
            redirect(base_url());
        }
    }
    
    public function profile(){
        $this->load->view('account-profile',$this->_data_load);
    }

    public function profile_post(){
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');        
        if ($this->form_validation->run() == FALSE){
            $this->load->view('account-profile',$this->_data_load);
        } else {
            $data = $this->_customer->data;
            $data['fname'] = $this->input->post('fname');
            $data['lname'] = $this->input->post('lname');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['mdate'] = time();
            $this->_customer->set_value($data);
            if($this->_customer->update()){
                $this->session->set_flashdata('success','Profile has been successfully updated');
                redirect(base_url().'account/profile/','refresh');
            } else {
                $this->session->set_flashdata('error','Something error, try again later');
                redirect(base_url().'account/profile/','refresh');
            }
        }
    }

    public function password(){
        $this->load->view('account-password',$this->_data_load);
    }

    public function password_post(){
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error','your password wrong');
                redirect(base_url().'account/password/','refresh');
        } else {
            $email = $this->_customer->email;
            $pass  = $this->input->post('pass');
            $login = $this->_customer->login($email,$pass);
            if($login){
                $newpass = $this->input->post('newpass');
                $data = $this->_customer->data;
                $data['password']  = $this->_customer->hash_pass($newpass);
                $data['mdate']     = time();
                $this->_customer->set_value($data);
                $this->_customer->update();
                $this->session->set_flashdata('success','Password has been successfully updated');
                redirect(base_url().'account/password/','refresh');
            } else {
                $this->session->set_flashdata('error','Something error, try again later');
                redirect(base_url().'account/password/');
            }
        }
    }

    public function address_book(){
        $this->load->view('account-ab',$this->_data_load);
    }

    public function view(){
        $_cat = $this->_init_category();
        $slug = end($this->uri->segment_array());
        $this->_data_load['_category'] = $_cat;
        $this->_data_load['cats'] = $_cat->get_by_parent(0);
        $this->load->view('category',$this->_data_load);
    }

    public function ab_update(){
        $ab_id = end($this->uri->segment_array());
        $this->load->model('mod_address_book','_ab',true,$ab_id);
        if(empty($this->_ab->data)){
            redirect(base_url().'account/address_book/');
        }
        $this->load->view('account-ab-form',$this->_data_load);
    }

    public function ab_add(){
        $ab_id = end($this->uri->segment_array());
        $this->_ab = false;
        $this->load->view('account-ab-form',$this->_data_load);
    }

    public function ab_updater(){
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error','Street Address must not be empty');
            redirect(base_url().'account/address_book/','refresh');
        } else {
            $ab_id = $this->input->post('ab_id');
            $this->load->model('mod_address_book','_ab',true,$ab_id);
            $data = $this->_ab->data;
            $is_def              = $this->input->post('is_default');
            $data['customer_id'] = $this->_customer->id;
            $data['address']     = $this->input->post('address');
            $data['city_id']     = $this->input->post('city_id');
            $data['kecamatan_id'] = $this->input->post('kecamatan_id');
            $data['postal_code'] = $this->input->post('postal_code');
            $data['is_default']  = $is_def;
            $data['mdate']       = time();
            if(!empty($ab_id)){
                $data['cdate']       = time();
            }

            $this->_ab->set_value($data);
            if(!empty($ab_id)){
                $process = $this->_ab->update();
            } else {
                $process = $this->_ab->add();
            }

            if($process){
                if($is_def == 1){
                    //die(json_encode($this->_ab));
                    $data = array('is_default' => 0);
                    $this->db->where(array('id !='=>$this->_ab->id, 'customer_id'=>$this->_customer->id));
                    $this->db->update($this->_ab->table, $data);
                    //die($this->db->last_query());
                }
                $this->session->set_flashdata('success','Address book has been successfully updated');
                redirect(base_url().'account/address_book/','refresh');
            } else {
                $this->session->set_flashdata('error','Something error');
                redirect(base_url().'account/address_book/','refresh');
            }

        }
    }

    public function ab_delete(){
        $id = end($this->uri->segment_array());
        if(is_numeric($id)){
            $this->load->model('mod_address_book','object',true,$id);
            $data = $this->object->data;
            if(!empty($data)){
                $this->object->delete();
                $this->session->set_flashdata('success','Address book has been successfully deleted');
                redirect(base_url().'account/address_book/','refresh');
            } else {
                $this->session->set_flashdata('error','Address book not found');
                redirect(base_url().'account/address_book/','refresh');
            }
        } else {
            $this->session->set_flashdata('error','Address book not found');
            redirect(base_url().'account/address_book/','refresh');
        }
    }

    public function ab_default(){
        $id = end($this->uri->segment_array());
        if(is_numeric($id)){
            $this->load->model('mod_address_book','object',true,$id);
            $data = $this->object->data;
            if(!empty($data)){
                $data['is_default'] = 1;
                $data['mdate'] = time();
                $this->object->set_value($data);
                $this->object->update();
                $data = array('is_default' => 0);
                $this->db->where(array('id !='=>$this->object->id, 'customer_id'=>$this->_customer->id));
                $this->db->update($this->object->table, $data);
                $this->session->set_flashdata('success','Address book has been set as default');
                redirect(base_url().'account/address_book/','refresh');
            } else {
                $this->session->set_flashdata('error','Address book not found');
                redirect(base_url().'account/address_book/','refresh');
            }
        } else {
            $this->session->set_flashdata('error','Address book not found');
            redirect(base_url().'account/address_book/','refresh');
        }
    }

    public function order(){
        $this->load->view('account-order',$this->_data_load);
    }

    public function view_order(){
        $id = end($this->uri->segment_array());
        if(is_numeric($id)){
            $this->load->model('mod_order','_order',true,$id);
            $data = $this->_order->data;
            if(empty($data)){
                $this->session->set_flashdata('error','Order not found');
                redirect(base_url().'account/order/','refresh');
            }

            if($this->_order->customer_id != $this->_customer_id){
                $this->session->set_flashdata('error','Order not found');
                redirect(base_url().'account/order/','refresh');
            }

            $this->load->view('account-view-order',$this->_data_load);
            
        } else {
            $this->session->set_flashdata('error','Order not found');
            redirect(base_url().'account/order/','refresh');
        }
    }

    public function testimoni(){
        $content = $this->input->post('content',true);
        if(!empty($content)){
            $this->load->model('mod_testimoni');
            $reff = $this->input->post('reff');
            $this->load->model('mod_order','_order',true,$reff);
            $data = $this->mod_testimoni->data;
            $data['fname'] = $this->_order->fname;
            $data['lname'] = $this->_order->lname;
            $data['reff']  = $reff;
            $data['content']  = $content;
            $data['status']  = 0;
            $data['cdate']  = time();
            $data['mdate']  = time();
            $this->mod_testimoni->set_value($data);
            $this->mod_testimoni->add();
            $this->session->set_flashdata('success','Thanks for adding testimoni');
        } else {
            $this->session->set_flashdata('error','Testimoni must not be empty');
        }
        redirect(base_url().'account/view_order/'.$reff);
    }


}