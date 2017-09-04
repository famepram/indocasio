<?php
class Mod_meta extends CI_Model {
    
    var $table = 'config';
    
    var $data_batch = array();
    
    var $dir_img = './uploads/site/';
    
    var $dir_img_thumb = './uploads/site/thumb/';
    
    var $data;
    
    public function __construct(){
        parent::__construct();
        $this->get_data();
        
    }
    
    public function get_data(){
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        if(!empty($result))
        {
            foreach ($result as $value) {
                $this->data[$value['key']] = $value['value'];
                $this->data_batch[$value['key']] = $value;
            }
        }        
    }
    
    public function set($key, $value=''){
        $data = $this->data_batch[$key];
        $data['value'] = $value;
        $data['mdate'] = time();
        $this->db->where('key', $key);
        if($this->db->update($this->table, $data))
        {
            $this->data[$key] = $value;
            $this->data_batch[$key]['value'] = $value;
        }
    }
    
    
    public function set_batch($array=array()){
        $data = array();
        if(!empty($array))
        {
            foreach($array as $key => $value)
            {
                if(array_key_exists($key, $this->data_batch))
                {
                    $data_temp = $this->data_batch[$key];
                    $data_temp['value'] = $value;
                    $data_temp['mdate'] = time();
                    $data[] = $data_temp;
                }
            }
            //die(print_r($data));
            $this->db->update_batch($this->table, $data, 'id'); 
        }
        
    }
    
    public function set_file_batch($array=array()){
        $data = array();
        if(!empty($array))
        {
            foreach($array as $key => $value)
            {
                if($value['size'] > 0)
                {
                    if(array_key_exists($key, $this->data_batch))
                    {
                        if(isset($_FILES[$key]) && count($_FILES[$key])>0)
                        {
                            $upload = $this->upload_image($key);
                            if($upload['img_url']!==false)
                            {
                                $data_temp = $this->data_batch[$key];
                                $data_temp['value'] = $upload['img_url'];
                                $data_temp['mdate'] = time();
                                $this->delete_file($key);
                                $data[] = $data_temp;
                            }
                            else
                            {
                                //die(print_r($upload));
                            }
                        }

                    }
                }
                if(!empty($data))
                {
                    $this->db->update_batch($this->table, $data, 'id'); 
                }
            }
            
        }        
    }
    
    
    public function upload_image($field_name='',$to_name=''){
        $return = array('img_url'=>false,'error'=>'No File Uploded');
        $status = true;
        if(!empty($field_name)){
            
        /*---------------------------------------------------
         * Load Library and Setup Config
         *---------------------------------------------------*/
            $config                     = array();
            $this->load->helper('url');
            $suffix                     = strtotime(date('Y-m-d H:i:s'));
            $name                       = $suffix;
            if(!empty($to_name)){
                $name = url_title($to_name, '-').'_'.$suffix;
            }
            $config['file_name']        = $name;
            $config['allowed_types']    = 'jpg|jpeg|gif|png';
            $config['upload_path']      = $this->dir_img;
            
            $this->load->library('upload');
            $this->upload->initialize($config);
        /*---------------------------------------------------
         * Run Upload and validatin image size
         *---------------------------------------------------*/
            if(!$this->upload->do_upload($field_name)) {
                $return = array('img_url'=>false,'error'=>$this->upload->display_errors());
            } else {
                $data_img   = $this->upload->data();
                $file_name  = $data_img['file_name'];
                $img_width  = $data_img['image_width'];
                $img_height = $data_img['image_height'];
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
                    $cfg_rsz_med['width']           = $img_width / 2;
                    $cfg_rsz_med['height']          = $img_height / 2;
                    $this->image_lib->initialize($cfg_rsz_med);
                    $return['error'] = false;
                    if (!$this->image_lib->resize()) {
                        $return['error'] = 'Image Medium : '.$this->image_lib->display_errors();
                    }
                    $return['img_url'] = $file_name;
                } else {
                    @unlink($this->dir_image.$file_name);
                }
            }
        }
        /*---------------------------------------------------
         * Finished
         *---------------------------------------------------*/
        return $return;
    }
    
    public function delete_file($key){
        if(!empty($key)){
            $path = $this->dir_img.$this->get($key);
            //die($path.'-------------------------------dasdasda------------------');
            if(file_exists($path)){
                @unlink($path);
            }
            
            $path_thumb = $this->dir_img_thumb.$this->get($key);
            if(file_exists($path_thumb)){
                @unlink($path_thumb);
            }
            
        }
    }    
    
    public function get($key){
        $return = '';
        if(array_key_exists($key, $this->data))
        {
            $return = $this->data[$key];
        }
        return $return;
    }
    
    
    
}