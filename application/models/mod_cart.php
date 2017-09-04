<?php
class Mod_cart extends CI_Model {

	var $arr_items = array();

	var $items;

	var $total_price;

    public function __construct() {
        parent::__construct();
        $this->arr_items = $this->session->userdata('cart');
        $this->_init();
    }

    private function _init(){
    	$this->items = array();
    	$this->load->model('mod_product');
        $this->total_price = 0;
        $this->total_weight = 0;
        $this->total_price_format = 'IDR 0';
    	if(!empty($this->arr_items)){

    		foreach ($this->arr_items as $key => $value) {
    			$prod   = new Mod_product($key);
    			$prod->qty 		 = $value;
    			$prod->price_format 	 	= 'IDR '.number_format($prod->get_final_price());
    			$prod->price_line 	 		=  $prod->get_final_price() * $value;
    			$prod->price_line_format	= 'IDR '.number_format($prod->price_line);
                $prod->img_src              =  $prod->get_img_src();
                $prod->cat_str              =  $prod->get_cat_str();
    			$this->items[$key] 	 = $prod;
    			$this->total_price +=$prod->price_line ;
                $this->total_weight +=($prod->weight * $value);
                $this->total_price_format   = 'IDR '.number_format($this->total_price);
    		}

            if($this->total_weight > 1){
                $this->total_weight = floor($this->total_weight);
            } else {
                $this->total_weight = 1;
            }    		
    	}
    }

    public function add($pd_id,$qty){	
    	if(!isset($this->arr_items[$pd_id])){
    		$this->arr_items[$pd_id] = $qty;
    	} else {
    		//die($this->items[$pd_id]);
    		$qty = ($this->arr_items[$pd_id])+$qty;
    		$this->arr_items[$pd_id] = $qty;
    	}
    	$this->session->set_userdata('cart',$this->arr_items);
    	$this->_init();
    }

    public function update($pd_id,$qty){
        if(isset($this->arr_items[$pd_id])){
    		$this->arr_items[$pd_id] = $qty;
            $this->session->set_userdata('cart',$this->arr_items);
    		$this->_init();
    	} 
    	
    }

    public function remove($pd_id){	
        if(isset($this->arr_items[$pd_id])){

    		unset($this->arr_items[$pd_id]);
    		$this->session->set_userdata('cart',$this->arr_items);
    		$this->_init();
    	}
    	$this->session->set_userdata('cart',$this->arr_items);
    }

    public function get_total_qty(){
        if(!empty($this->arr_items)){
            return array_sum($this->arr_items);
        }
        return 0;
        
    }

    public function clear(){
        $this->arr_items = array();
        $this->session->set_userdata('cart',$this->arr_items);
        $this->_init();
    }

    public function is_ready(){
        $return = true;
        //die(var_dump($this->items));
        if(!empty($this->arr_items)){
            foreach ($this->items as $value) {

                if($value->status == 2){
                    $return = false;
                }
            }
        } else {
            $return = false;
        }
        return $return;
    }
}