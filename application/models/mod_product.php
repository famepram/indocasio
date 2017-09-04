<?php
class Mod_product extends CI_Model {
    
    var $table = 'product';
    
    var $dir_img = './uploads/product/';
    
    var $dir_img_thumb = './uploads/product/thumb/';
    
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
    
        
    public function get_all($published_only=false, $limit=0,$offset=0){
        $array_temp = array();
        $this->db->order_by('category asc, sort asc');
        // $this->db->order_by('sort','asc');
        if($published_only){
            $this->db->where(array('publish'=>1));
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
        if(!empty($array)){
            foreach($array as $key => $val){
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
            //$this->clear_child();
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function upload_image($field_name='',$max_width='',$max_height=''){
        $return = array('img_url'=>false,'error'=>'No File Uploded');
        if(!empty($field_name))
        {
        /*---------------------------------------------------
         * Load Library and Setup Config
         *---------------------------------------------------*/
            $config                     = array();
            $this->load->helper('url');
            $suffix                     = strtotime(date('Y-m-d H:i:s'));
            $name                       = $suffix;
            $upload_path                = $this->dir_img;
            $config['file_name']        = $name;
            $config['allowed_types']    = '*';
            //$config['allowed_types']    = 'jpg|jpeg|gif|png';
            $config['upload_path']      = $upload_path;
            
            if(!empty($max_width))
            {
                $config['max_width']    = $max_width;
            }
            
            if(!empty($max_height))
            {
                $config['max_height']   = $max_height;
            }
            
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
                    $cfg_rsz_med['width']           = $img_width /2;
                    $cfg_rsz_med['height']          = $img_height/2;
                    
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
        if(!empty($this->cover))
        {
            $path = $this->dir_img.$this->cover;
            if(file_exists($path))
            {
                @unlink($path);
            }
            $path_thumb = $this->dir_img_thumb .$this->cover;
            if(file_exists($path_thumb))
            {
                @unlink($path_thumb);
            }
        }
    }
    
    public function get_img_src($thumb=false){
        $img ='no-img.jpg';
        $path = base_url().'uploads/product/';
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
    
    
    public function get_link(){
        return base_url().$this->slug.'.html';
    }

    public function get_category_name(){
        $row = $this->db->get_where('category',array('id'=>$this->category))->row();
        if(!empty($row)){
            return $row->name;
        } else {
            return '';
        }
    }

    public function get_category(){
        $row = $this->db->get_where('category',array('id'=>$this->category))->row();
        if(!empty($row)){
            return $row->name;
        } else {
            return '';
        }
    }
    
    public function search($key=''){
        $return = array();
        $arr_key = explode(' ',$key);
        $this->db->join('category', 'category.id = product.category', 'left');
        // $this->db->like('LOWER(category.name)',strtolower($key));
        // $this->db->or_like('LOWER(product.code)',strtolower($key));  
        // $this->db->or_like('LOWER(product.descr)',strtolower($key)); 
        // if(count($arr_key)>1){
        //     foreach($arr_key as $val){
        //         $this->db->or_like('LOWER(category.name)',strtolower($val));
        //         $this->db->or_like('LOWER(product.code)',strtolower($val));  
        //         $this->db->or_like('LOWER(product.descr)',strtolower($val)); 
        //     }
        // }
        
        $arr_like = array();
        if(!empty($key)){
            $key = strtolower(trim($key));
            $arr_like[] = "LOWER(category.name) like '%$key%'";
            $arr_like[] = "LOWER(product.code) like '%$key%'";
            $arr_like[] = "LOWER(product.descr) like '%$key%'";

            $exp_keys = explode(' ',$key);
            if(count($exp_keys) > 1){
                foreach($exp_keys as $exp_key){
                    $exp_key    = strtolower(trim($exp_key));
                    $arr_like[] = "LOWER(category.name)  like '%$exp_key%'";
                    $arr_like[] = "LOWER(product.code) like '%$exp_key%'";
                    $arr_like[] = "LOWER(product.descr) like '%$exp_key%'";
                }
            }

            $likes = implode(' || ',$arr_like);
            $likes = "( $likes )";
            $this->db->where($likes);
        }
        $this->db->where('publish',1);


        $this->db->select('product.*');
        $result = $this->db->get('product')->result_array();
        //die($this->db->last_query());
        if(!empty($result)){
            foreach($result as $item){
                $temp = new self();
                $temp->set_value($item);
                $return[] = $temp;

            }
        }
        return $return;
    }

    public function get_final_price(){
        if(!empty($this->disc_value)){
            if($this->disc_type == 1){
                $price = $this->price - ($this->disc_value * $this->price /100);
                return $price;
            } else {
                return $this->price - $this->disc_value;
            }
        } else {
            return $this->price;
        }
    }   

    public function get_key_related(){
        $raw = explode('-', $this->code);
        if(isset($raw[2])){
            unset($raw[2]);
        }
        //$str = implode('-', $raw);
        return $raw;
    }

    public function get_related($limit=0,$offset=0){
        $array_temp = array();
        $keys = $this->get_key_related();
        
        //$this->db->like('LOWER(code)',strtolower($this->code));
        if(!empty($keys)){
            foreach ($keys as $key) {
                $this->db->or_like('LOWER(code)',strtolower($key));
            }
        }
        
        $this->db->where(array('id !='=>$this->id,'publish'=>1));
        $this->db->order_by('cdate','desc');
        
        if($limit > 0){
            $this->db->limit($limit,$offset);
        }
        $query = $this->db->get($this->table);
        //die($this->db->last_query());
        $result = $query->result_array();
        //die(print_r($result));
        //$result = $this->db->get_where('product')->result_array();
        if(!empty($result)){
            foreach($result as $item){
                $temp = new self();
                $temp->set_value($item);
                $array_temp[] =  $temp;
            }
        }
        return $array_temp;
    }

    public function get_gallery(){
        //die()
        $array_temp = array();
        //$this->db->get_where('gallery',array('product_id'=>$this->id));
        $this->load->model('mod_gallery');
        $query = $this->db->get_where('gallery',array('product_id'=>$this->id));
        $result = $query->result_array();
        if(!empty($result)){
            
            foreach($result as $item){
                $temp = new mod_gallery();
                $temp->set_value($item);
                $array_temp[] =  $temp;
            }
        }
        return $array_temp;
    }

    public function get_cat_str(){
        $this->load->model('mod_category');
        $_cat = new Mod_category($this->category);
        $parent = $_cat->get_parent_name();
        if(!empty($parent)){
            return $parent.' &mdash; '.$_cat->name;
        } else {
            return $_cat->name;
        }
    }  

    public function get_total(){
        return $this->db->count_all_results($this->table);
    }

    public function get_top_products($limit = 5){
        $return = array();
        $sql = "SELECT b.*, SUM(  `qty` ) AS total
                FROM order_detail a
                LEFT JOIN product b
                ON a.product_id = b.id
                GROUP BY a.product_id
                ORDER BY SUM(  `qty` ) DESC 
                LIMIT $limit";
        $rows = $this->db->query($sql)->result_array();
        if(!empty($rows)){
            foreach ($rows as $row) {
                $temp = new self();
                $temp->set_value($row);
                $return[] =  $temp;
            }
        }
        return $return;
    }




}