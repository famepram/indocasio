<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Page';

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
		$this->_page_path = $this->_root_path.'page/';
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
		$this->_data_load['page_caption'] 	= 'List Page';

		$this->load->model('mod_page');
		$list 	= $this->mod_page->get_all();
		$this->_data_load['list'] = $list;
		$this->load->view('admin/page-list',$this->_data_load);
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Page';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/page-form',$this->_data_load);
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_page','page',true,$id);
		$data 		= $this->page->data;
		$title 		= $this->input->post('title');
		$category 	= $this->input->post('category');
		$sort 		= $this->input->post('sort');
		$content 	= $this->input->post('content');
		$status		= $this->input->post('status');
		$slug 		= url_title($title,'-',true);
		$data['title'] 		=  $title;
		$data['slug'] 		=  $slug;
		$data['content'] 	=  $content;
		$data['status'] 	=  $status;
		$data['category'] 	=  $category;
		$data['sort'] 		=  $sort;
		$data['mdate'] = time();
		if(empty($id)){
        	$data['cdate'] = time();
        } 
        $this->page->set_value($data);
        if(!empty($id)){
        	$this->page->update();
        	$this->session->set_flashdata('success','Page has been successfully updated.');
        } else {
			$this->page->add();
			redirect($this->_root_path.'page/');
			$this->session->set_flashdata('success','Page has been successfully added.');
			
        }
        redirect($this->_root_path.'page/');
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_page','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/page-form',$this->_data_load);
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
			$this->load->model('mod_page','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Page has been successfully deleted.');
				redirect($this->_root_path.'page/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function upload_img(){
		$config						= array();
		$upload_path                = './uploads/page/content/';
		$name 						= 'article_content_'.time();
        $config['file_name']        = $name;
        $config['allowed_types']    = 'jpg|jpeg|gif|png';
        $config['upload_path']      = $upload_path;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('text_image')){
           //$return = array('img_url'=>false,'error'=>$this->upload->display_errors());
        	$return = false;
        } else {
        	$data_img   = $this->upload->data();
            $file_name  = $data_img['file_name'];
            $url 		= base_url().'uploads/page/content/'.$file_name;
            //$return = array('img_url'=>$url,'error'=>'');
            $return = $url;
        }
        echo $return;
	}
}