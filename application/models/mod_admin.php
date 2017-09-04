<?php
class Mod_admin extends CI_Model {
    
    var $table = 'admin';
    
    var $data  = array();
    
    public function __construct($id='',$username='') {
        parent::__construct();
        if(!empty($id) || !empty($username)){
            if(!empty($id)){
                $data = $this->get_by_id($id);
            } else {
                $data = $this->get_by_username($username);
            }
            $this->set_value($data);
        }
    }

    public function get($key=''){
        if(empty($key)){
            return '';
        }

        $reff = new ReflectionClass($this);
        if($reff->hasProperty($key)){
            return $this->$key;
        }

        return '';
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

    public function get_by_pass($pass=''){
        $return = array();
        if(!empty($pass))
        {
            $query = $this->db->get_where($this->table, array('password' => $pass));
            $row = $query->row_array();
            $return = $row;
        }
        return $return;
    }
    
    public function get_all(){
        $array_temp = array();
        $result =  $this->db->get($this->table)->result_array();
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
    
    public function get_by_username($username=''){
        $return = array();
        if(!empty($username))
        {
            $query = $this->db->get_where($this->table, array('username' => $username));
            $row = $query->row_array();
            $return = $row;
        }
        return $return;
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
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function hash_pass($username,$password){
        $ps = sha1(SALT_ADM.$password);
        //die($ps);
        return $ps;
    }
    
    public function login($username,$password){
        $hash_pass = $this->hash_pass($username,$password);
        $query = $this->db->get_where($this->table, array('username' => $username,'password'=>$hash_pass));
        $row = $query->row();
        if(!empty($row))
        {
            return $row;
        }
        else
        {
            return false;
        }
        
    }

    
}