<?php
class Mod_config extends CI_Model {
    
    var $table = 'config';
    
    var $id;
    
    var $label;
    
    var $key;
    
    var $type;
    
    var $value;
    
    var $option;
    
    var $desc;
    
    var $sort;
    
    var $group;
    
    var $cdate;
    
    var $mdate;
            
    var $data;
    
    var $dir_img = './uploads/site/';
    
    var $dir_img_thumb = './uploads/site/thumb/';
    
    public function __construct($id=0,$key=''){
        parent::__construct();
        if(!empty($id) || !empty($key))
        {
            if(!empty($id))
            {
                $data = $this->get_by_id($id);
            }
            else
            {
                $data = $this->get_by_key($key);
                //die(print_r($data));
            }
            $this->set_value($data);
        }
    }
    
    public function fill_array_value(){
        
    }
    
    public function get_by_id($id=''){
        $return = array();
        if(!empty($id))
        {
            $query = $this->db->get_where($this->table, array('id' => $id));
            $row = $query->row_array();
            $return = $row;
        }
        return $return;
    } 

    public function get_by_key($key=''){
        $return = array();
        if(!empty($key))
        {
            $query = $this->db->get_where($this->table, array('key' => $key));
            $row = $query->row_array();

            $return = $row;
        }
        return $return;
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
    
    public function get_option($selected_value=false){
        $return = '';
        $array_option = explode(';',$this->option);
        if(!empty($array_option))
        {
            foreach ($array_option as $value) {
                if($selected_value==$value)
                {
                    $return.='<option value="'.$value.'" selected="selected">'.$value.'</option>';
                }
                else
                {
                    $return.='<option value="'.$value.'">'.$value.'</option>';
                }
            }
        }
        return $return;
    }

    private function _get_has_error(){
        if(form_error($this->key)!=''){
            echo 'has-error';
        }
    }

    
    public function create_element(){
        $element = '';
        //die($this->key."--------------------dasdsadsad----------------------");
        switch ($this->type)
        {
            // textbox;
            case 1:
                $element.= '<div class="form-group '.$this->_get_has_error().'">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label class="col-sm-12 control-label">'.$this->label.'</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="'.$this->key.'" value="'.$this->value.'">
                                            <span class="help-block">'.form_error($this->key).'</span>
                                        </div>                                               
                                    </div>
                                </div>   
                            </div>';
                break;
            // textarea;
            case 2:
                $element.= '<div class="form-group '.$this->_get_has_error().'">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label class="col-sm-12 control-label">'.$this->label.'</label>
                                        <div class="col-sm-12">
                                            <textarea name="'.$this->key.'" rows="5" class="form-control wysihtml5">'.$this->value.'</textarea>
                                            <span class="help-block">'.form_error($this->key).'</span>
                                        </div>                                               
                                    </div>
                                </div>   
                            </div>';
                break;
            // combobox;
            case 3:
                $element.= '<div class="col-sm-4"><select class="form-control" name="'.$this->key.'" >';
                $value   = empty($this->value)?false:$this->value;
                $element.= $this->get_option($this->value);
                $element.= '</select></div>';
                break;
            case 4:
                $checked = !empty($this->value)?'checked="checked"':'';
                $element.= '<div class="col-sm-2"><input class="thumbnail-checkbox" name="'.$this->key.'"  type="checkbox" value="1" '.$checked.'></div>';
                break;
            case 5:
                    $src_img = base_url().'assets/admin/img/sample_content/sample-image-250x150.png';
                    $class = 'fileupload-new';
                    $img_exist = '';
                    if(!empty($this->value))
                    {
                        $src_img = $this->dir_img_thumb.$this->value;
                        $class = 'fileupload-exists';
                        $img_exist = '<img style="width:100%;"; src="'.  base_url().'uploads/site/thumb/'.$this->value.'" />';
                    }
                
                    $element.='<div class="fileupload '.$class.'" data-provides="fileupload">';
                    $element.='<div class="fileupload-new fileupload-xlarge thumbnail">';
                    $element.='<img src="'.$src_img.'" width="100%">';
                    $element.='</div>';
                    $element.='<p class="help-block">'.$this->desc.'</p>';
                    $element.='<div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail">'.$img_exist.'</div>';
                    $element.='<div>';
                    $element.='<span class="btn btn-default btn-file">';
                    $element.='<span class="fileupload-new">Select image</span>';
                    
                    $element.='<span class="fileupload-exists">Change</span>';
                    $element.='<input type="file" name="'.$this->key.'">';
                    $element.='</span>';
                    $element.='&nbsp;<a class="btn btn-alt btn-danger fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>';
                    if(!empty($this->value))
                    {
                        $element.='&nbsp;<a class="btn btn-alt rem-img-config btn-danger fileupload-new" data-dismiss="fileupload" href="#" data-key="'.$this->key.'" data-rel="'.$this->value.'">Remove</a>';
                    }
                    $element.='</div></div>';

 //               }
                //$element.= '<input name="'.$this->key.'"  type="file">';
                break;
            default :
                $element.= '';            
        }
        return $element;
        
    }

    public function upload_image($field_name='',$to_name=''){
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
            if(!empty($to_name))
            {
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
                if($status)
                {
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
                    $cfg_rsz_med['width']           = $img_width/3;
                    $cfg_rsz_med['height']          = $img_height/3;
                    
                    $this->image_lib->initialize($cfg_rsz_med);
                    $return['error'] = false;
                    if (!$this->image_lib->resize())
                    {
                        $return['error'] = 'Image Medium : '.$this->image_lib->display_errors();
                    }
                    
                    $return['img_url'] = $file_name;
                }
                else
                {
                    @unlink($this->dir_image.$file_name);
                }
            }
        }
        /*---------------------------------------------------
         * Finished
         *---------------------------------------------------*/
        return $return;
    }

    public function delete_image($key=''){
        if(!empty($key)){
            $image = get_meta($key);
            if(!empty($image))
            {
                $path = $this->dir_img.$image;
                if(file_exists($path))
                {
                    @unlink($path);
                }
                $path_thumb = $this->dir_img_thumb.$image;
                if(file_exists($path_thumb))
                {
                    @unlink($path_thumb);
                }
            }
        }
    }
    
    
}