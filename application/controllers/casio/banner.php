<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Banner';

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
		$this->_page_path = $this->_root_path.'banner/';
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
		$this->_data_load['page_caption'] 	= 'List Banner';

		$this->load->model('mod_banner');
		$list 	= $this->mod_banner->get_all();
		$this->_data_load['list'] = $list;
		$this->load->view('admin/banner-list',$this->_data_load);
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Banner';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/banner-form',$this->_data_load);
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_banner','banner',true,$id);
		$data 		= $this->banner->data;
		$link 		= $this->input->post('link');
		$sort 		= $this->input->post('sort');
		$status		= $this->input->post('status');
		$data['link'] 		=  $link;
		$data['sort'] 		=  $sort;
		$data['status'] 	=  $status;
		$data['mdate'] = time();
		if(!empty($_FILES['image'])) {
			$upload_image = $this->banner->upload_image('image','banner');
            if($upload_image['img_url']!==false) {
                if(isset($this->banner->image) && $this->banner->image!='') {
                    $this->banner->delete_image();
                }
                $data['image'] = $upload_image['img_url'];
            }
        }

        if(empty($id)){
        	$data['cdate'] = time();
        } 
        $this->banner->set_value($data);
        if(!empty($id)){
        	$this->banner->update();
        	$this->session->set_flashdata('success','Banner has been successfully updated.');
        } else {
			$this->banner->add();
			redirect($this->_root_path.'banner/');
			$this->session->set_flashdata('success','Banner has been successfully added.');
			
        }
        redirect($this->_root_path.'banner/');
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_banner','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/banner-form',$this->_data_load);
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function delete(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_banner','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Banner has been successfully deleted.');
				redirect($this->_root_path.'banner/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}
}