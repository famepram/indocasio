<?php
class Mod_order extends CI_Model {
    
    var $table = 'order';
    
    var $data;
    
    public function __construct($id='') {
        parent::__construct();
        if(!empty($id)){
            $data = $this->get_by_id($id);
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
    
        
    public function get_all($limit=0,$offset=0){
        $array_temp = array();
        $this->db->order_by('cdate','desc');

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
            $this->clear_detail();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_no_order(){
        return no_order($this->id);
    }

    public function clear_detail(){
        $this->db->delete('order_detail', array('order_id' => $this->id)); 
        $this->db->delete('payment', array('order_id' => $this->id)); 
    }

    public function get_detail(){
        $array_temp = array();
        $this->db->order_by('cdate','desc');
        $this->load->model('mod_order_detail');
        $this->load->model('mod_product');
        $query = $this->db->get_where($this->mod_order_detail->table,array('order_id'=>$this->id));
        $result = $query->result_array();
        if(!empty($result)){
            foreach($result as $item){
                $row = new Mod_order_detail();
                $prod = new Mod_product($item['product_id']); 
                $row->set_value($item);
                $row->thumb = $prod->get_img_src(true);
                $row->image = $prod->get_img_src();
                $row->link  = $prod->get_link();
                $row->category  = $prod->get_category_name();
                $row->p  = $prod->p;
                $row->l  = $prod->l;
                $row->t  = $prod->t;
                $row->weight  = $prod->weight;
                $array_temp[] =  $row;
            }
        }
        return $array_temp;
    }

    public function get_payment(){
        $this->load->model('mod_payment');
        $row = $this->db->get_where($this->mod_payment->table,array('order_id'=>$this->id))->row();
        if(!empty($row)){
            $payment = new Mod_payment();
            $payment->set_value($row);
            return $payment;
        } else {
            return false;
        }
    }

    public function has_tesimoni(){
        $row = $this->db->get_where('testimoni',array('reff'=>$this->id))->row();
        if(!empty($row)){
            return true;
        } else {
            return false;
        }
    }

    public function get_new_order_num(){
        $this->db->where('is_viewed', '0');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_morris_chart_data(){
        $return = array();
        $sql = "SELECT DATE_FORMAT( FROM_UNIXTIME(  `cdate` ) ,  '%c%Y' ) AS sort, DATE_FORMAT( FROM_UNIXTIME(  `cdate` ) ,  '%M %Y' ) AS my, SUM(  `total_price` ) AS total
                FROM `order`
                GROUP BY DATE_FORMAT( FROM_UNIXTIME(  `cdate` ) ,  '%M %Y' ) 
                ORDER BY DATE_FORMAT( FROM_UNIXTIME(  `cdate` ) ,  '%c%Y' ) 
                LIMIT 0 , 12";
        $rows = $this->db->query($sql)->result();
        if(!empty($rows)){                
            foreach ($rows as $value){
                $object = new stdClass();
                $y = 'y';
                $x = 'item1';
                
                $object->$x = $value->total;
                $object->$y = $value->my;
                $return[] = $object;
                
            }
        }
        return $return;
    } 
}