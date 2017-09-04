<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Video';

	private $_admin_id;

	private $_menu_index = 2;

	private $_submenu_index = 0;

	private $_data_load = array();

// -------------------------- Default Property -------------------------------------//	

	public function __construct(){
		parent::__construct();
		$this->_init();
	}

	private function _init_admin(){
		$this->load->model('mod_admin','adm',true,$this->_admin_id);
		$this->_data_load['adm'] 		= $this->adm;
	}

	private function _init(){
		$this->_root_path = base_url().DIR_ADMIN;
		$this->_page_path = $this->_root_path.'login/';
		$this->_admin_id = $this->session->userdata('admin_id');
		if(empty($this->_admin_id)){
			redirect($this->_root_path.'login/');
		}

		$this->_data_load['root_path'] 		= $this->_root_path;
		$this->_data_load['page_path'] 		= $this->_page_path;
		$this->_data_load['page_name'] 		= $this->_page_name;
		$this->_data_load['menu_index'] 	= $this->_menu_index;
		$this->_data_load['submenu_index'] 	= $this->_submenu_index;
		$this->_data_load['success'] 		= $this->session->flashdata('success');
		$this->_data_load['error'] 		= $this->session->flashdata('error');

		$this->_init_admin();
	}

	public function index(){
		$this->load->model('mod_video');
		$list 	= $this->mod_video->get_all();
		$this->_data_load['list'] = $list;
		$this->load->view('admin/video-list',$this->_data_load);
	}

	public function add(){
		$this->_data_load['object'] = false;
		$this->load->view('admin/video-form',$this->_data_load);
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_video','coll',true,$id);
		$data 		= $this->coll->data;
		$title 		= $this->input->post('title');
		$slug 		= url_title($title,'_',true);
		$link 		= $this->input->post('link');
		$content 	= $this->input->post('content');
		$status 	= $this->input->post('status');
		$data['title'] 		=  $title;
		$data['slug'] 		=  $slug;
		$data['link'] 		=  $link;
		$data['content'] 	=  $content;
		$data['status'] 	=  $status;
		$data['mdate'] = time();
		if(!empty($_FILES['image'])) {
			$upload_image = $this->coll->upload_image('image');
            if($upload_image['img_url']!==false) {
                if($this->coll->image!='') {
                    $this->coll->delete_image();
                }
                $data['image'] = $upload_image['img_url'];
            }
        }

        if(empty($id)){
        	$data['cdate'] = time();
        } 
        $this->coll->set_value($data);
        if(!empty($id)){
        	$this->coll->update();
        	$this->session->set_flashdata('success','Video has been successfully updated.');
        	
        } else {
			$this->coll->add();
			$this->session->set_flashdata('success','Video has been successfully added.');
			
        }
        redirect($this->_root_path.'video/');
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_video','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/video-form',$this->_data_load);
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
			$this->load->model('mod_video','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Video has been successfully deleted.');
				redirect($this->_root_path.'video/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function upload_img(){
		$config						= array();
		$upload_path                = './uploads/video/content/';
		$name 						= 'video_content_'.time();
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
            $url 		= base_url().'uploads/video/content/'.$file_name;
            //$return = array('img_url'=>$url,'error'=>'');
            $return = $url;
        }
        echo $return;
	}

	public function gbatch_updater(){
		$this->load->model('mod_gallery');
		$data 	= $this->mod_gallery->data;
		$sort 		= $this->input->post('sort');
		$video_id = $this->input->post('video_id');
		$this->load->model('mod_video','video',true,$video_id);
		$data['video_id'] 	=  $video_id;
		$data['sort'] 			=  ($sort+1);
		$data['mdate'] = time();
		//die(print_r($_FILES));
		if(!empty($_FILES['file'])) {

			$upload_image = $this->mod_gallery->upload_image('file');
            if($upload_image['img_url']!==false) {
                if($this->mod_gallery->image!='') {
                    $this->mod_gallery->delete_image();
                }
                $data['image'] = $upload_image['img_url'];
            }
        }
        $this->mod_gallery->set_value($data);
        $this->mod_gallery->add();
        $response = array();
        $response['id'] = $this->mod_gallery->id;
        $response['url'] = $this->mod_gallery->get_img_src();
        $response['url_thumb'] = $this->mod_gallery->get_img_src(true);
        $response['url_delete'] = $this->_root_path.'video/delete_gallery/'.$this->mod_gallery->id;
        echo json_encode($response);

	}

	public function sort_gallery(){

		$str = $this->input->post('str');
		$my_array =  explode(',',$str) ;
		$sql = "SELECT * FROM gallery  WHERE id IN ($str)";
		$sql .= "\nORDER BY CASE id\n";
		foreach($my_array as $k => $v){
		    $sql .= 'WHEN ' . $v . ' THEN ' . $k . "\n";
		}
		$sql .= 'END ';
		//die($sql);
		$result = $this->db->query($sql)->result_array();
		if(!empty($result)){
			$this->load->model('mod_gallery');
			foreach($result as $k => $item){
				$temp = new Mod_gallery();
				$item['sort'] = $k;
				$temp->set_value($item);
				$temp->update();
			}
		}
	}

	public function delete_gallery(){
		$response = array('status'=>false,'msg'=>'');
		$id = end($this->uri->segment_array());
		$response['id'] = $id;
		if(is_numeric($id)){
			$this->load->model('mod_gallery','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$response['status'] = true;
			} else {
				$response['msg'] = 'Gallery not found';
			}
		} else {
			$response['msg'] = 'Gallery not found';
		}

		echo json_encode($response);
	}


}