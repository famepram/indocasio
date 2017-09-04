<?php
class Mod_address_book extends CI_Model {
    
    var $table = 'address_book';
    
    var $data;
    
    public function __construct($id='' , $customer_id='') {
        parent::__construct();
        if(!empty($id) || !empty($customer_id)){
            if(!empty($id)) {
                $data = $this->get_by_id($id);
            } else {
                $data = $this->get_by_customer_id($customer_id);
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
    
    public function get_by_customer_id($customer_id=''){
        $return = array();
        if(!empty($customer_id)) {
            $query = $this->db->get_where($this->table, array('customer_id' => $customer_id,'is_default'=>1));
            $row = $query->row_array();
            $return = $row;
        }
        return $return;
    }
    
        
    public function get_all($published_only=false, $limit=0,$offset=0){
        $array_temp = array();
        $this->db->order_by('cdate','desc');
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
            return true;
        }
        else
        {
            return false;
        }
    }
}