<?php
class Mod_gallery extends CI_Model {
    
    var $table = 'gallery';
    
    var $dir_img = './uploads/gallery/';
    
    var $dir_img_thumb = './uploads/gallery/thumb/';
    
    var $data;
    
    public function __construct($id='' , $slug='') {
        parent::__construct();
        if(!empty($id) || !empty($slug)){
            if(!empty($id)) {
                $data = $this->get_by_id($id);
            } else {
                $data = $this->get_by_slug($slug);
            }
            $this->set_value($data);
        }
    }
    
    public function get_by_id($id=''){
        $return = array();
        if(!empty($id)) {
            $query = $this->db->get_where($this->table, array('id' => $id));
            $row = $query->row_array();
            $return = $row;
        }
        return $return;
    } 
    
    public function get_by_slug($slug=''){
        $return = array();
        if(!empty($slug)) {
            $query = $this->db->get_where($this->table, array('slug' => $slug));
            $row = $query->row_array();
            $return = $row;
        }
        return $return;
    }

    public function get_by_parent_slug($parent='',$slug=''){

            $query  = $this->db->get_where($this->table, array('parent' => $parent, 'slug'=>$slug));
            $row    = $query->row_array();
            $temp   = new self();
            $temp->set_value($row);
            return $temp;
    }
    
        
    public function get_all($published_only=false, $limit=0,$offset=0){
        $array_temp = array();
        $this->db->order_by('sort','asc');
        if($published_only){
            $this->db->where(array('available'=>1));
        }

        if($limit > 0){
            $this->db->limit($limit,$offset);
        }
        
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        if(!empty($result))
        {
            foreach($result as $item)
            {

                $temp = new self();
                $temp->set_value($item);
                $array_temp[] =  $temp;
            }
        }
        return $array_temp;
    }
    
    public function set_value($array){
        if(!empty($array))
        {
            foreach($array as $key => $val)
            {
                $this->$key = $val;
            }
            $this->data = $array;
        }
    }
    
    public function add(){
        $this->db->insert($this->table, $this->data); 
        if($this->db->affected_rows()>0)
        {
            $id = $this->db->insert_id();
            $this->id = $id;
            $this->data['id'] = $id;
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function update(){
        $this->db->where('id', $this->id);
        $this->db->update($this->table, $this->data); 
        if($this->db->affected_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    
    public function delete(){
        $this->db->delete($this->table, array('id' => $this->id)); 
        if($this->db->affected_rows()>0)
        {
            $this->delete_image();
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function upload_image($field_name='',$name=''){
        $return = array('img_url'=>false,'error'=>'No File Uploded');
        if(!empty($field_name))
        {
        /*---------------------------------------------------
         * Load Library and Setup Config
         *---------------------------------------------------*/
            $config                     = array();
            $this->load->helper('url');
            $upload_path                = $this->dir_img;
            $config['file_name']        = $name.'_'.time();
            $config['allowed_types']    = 'jpg|jpeg|gif|png';
            $config['upload_path']      = $upload_path;
            
            $this->load->library('upload');
            $this->upload->initialize($config);
        /*---------------------------------------------------
         * Run Upload and validatin image size
         *---------------------------------------------------*/
            if(!$this->upload->do_upload($field_name))
            {
                $return = array('img_url'=>false,'error'=>$this->upload->display_errors());
            }
            else
            {
                $data_img   = $this->upload->data();
                $file_name  = $data_img['file_name'];
                $img_width  = $data_img['image_width'];
                $img_height = $data_img['image_height'];
                $status = true;
                if(!empty($max_width) or !empty($max_height)){
                    if(!empty($max_width) && $img_width != $max_width){
                        $status = false;
                        $return['error'] = 'Resolution image must be '.$max_width.' x '.$max_height;
                    } elseif(!empty($max_height) && $img_height != $max_height) {
                        $status = false;
                        $return['error'] = 'Resolution image must be '.$max_width.' x '.$max_height;
                    }
                }
                if($status) {
        /*---------------------------------------------------
         * if image size correct, copy file image ke
         *---------------------------------------------------*/
                    $file_name = $data_img['file_name'];
                    $this->load->library('image_lib'); 
                    $cfg_rsz_med = array();
                    $cfg_rsz_med['image_library']   = 'gd2';
                    $cfg_rsz_med['source_image']    = $data_img['full_path'];
                    $cfg_rsz_med['new_image']       = $this->dir_img_thumb.$file_name;
                    $cfg_rsz_med['maintain_ratio']  = TRUE;
                    $cfg_rsz_med['width']           = ceil($img_width /2);
                    $cfg_rsz_med['height']          = ceil($img_height/2);
                    
                    $this->image_lib->initialize($cfg_rsz_med);
                    $return['error'] = false;
                    if (!$this->image_lib->resize())
                    {
                        $return['error'] = 'Image Medium : '.$this->image_lib->display_errors();
                    }
                    
                    $return['img_url'] = $file_name;
                } else {
                    @unlink($this->dir_img.$file_name);
                }
            }
        }
        /*---------------------------------------------------
         * Finished
         *---------------------------------------------------*/
        return $return;
    }
    
    public function delete_image(){
        if(!empty($this->image))
        {
            $path = $this->dir_img.$this->image;
            if(file_exists($path))
            {
                @unlink($path);
            }
            $path_thumb = $this->dir_img_thumb .$this->image;
            if(file_exists($path_thumb))
            {
                @unlink($path_thumb);
            }
        }
    }
    
    public function get_img_src($thumb=false){
        $img ='no-img.jpg';
        $path = base_url().'uploads/gallery/';
        if($thumb)
        {
            $path.='thumb/';
        }
        
        if(!empty($this->image))
        {
            $img = $this->image;
        }
        return $path.$img;
        
    }





}