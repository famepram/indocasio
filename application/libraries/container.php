<?php
class Container{
    
    var $query;
    
    var $data;
    
    var $CI = null;
    
    public function __construct() {
        $this->CI =& get_instance(); 
    }
    
    //public function get_total_publish($exh)
    
    public function get_list_object($name='', $offset=false, $limit='0',$sort='',$sort_type='asc'){
        $this->data = null;
        if(!empty($name))
        {
            
            if($offset!==false)
            {
                $this->CI->db->limit($limit,$offset);
            }
            
            if(!empty($sort))
            {
                $this->CI->db->order_by($sort,$sort_type);
            }
            else
            {
                $this->CI->db->order_by('cdate','DESC');
            }
            
            $this->query = $this->CI->db->get($name);
            $Result = $this->query->result_array();

            $x = 0;
            foreach($Result as $Row)
            {
                $x++;
                $mod_name = 'mod_'.$name;
                $name_ref = 'lib_'.$mod_name.$Row['id'];
                $this->CI->load->model($mod_name,$name_ref,true);
                $this->CI->$name_ref->set_value($Row);
                $this->data[] = $this->CI->$name_ref;
                $this->CI->$name_ref = null;
            }
        }
        return $this->data;
    }
    
    public function get_children_cat($parent_id=0){
        $result = $this->CI->db->get_where('category',array('parent'=>$parent_id))->result_array();
        $x = 0;
        foreach($result as $row)
        {
            $x++;
            $mod_name = 'mod_category';
            $name_ref = 'lib_'.$mod_name.$row['id'];
            $this->CI->load->model($mod_name,$name_ref,true);
            $this->CI->$name_ref->set_value($row);
            $this->data[] = $this->CI->$name_ref;
            $this->CI->$name_ref = null;
        }
        return $this->data;


    }
        
    public function get_list_order($offset=false, $limit='0',$status='all'){
            $this->data = null;
            $this->CI->db->order_by('cdate','DESC');
            if($offset!==false)
            {
                $this->CI->db->limit($limit,$offset);
            }
            
            if($status!='all')
            {
                $this->CI->db->where(array('status'=>$status));
            }
            
            $this->query = $this->CI->db->get('order');
            $Result = $this->query->result_array();

            $x = 0;
            foreach($Result as $Row)
            {
                $x++;
                $mod_name = 'mod_order';
                $name_ref = 'lib_'.$mod_name.$Row['id'];
                $this->CI->load->model($mod_name,$name_ref,true);
                $this->CI->$name_ref->set_value($Row);
                $this->data[] = $this->CI->$name_ref;
                $this->CI->$name_ref = null;
            }

        return $this->data;
    }
               
    public function get_list($name='', $offset=false, $limit='0'){
        $this->data = null;
        if(!empty($name))
        {
            $this->CI->db->order_by('cdate','DESC');
            if($offset!==false)
            {
                $this->CI->db->limit($limit,$offset);
            }
            $this->query = $this->CI->db->get($name);
            $Result = $this->query->result_array();

            $x = 0;
            foreach($Result as $Row)
            {
                $x++;
                $mod_name = 'mod_'.$name;
                $name_ref = 'lib_cat'.$x;
                $this->CI->load->model($mod_name,$name_ref,true);
                $this->CI->$name_ref->set_value($Row);
                $this->data[] = $this->CI->$name_ref;
                $this->CI->$name_ref = null;
            }
        }
        return $this->data;
    } 
        
    public function search_product($key='',$offset=false, $limit='0',$sortby='name',$sorttype='asc'){
        $this->data = null;
        $ArrKey = explode(' ',$key);
        $this->CI->db->join('category', 'category.id = product.category', 'left');
        $this->CI->db->like('LOWER(category.name)',strtolower($key));
        $this->CI->db->or_like('LOWER(product.name)',strtolower($key));
        $this->CI->db->or_like('LOWER(product.desc)',strtolower($key));
        $this->CI->db->or_like('LOWER(product.meta)',strtolower($key));       
        if(count($ArrKey)>1)
        {
            foreach($ArrKey as $Val)
            {
                $this->CI->db->or_like('LOWER(category.name)',strtolower($Val));
                $this->CI->db->or_like('LOWER(product.name)',strtolower($Val));
                $this->CI->db->or_like('LOWER(product.desc)',strtolower($Val));
                $this->CI->db->or_like('LOWER(product.meta)',strtolower($Val));               
            }
        }
        
        $this->CI->db->select('product.*');
        if($offset!==false)
        {
            $this->CI->db->limit($limit,$offset);
        }
        $this->CI->db->order_by($sortby,$sorttype);
        $Query = $this->CI->db->get('product');
        
        $Result = $Query->result_array();
        $x=0;
        foreach($Result as $Row)
        {
            $x++;
            $name = 'product_search_'.$Row['id'];
            $this->CI->load->model('mod_product',$name,true);
            $this->CI->$name->set_value($Row);
            $this->data[] = $this->CI->$name;
        }
        return $this->data;
    }
    
    public function search_product_by($artist='',$type='',$offset=false, $limit='0',$sortby='name',$sorttype='asc'){
        //die($type.'----------'.$sorttype);
        if(!empty($type))
        {
            $ids = get_children_cat($type);
            $ids[] = $type;
            $this->CI->db->where_in('product.category',$ids);
        }
        $this->data = null;
        if(!empty($artist))
        {
            
            $this->CI->db->like('LOWER(product.meta)',strtolower($artist));   
        }
        
        
        
        $this->CI->db->select('product.*');
        if($offset!==false)
        {
            $this->CI->db->limit($limit,$offset);
        }
        $this->CI->db->order_by($sortby,$sorttype);
        $Query = $this->CI->db->get('product');
        $Result = $Query->result_array();
        $x=0;
        foreach($Result as $Row)
        {
            $x++;
            $name = 'product_search_'.$Row['id'];
            $this->CI->load->model('mod_product',$name,true);
            $this->CI->$name->set_value($Row);
            $this->data[] = $this->CI->$name;
        }
        return $this->data;
    }
    
    
    
    
    public function search_product_num($key=''){
        $ArrKey = explode(' ',$key);
        $this->CI->db->join('category', 'category.id = product.category', 'left');
        $this->CI->db->like('LOWER(category.name)',strtolower($key));
        $this->CI->db->or_like('LOWER(product.name)',strtolower($key));
        $this->CI->db->or_like('LOWER(product.desc)',strtolower($key));
        $this->CI->db->or_like('LOWER(product.meta)',strtolower($key));       
        if(count($ArrKey)>1)
        {
            foreach($ArrKey as $Val)
            {
                $this->CI->db->or_like('LOWER(category.name)',strtolower($Val));
                $this->CI->db->or_like('LOWER(product.name)',strtolower($Val));
                $this->CI->db->or_like('LOWER(product.desc)',strtolower($Val));
                $this->CI->db->or_like('LOWER(product.meta)',strtolower($Val));               
            }
        }
        
        $this->CI->db->select('product.*');
        $this->CI->db->from('product');
        return $this->CI->db->count_all_results();
    }
    
    public function search_product_by_num($artist='',$type=''){
        if(!empty($type))
        {
            $ids = get_children_cat($type);
            $ids[] = $type;
            $this->CI->db->where_in('product.category',$ids);
        }
        if(!empty($artist))
        {
            $this->CI->db->like('LOWER(product.meta)',strtolower($artist));   
        }
        
        
        $this->CI->db->select('product.*');
        $this->CI->db->from('product');
        return $this->CI->db->count_all_results();
    }
    
    
}
?>
