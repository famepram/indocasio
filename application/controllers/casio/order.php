<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Order';

	private $_admin_id;

	private $_menu_index = 1;

	private $_submenu_index = 0;

	private $_data_load = array();

// -------------------------- Default Property -------------------------------------//	

	public function __construct(){
		parent::__construct();
		$this->_init();
	}

	private function _init(){
		$this->_root_path = base_url().DIR_ADMIN;
		$this->_page_path = $this->_root_path.'order/';
		$this->_admin_id  = $this->session->userdata('admin_id');

		if(empty($this->_admin_id)){
			redirect($this->_root_path.'login/');
		}

		$this->_data_load['root_path'] 		= $this->_root_path;
		$this->_data_load['page_path'] 		= $this->_page_path;
		$this->_data_load['page_name'] 		= $this->_page_name.' | '.GG_APPNAME;
		$this->_data_load['page_caption'] 	= $this->_page_name;
		
		$this->_data_load['menu_index'] 	= $this->_menu_index;
		$this->_data_load['submenu_index'] 	= $this->_submenu_index;

		$this->_data_load['error'] = $this->session->flashdata('error');
		$this->_data_load['success'] = $this->session->flashdata('success');
		$this->_init_admin();
	}

	private function _init_admin(){
		$this->load->model('mod_admin','adm',true,$this->_admin_id);
		$this->_data_load['adm'] 		= $this->adm;
	}

	public function index(){
		$this->_data_load['page_caption'] 	= 'List Order';
		$this->load->model('mod_order');
		$this->load->view('admin/order-list',$this->_data_load);
	}

	public function view(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_order','_order',true,$id);
			$this->load->view('admin/order-view',$this->_data_load);
		} else {
			$this->session->set_flashdata('error','Order not found.');
			redirect($this->_root_path.'error_404/');
		}
		
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Order';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/order-form',$this->_data_load);
	}

	public function delete(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_order','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Order has been successfully deleted.');
				redirect($this->_root_path.'order/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_order','order',true,$id);
		$data 		= $this->order->data;
		$status 	= $this->input->post('status',true);
		$nogojek 	= $this->input->post('no_gojek',true);
		$bkgojek 	= $this->input->post('bk_gojek',true);
		$noresi 	= $this->input->post('no_resi',true);
		$info 		= $this->input->post('info',true);
		$data['status'] 		=  $status;
		$data['no_gojek'] 		=  $nogojek;
		$data['bk_gojek'] 		=  $bkgojek;
		$data['info'] 			=  $info;
		$data['track_no'] 		=  $noresi;
		$data['mdate'] = time();
        $this->order->set_value($data);
    	$this->order->update();
    	$this->mod_email->send_email_order($this->order->id);
    	$this->session->set_flashdata('success','Order has been successfully updated.');
		redirect($this->_root_path.'order/view/'.$id);
	}

	public function address(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_order','_order',true,$id);
			$this->load->view('admin/order-address',$this->_data_load);
		} else {
			$this->session->set_flashdata('error','Order not found.');
			redirect($this->_root_path.'error_404/');
		}
	}



	public function email(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_order','_order',true,$id);
			$this->load->view('admin/order-email',$this->_data_load);
		} else {
			$this->session->set_flashdata('error','Order not found.');
			redirect($this->_root_path.'error_404/');
		}
	}

	 public function payment_email(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->_data_load['to_admin'] = true;
			$this->load->model('mod_payment','_payment',true,$id);
			$this->load->model('mod_order','_order',true,$this->_payment->order_id);
			$this->load->view('admin/payment-email',$this->_data_load);
		} else {
			$this->session->set_flashdata('error','Order not found.');
			redirect($this->_root_path.'error_404/');
		}
        
        
    }

    public function payment(){
		$this->_data_load['page_caption'] 	= 'List Payment';
		$this->load->model('mod_payment');
		$this->load->view('admin/payment-list',$this->_data_load);
	}

	public function testimoni(){
		$this->_data_load['page_caption'] 	= 'List Testimoni';
		$this->load->model('mod_testimoni');
		$this->load->view('admin/testimoni-list',$this->_data_load);
	}

	public function testimoni_set(){
		$id = $this->input->post('id');
		$status = $this->input->post('val');
		$this->load->model('mod_testimoni','testi',true,$id);
		$data = $this->testi->data;
		$data['status'] = $status;
		$data['mdate'] = time();
		$this->testi->set_value($data);
		$this->testi->update();
	}

	public function delete_testimoni(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_testimoni','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Testimoni has been successfully deleted.');
				redirect($this->_root_path.'order/testimoni/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

}