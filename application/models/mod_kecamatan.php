<?php
class Mod_kecamatan extends CI_Model {
    
    var $table = 'kecamatan';
    
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

    public function get_by_city($city=''){
        $array_temp = array();
        $this->db->order_by('name','asc');
        if(!empty($city)){
            $this->db->where(array('city_id'=>$city));
        }

        $query = $this->db->get($this->table);
        $result = $query->result_array();
        if(!empty($result)){
            foreach($result as $item){

                $temp = new self();
                $temp->set_value($item);
                $array_temp[] =  $temp;
            }
        }
        return $array_temp;
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
        $this->db->order_by('city_id','asc');
        if($published_only){
            $this->db->where(array('status'=>1));
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
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_city_name(){
        $row = $this->db->get_where("city", array('id' => $this->city_id))->row();
        if(!empty($row)){
            return $row->name;
        } else {
            return '';
        }
    }
    


}