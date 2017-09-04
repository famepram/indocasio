<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Config';

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
		$this->_page_path = $this->_root_path.'category/';
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
		$this->_data_load['page_caption'] 	= 'List Config';

		$this->load->model('mod_category');
		$list 	= $this->mod_category->get_all();
		$this->_data_load['list'] = $list;
		$this->load->view('admin/category-list',$this->_data_load);
	}

	public function site(){
		$this->_data_load['page_caption'] 	= 'Site Configuration';
		$this->load->view('admin/config-site',$this->_data_load);
	}

	public function contact(){
		$this->_data_load['page_caption'] 	= 'Contact Configuration';
		$this->load->view('admin/config-contact',$this->_data_load);
	}

	public function socmed(){
		$this->_data_load['page_caption'] 	= 'Social Media Configuration';
		$this->load->view('admin/config-socmed',$this->_data_load);
	}

	public function account(){
		$this->_data_load['page_caption'] 	= 'Account Atm Configuration';
		$this->load->view('admin/config-account',$this->_data_load);
	}



	public function updater(){
		$redir = $this->input->get('redirect');
        $posts = $this->input->post();
        foreach($posts as $k => $post){
        	$this->mod_meta->set($k, $post);
        }

        if(!empty($_FILES['favicon'])) {
        	$curr_favicon = get_meta('favicon');
			$upload_image = $this->mod_meta->upload_image('favicon','favicon');
			//die(print_r($upload_image));
            if($upload_image['img_url']!==false) {
                if($curr_favicon!='') {
                    $this->mod_meta->delete_file('favicon');
                }

                $this->mod_meta->set('favicon', $upload_image['img_url']);
            }
        }

        if(!empty($_FILES['logo'])) {
        	$curr_logo = get_meta('logo');
			$upload_image = $this->mod_meta->upload_image('logo','logo');
			//die(print_r($upload_image));
            if($upload_image['img_url']!==false) {
                if($curr_logo!='') {
                    $this->mod_meta->delete_file('logo');
                }

                $this->mod_meta->set('logo', $upload_image['img_url']);
            }
        }

        if(!empty($_FILES['logo_white'])) {
        	$curr_logo = get_meta('logo_white');
			$upload_image = $this->mod_meta->upload_image('logo_white','logo_white');
			//die(print_r($upload_image));
            if($upload_image['img_url']!==false) {
                if($curr_logo!='') {
                    $this->mod_meta->delete_file('logo_white');
                }

                $this->mod_meta->set('logo_white', $upload_image['img_url']);
            }
        }

        if(!empty($_FILES['home_np_img'])) {
        	$curr_logo = get_meta('home_np_img');
			$upload_image = $this->mod_meta->upload_image('home_np_img','home_np_img');
			//die(print_r($upload_image));
            if($upload_image['img_url']!==false) {
                if($curr_logo!='') {
                    $this->mod_meta->delete_file('home_np_img');
                }

                $this->mod_meta->set('home_np_img', $upload_image['img_url']);
            }
        }

        if(!empty($_FILES['home_pf_img'])) {
        	$curr_logo = get_meta('home_pf_img');
			$upload_image = $this->mod_meta->upload_image('home_pf_img','home_pf_img');
			//die(print_r($upload_image));
            if($upload_image['img_url']!==false) {
                if($curr_logo!='') {
                    $this->mod_meta->delete_file('home_pf_img');
                }

                $this->mod_meta->set('home_pf_img', $upload_image['img_url']);
            }
        }

        if(!empty($_FILES['logo_kaskus'])) {
        	$curr_logo_kaskus = get_meta('logo_kaskus');
			$upload_logo_kaskus = $this->mod_meta->upload_image('logo_kaskus','logo_kaskus');
			//die(print_r($upload_image));
            if($upload_logo_kaskus['img_url']!==false) {
                if($curr_logo_kaskus!='') {
                    $this->mod_meta->delete_file('logo_kaskus');
                }

                $this->mod_meta->set('logo_kaskus', $upload_logo_kaskus['img_url']);
            }
        }

        if(!empty($_FILES['logo_bukalapak'])) {
        	$curr_logo_bukalapak = get_meta('logo_bukalapak');
			$upload_logo_bukalapak = $this->mod_meta->upload_image('logo_bukalapak','logo_bukalapak');
			//die(print_r($upload_image));
            if($upload_logo_bukalapak['img_url']!==false) {
                if($curr_logo_bukalapak!='') {
                    $this->mod_meta->delete_file('logo_bukalapak');
                }

                $this->mod_meta->set('logo_bukalapak', $upload_logo_bukalapak['img_url']);
            }
        }

        if(!empty($_FILES['logo_tokopedia'])) {
        	$curr_logo_tokopedia = get_meta('logo_tokopedia');
			$upload_logo_tokopedia = $this->mod_meta->upload_image('logo_tokopedia','logo_tokopedia');
			//die(print_r($upload_image));
            if($upload_logo_tokopedia['img_url']!==false) {
                if($curr_logo_tokopedia!='') {
                    $this->mod_meta->delete_file('logo_tokopedia');
                }

                $this->mod_meta->set('logo_tokopedia', $upload_logo_tokopedia['img_url']);
            }
        }

        $this->session->set_flashdata('success','Configuration has been successfully updated.');
        redirect($this->_root_path.'config/'.$redir);
	}
}