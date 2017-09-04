<?php
class Mod_article extends CI_Model {
    
    var $table = 'article';
    
    var $id;
    
    var $title;
    
    var $slug;

    var $excerpt;
    
    var $image;
    
    var $category;
    
    var $content;

    var $status;

    var $feat;

    var $pdate;
    
    var $cdate;
    
    var $mdate;
    
    var $dir_img = './uploads/article/feat/';
    
    var $dir_img_thumb = './uploads/article/feat/thumb/';
    
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
    
        
    public function get_all($published_only=false){
        $array_temp = array();
        $this->db->order_by('pdate','desc');
        if($published_only){
            $this->db->where(array('status'=>1));
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
                $reff = new ReflectionClass($this);
                if($reff->hasProperty($key))
                {
                    $this->$key = $val;
                }
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
            $config['allowed_types']    = 'jpg|jpeg|gif|png';
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
        $path = base_url().'uploads/article/feat/';
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
        return base_url().'article/'.$this->slug.'/'.$this->id;
    }

    public function get_category(){
        $array_cat = array('0'=>'category','1'=>'Exhibition');
        return $array_cat[$this->category];
    }
    
    public function search($key=''){
        //die("dasdasdsad");
        $return = array();
        $arr_key = explode(' ',$key);
        $this->db->join('author', 'author.id = article.author', 'left');
        $this->db->like('LOWER(author.name)',strtolower($key));
        $this->db->or_like('LOWER(article.title)',strtolower($key));     
        if(count($arr_key)>1)
        {
            foreach($arr_key as $Val)
            {
                $this->db->or_like('LOWER(author.name)',strtolower($Val));
                $this->db->or_like('LOWER(article.title)',strtolower($Val));
              
            }
        }
        
        $this->db->select('article.*');
        $result = $this->db->get_where('article',array('available'=>1,'stock >'=>0))->result_array();
        if(!empty($result))
        {
            foreach($result as $item)
            {
                $temp = new self();
                $temp->set_value($item);
                $return[] = $temp;

            }
        }
        return $return;
    }

    public function get_campaign(){
        $return = array();
        $result = $this->db->get_where('campaign',array('article_id'=>$this->id))->result_array();
        if(!empty($result)){
            $this->load->model('mod_campaign');
            foreach($result as $item){
                $temp = new Mod_campaign();
                $temp->set_value($item);
                $return[] = $temp;
            }
        }
        return $return;
    }

    public function get_gallery(){
        $return = array();
        $this->db->order_by('sort','asc');
        $result = $this->db->get_where('gallery',array('article_id'=>$this->id))->result_array();
        if(!empty($result)){
            $this->load->model('mod_gallery');
            foreach($result as $item){
                $temp = new Mod_gallery();
                $temp->set_value($item);
                $return[] = $temp;
            }
        }
        return $return;
    }

    public function clear_child(){
        $cmps = $this->get_campaign();
        $gals = $this->get_gallery();
        if(!empty($cmps)){
            foreach ($cmps as $key => $cmp) {
                $cmp->delete();
            }
        }

        if(!empty($gals)){
            foreach ($gals as $key => $gal) {
                $gal->delete();
            }
        }
    }

    public function get_count_gallery(){
        $this->db->from('gallery');
        $this->db->where(array('article_id'=>$this->id));
        return $this->db->count_all_results();
    }
    
}