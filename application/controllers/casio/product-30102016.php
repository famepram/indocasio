<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Product';

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
		$this->_page_path = $this->_root_path.'product/';
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
		// $this->session->sess_destroy();
		// die();
		$this->_data_load['page_caption'] 	= 'List Product';
		$this->category = $this->input->get('category');
		if(!empty($this->category)){
			$this->load->model('mod_category','cat',true,$this->category);
			$list 	= $this->cat->get_product_adm();
		} else {
			$this->load->model('mod_product');
			$list 	= $this->mod_product->get_all();
			$list 	= array();
		}
		
		$this->_data_load['list'] = $list;
		$this->load->view('admin/product-list',$this->_data_load);
	}

	public function add(){
		$this->_data_load['page_caption'] 	= 'Add New Product';
		$this->_data_load['object'] 		= FALSE;
		$this->load->view('admin/product-form',$this->_data_load);
	}

	public function updater(){
		$id = $this->input->post('id');
		$this->load->model('mod_product','product',true,$id);
		$data 		= $this->product->data;
		$name 		= $this->input->post('name',true);
		$code 		= $this->input->post('code',true);
		$category 	= $this->input->post('category',true);
		$p 		= $this->input->post('p',true);
		$l 		= $this->input->post('l',true);
		$t 		= $this->input->post('t',true);
		$weight 	= $this->input->post('weight',true);
		$descr 		= $this->input->post('descr',true);
		$warranty 	= $this->input->post('warranty',true);
		$price 		= $this->input->post('price',true);
		$show_price = $this->input->post('show_price',true);
		$disctype 	= $this->input->post('disctype',true);
		$discval 	= $this->input->post('discval',true);
		$status 	= $this->input->post('status',true);
		$publish	= $this->input->post('publish',true);
		$sort		= $this->input->post('sort',true);
		$slug 		= url_title($code,'-',true);
		$parent 	= $this->input->post('parent');
		$data['name'] 		=  $name;
		$data['code'] 		=  $name;
		$data['sku'] 		=  $code;
		$data['slug'] 		=  $name;
		$data['category'] 	=  $category;
		$data['p'] 		=  $p;
		$data['l'] 		=  $l;
		$data['t'] 		=  $t;
		$data['show_price'] 		=  $show_price;
		$data['weight'] 	=  $weight;
		$data['descr'] 		=  $descr;
		$data['warranty'] 	=  $warranty;
		$data['price'] 		=  $price;
		$data['disc_type'] 	=  $disctype;
		$data['disc_value'] =  $discval;
		$data['status'] 	=  $status;
		$data['publish'] 	=  $publish;
		$data['sort'] 		=  $sort;
		$data['mdate'] = time();

		if(!empty($_FILES['image'])) {
			$upload_image = $this->product->upload_image('image');

			if($upload_image['img_url']!==false) {
                if(isset($this->product->image) && $this->product->image!='') {
                    $this->product->delete_image();
                }
                $data['image'] = $upload_image['img_url'];
            }
        }

        if(empty($id)){
        	$data['sort'] = 1;
        	$data['cdate'] = time();
        } else {
        	$oldsort = $this->product->sort;
        }
        $this->product->set_value($data);
        if(!empty($id)){
        	$this->product->update();
        	$this->_update_sorting($this->product->id,$this->product->category,$sort,$oldsort);
        	$this->session->set_flashdata('success','Product has been successfully updated.');
        } else {
			$this->product->add();
			$this->_update_sorting($this->product->id,$this->product->category,1,99999999999);
			$this->session->set_flashdata('success','Product has been successfully added.');
			redirect($this->_root_path.'product/');
			
		}
        redirect($this->_root_path.'product/');
	}

	private function _update_sorting($id, $category,$newsort,$oldsort){
		if($newsort > $oldsort){
			$sql = 'update '.$this->product->table.' set sort = (sort-1) where id!='.$id.' and category='.$category.' and sort <= '.$newsort.' And sort > '.$oldsort;
		} else {			
			$sql = 'update '.$this->product->table.' set sort = (sort+1) where id!='.$id.' and category='.$category.' and sort >= '.$newsort.' And sort < '.$oldsort;
		}
		$this->db->query($sql);
	}

	public function update(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_product','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->_data_load['object'] = $this->object;
				$this->load->view('admin/product-form',$this->_data_load);
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function duplicate(){
		$id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_product','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$data['id'] = '';
				$this->object->set_value($data);
				$this->object->add();
				$this->session->set_flashdata('success','Product has been successfully updated.');
				redirect($this->_root_path.'product/');
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
			$this->load->model('mod_product','object',true,$id);
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete();
				$this->session->set_flashdata('success','Product has been successfully deleted.');
				redirect($this->_root_path.'product/');
			} else {
				redirect($this->_root_path.'error_404/');
			}
		} else {
			redirect($this->_root_path.'error_404/');
		}
	}

	public function set(){
		$field 	= $this->input->get('field');
		$id 	= $this->input->get('id');
		$val 	= $this->input->get('val');
		$this->load->model('mod_product','_product',true,$id);
		$data = $this->_product->data;
		$data[$field] = $val;
		$data['mdate'] = time();
		$this->_product->set_value($data);
		//die(json_encode($this->_product));
		$this->_product->update();
		$this->session->set_flashdata('success','Product has been successfully updated.');
		redirect($this->_root_path.'product/');
	}

	public function gallery_updater(){
		$product_id = $this->input->post('product_id');
		if(!empty($_FILES['image'])) {
			$this->load->model('mod_gallery');
            $data = array();
            $data['product_id'] = $product_id;
			$upload_image = $this->mod_gallery->upload_image('image','gallery');
			if($upload_image['img_url']!==false) {
				$data['image'] = $upload_image['img_url'];
				$data['mdate'] = time();
	       	 	$this->mod_gallery->set_value($data);
	        	$this->mod_gallery->add();
	        	$this->session->set_flashdata('success','Image has been uploaded.');
            } else {
            	$this->session->set_flashdata('error','Image not valid.');
            }
		} else {
        	$this->session->set_flashdata('error','Image must not be empty.');
			
        }
        redirect($this->_root_path.'product/update/'.$product_id);
        
	}

	public function delete_gallery(){
        $id = end($this->uri->segment_array());
		if(is_numeric($id)){
			$this->load->model('mod_gallery','object',true,$id);
			$product_id = $this->object->product_id;
			$data = $this->object->data;
			if(!empty($data)){
				$this->object->delete_image();
				$this->object->delete();
				$this->session->set_flashdata('success','Product has been successfully deleted.');
				redirect($this->_root_path.'product/update/'.$product_id);
			} else {
				redirect($this->_root_path.'product/update/'.$product_id);
			}
		} else {
			redirect($this->_root_path.'product/');
		}
    }

    public function move(){
    	
    	$id = $this->input->get('id');
    	
    	$to = $this->input->get('to');
    	$dir = $this->input->get('dir');
    	$redir = $this->input->get('redir');
    	$this->load->model('mod_product','_prod',true,$id);
    	$this->load->model('mod_category','_cat',true,$this->_prod->category);
    	$curr_list = $this->_cat->get_product_adm();
    	$data_batch = array();
    	$idx = $to - 1;
    	$data = $this->_prod->data;
    	$data['sort'] = $to;
    	$data['mdate'] = time();
    	$this->_prod->set_value($data);
    	//$this->_prod->update();
    	$data_batch[$to] = $data;
    	$this->_prod->set_value($data);
    	$this->_prod->update();
    	//echo $this->_prod->code.' ============ '.$to.'<br />';

    	//die(strip_tags(json_encode($data_batch)));
    	if(!empty($curr_list)){
    		$i = 1;
    		foreach($curr_list as $item){

    			if($id != $item->id){
    				$data_item = $item->data;
    				if($i == $to){
    					$i++;
    				}
    				$data_item['sort'] = $i;
    				$item->set_value($data_item);
    				$item->update();
    				//echo $item->code.' ============ '.$i.'<br />';
    				// $data_batch[$i] = $data_item;
    				$i++;
    			}
    			
    			
    		}

    	}
    	$redir_url = urldecode($redir);
    	redirect($redir_url);


    }

    public function reindex_sort(){
    	$this->load->model('mod_product');
    	$all = $this->mod_product->get_all();
    	$x = 0;
    	foreach($all as $item){
    		$x++;
    		$data = $item->data;
    		$data['sort'] = $x;
    		$item->set_value($data);
    		$item->update();

    	}

    }
}