<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {
    
    protected $_data_load;

    public  $_customer_id;

    protected $_auth = false; 
    
    protected $_cart = false; 

    public $_preorder = array();

    public function __construct() {
        parent::__construct();

        if(get_meta('is_offline') == 1){
            redirect(base_url().'maintenance/');
        }
        
        $this->_data_load['page_title'] = "Checkout";
        $this->sess_ab = $this->session->userdata('sess_ab');
        $this->_init_user();
        $this->_init_preorder();

    
    }

    protected function _init_user(){
        $this->_customer_id = $this->session->userdata('customer_id');
        if(!empty($this->_customer_id)){
            $this->load->model('mod_customer','_customer',true,$this->_customer_id);
        }        
    }

    protected function _init_preorder(){
        $this->_preorder = $this->session->userdata('preorder');
        
    }

    public function account(){
        if(!empty($this->_customer_id)){
            redirect(base_url().'checkout/delivery/');
        }
        $this->load->view('checkout-account',$this->_data_load);
    }

    public function account_post(){
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $this->_preorder['fname'] = $fname;
        $this->_preorder['lname'] = $lname;
        $this->_preorder['email'] = $email;
        $this->_preorder['phone'] = $phone;
        $this->session->set_userdata('preorder',$this->_preorder);
        redirect(base_url().'checkout/delivery/');

    }

    public function delivery(){

        //get_option_province();
        // $this->load->library('rajaongkir');
        // $provinces = $this->rajaongkir->province();
        //die($provinces);
        $this->load->view('checkout-delivery',$this->_data_load);
    }

    public function delivery_post(){
        $ab_id = $this->input->post('ab_id');
        if($ab_id == 'new'){
            $this->form_validation->set_rules('address', 'Street Address', 'required');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('checkout-delivery',$this->_data_load);
            } else {
                $this->load->model('mod_address_book');
                $data = array();
                $data['city_id']    = $this->input->post('city');
                $data['kecamatan_id']    = $this->input->post('kecamatan_id');
                $data['address']    = $this->input->post('address');
                $data['postal_code'] = $this->input->post('postal_code');
                
                if(!empty($this->_customer_id)){
                    $abs = $this->_customer->get_address_book();
                    if(empty($abs)){
                        $data['is_default'] = 1;
                    }
                    $data['customer_id'] = $this->_customer_id;
                    $data['cdate'] = time();
                    $data['mdate'] = time();
                    $this->mod_address_book->set_value($data);
                    $this->mod_address_book->add();
                    $this->_preorder['ab_id'] = $this->mod_address_book->id;
                } else {
                    //die("dsadasdasdasdsad");
                    $this->_preorder = array_merge($this->_preorder,$data); 
                }
                $this->session->set_userdata('preorder',$this->_preorder);
                
            }

        } else {
            $this->_preorder['ab_id'] = $ab_id;
            $this->session->set_userdata('preorder',$this->_preorder);
        }
        //die(print_r($this->_preorder));
        redirect(base_url().'checkout/confirmation');
    }

    public function confirmation(){
        //if(isset())

        //$this->costs = get_courier($city_id,($this->mod_cart->total_weight * 10));
        //die(print_r($this->_preorder));
        //$costs = get_courier(456,1000);
        //die(json_encode($costs));
        $weight = ceil($this->mod_cart->get_total_qty() / 5) * 1000;
        if(empty($this->mod_cart->arr_items)){
            $this->session->set_flashdata('error','No item in your cart');
            redirect(base_url());
        }
        if(isset($this->_preorder['ab_id']) && !empty($this->_preorder['ab_id'])){
            $this->load->model('mod_address_book','_ab',true,$this->_preorder['ab_id']);
            $this->costs = get_courier($this->_ab->kecamatan_id,$weight);
            //die(json_encode($this->costs));
        } else {

            $this->_data_load['preorder'] = $this->_preorder;
            //die(print_r($this->_data_load['preorder']));

            $this->costs = get_courier($this->_preorder['kecamatan_id'],$weight);
        }
		// var_dump($this->costs);
        //die(print_r($this->costs));
        $this->load->view('checkout-confirmation',$this->_data_load);
    }

    public function confirmation_post(){
        $data_order = array();
        $payment = $this->input->post('payment');
        $courier = $this->input->post('courier');
        $latlong = $this->input->post('latlong');
        $assurance = $this->input->post('assurance');
        $courier_arr = explode('|',$courier);
        $courier_paket = $courier_arr[0];
        $delivery_cost = $courier_arr[1];
        
        if(!empty($this->_customer_id)){
            $data_order['customer_id'] = $this->_customer_id;
            $data_order['fname']       = $this->_customer->fname;
            $data_order['lname']       = $this->_customer->lname;
            $data_order['email']       = $this->_customer->email;
            $data_order['phone']       = $this->_customer->phone;

            $this->load->model('mod_address_book','_ab',true,$this->_preorder['ab_id']);

            $data_order['address']     = $this->_ab->address;
            $city_id                   = $this->_ab->city_id;
            $kecamatan_id              = $this->_ab->kecamatan_id;
            $data_order['city_id']     = $city_id;
            $data_order['kecamatan_id'] = $kecamatan_id;
            $data_order['postal_code'] = $this->_ab->postal_code;
            
        } else {
            $data_order['customer_id'] = 0;
            $data_order['fname']       = $this->_preorder['fname'];
            $data_order['lname']       = $this->_preorder['lname'];
            $data_order['email']       = $this->_preorder['email'];
            $data_order['phone']       = $this->_preorder['phone'];
            $data_order['address']     = $this->_preorder['address'];
            $city_id                   = $this->_preorder['city_id'];
            $kecamatan_id              = $this->_preorder['kecamatan_id'];
            $data_order['city_id']     = $city_id;
            $data_order['kecamatan_id'] = $kecamatan_id;
            $data_order['postal_code'] = $this->_preorder['postal_code'];
        }

            $status                             = $this->mod_cart->is_ready()?1:0; 
            //die($status.'-------------dsadsadsa');
            $data_order['status']               = $status;
            $data_order['total_price']          = $this->mod_cart->total_price; 
            $data_order['total_weight']         = $this->mod_cart->total_weight;
            $scpkg                              = get_shipping_cost($city_id);
            $assurance_cost                     = $assurance == 1? floor(($this->mod_cart->total_price/500000)) * 1000 + 8000:0;
            $data_order['assurance']            = $assurance_cost;
            $ext_cc_cost                        = 0;
            
            
            
            $data_order['delivery_cost']        = $delivery_cost;
            $total_cost                         = $data_order['total_price'] + $delivery_cost + $assurance_cost;
            if($payment == 2){
                $ext_cc_cost                    = round(((3.2 * $total_cost /100) + 2500),0);
                $total_cost                     = $total_cost + $ext_cc_cost;
            }
            $data_order['ext_cc']               = $ext_cc_cost ;
            $data_order['total_cost']           = $total_cost;
            //die($data_order['total_cost'].'= '.$data_order['total_price'].' + '.$delivery_cost.' + '.$assurance_cost.' + '.$ext_cc_cost);
            $data_order['payment_method']       = $payment;
            $data_order['courier']              = $courier_paket;
            $data_order['latlong']              = $latlong;
            $data_order['cdate']                = time();
            $data_order['mdate']                = time();
            $this->load->model('mod_order');
            $this->mod_order->set_value($data_order);
            if($this->mod_order->add()){
                $items = $this->mod_cart->items;
                //$status = 1;
                $this->load->model('mod_order_detail');
                foreach($items as $item){
                    $data                       = array();
                    $data['order_id']           = $this->mod_order->id;
                    $data['product_id']         = $item->id;
                    $data['product_code']       = $item->code;
                    $data['qty']                = $item->qty;
                    $data['weight']             = $item->weight;
                    $data['basic_price']        = $item->price;
                    $fprice                     = $item->get_final_price();
                    $data['final_price']        = $fprice;
                    $data['discount']           = $this->mod_order->id;
                    $data['cdate']              = time();
                    $data['mdate']              = time();
                    $od = new Mod_order_detail();
                    $od->set_value($data);
                    $od->add();
                }

            }
            // kalo bayar pake cc dan status order ready maka pending sending email 
            if($payment == 2 && $status == 1){
                $this->session->set_userdata('order_hold',$this->mod_order->id);
                $this->_veritrans_payment($this->mod_order->id);
            } else {
                $this->mod_email->send_email_order($this->mod_order->id);
                $this->session->unset_userdata('cart');
                redirect(base_url().'checkout/finish/?order_id='.$this->mod_order->id);
            }                

            
    }


    private function _veritrans_payment($_order_id=0, $backtocheckout=true){
        //$sever_key = "VT-server-LMfOSursyw-pCXcpmIxDEel2"; // sanbox 
        //$end_point = "https://api.sandbox.veritrans.co.id/v2/charge"; // sandbox 
        $sever_key = "VT-server-2llWspB83L_7cEvQ9ZWFEj6t"; // production 
        $end_point = "https://api.veritrans.co.id/v2/charge"; // production
        $total = 0;
        $this->load->model('mod_order','_order',true,$_order_id);
        $vt_data = array();
        $vt_data['payment_type'] = "vtweb";
        $vt_data['vtweb'] = array(
                            //'enabled_payments'  => array('credit_card').
                            'credit_card_3d_secure' => true
                        );

        $vt_data['transaction_details'] = array(
                                'order_id'=>$this->_order->get_no_order()
                                ,"gross_amount"=>$this->_order->total_cost
                            );

        //die(json_encode($vt_data));

        $vt_items = array();
        $items = $this->_order->get_detail();
        $tot = 0;
        if(!empty($items)){
            foreach($items as $item){
                $temp = array();
                $temp['id'] = $item->id;
                $temp['price'] = $item->final_price;
                $temp['quantity'] = $item->qty;
                $temp['name'] = $item->product_code;
                $vt_items[] = $temp;
                $total =  $item->final_price * $item->qty;
                $tot += $total; 
            }

            $temp = array();
            $temp['id'] = 'delivery_cost';
            $temp['price'] = $this->_order->delivery_cost;
            $temp['quantity'] = 1;
            $full_address = $this->_order->address.' '.get_city_name($this->_order->city_id).' '.get_province_name_by_city($this->_order->city_id);
            $temp['name'] = $this->_order->courier;
            $vt_items[] = $temp;
            $tot += $this->_order->delivery_cost; 

            if(!empty($this->_order->assurance)){
                $temp = array();
                $temp['id'] = 'assurance';
                $temp['price'] = $this->_order->assurance;
                $temp['quantity'] = 1;
                $temp['name'] = 'Delivery Assurance';
                $vt_items[] = $temp;
                $tot += $this->_order->assurance;
            }

            $temp = array();
            $temp['id'] = 'ext_cc';
            $temp['price'] = $this->_order->ext_cc;
            $temp['quantity'] = 1;
            $temp['name'] = 'Credit Card Charge';
            $vt_items[] = $temp;
            $tot += $this->_order->ext_cc;
            //die($this->_order->total_cost.'------------'.$tot);

        }

        $vt_data['item_details'] = $vt_items;
        $cust_address = array(
            "first_name"    => $this->_order->fname,
            "last_name"     => $this->_order->lname,
            "address"       => $this->_order->address,
            "city"          => get_city_name($this->_order->city_id),
            "postal_code"   => $this->_order->postal_code,
            "phone"         => $this->_order->phone,
            "country_code"  => "IDN"
        );

        $cust_data = array(
            "first_name"    => $this->_order->fname,
            "last_name"     => $this->_order->lname,
            "email"         => $this->_order->email,
            "phone"         => $this->_order->phone,
            "billing_address" => $cust_address,
            "shipping_address" => $cust_address
        );

        $vt_data['customer_details'] = $cust_data;
        $vt_data_json = json_encode($vt_data);
        //die(json_encode($vt_data));
        $request = curl_init($end_point);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($request, CURLOPT_POSTFIELDS, $vt_data_json);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        $auth = sprintf('Authorization: Basic %s', base64_encode($sever_key.':'));
        curl_setopt($request, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
                'Accept: application/json',
                $auth 
            )
        );

        // Excute request and parse the response
        $response = json_decode(curl_exec($request));
        //die(json_encode($response));
        // Check Response
        if($response->status_code == "201"){
            
            redirect($response->redirect_url);
        } else {
            //error
            // echo "Terjadi kesalahan pada data transaksi yang dikirim.<br />";
            // echo "Status message: [".$response->status_code."] ".$response->status_message;
            // echo "<h3>Response:</h3>";
            //echo json_encode($response);
            // $data_load['code'] = $response->status_code;
            // $this->load->view('cc-payment-error',$data_load);
            //$this->_order->delete();
            //die();
            //$this->load->model('mod_order');
            $hold_order_id = $this->session->userdata('order_hold');
            if(!empty($hold_order_id)){
                $hold_order = new Mod_order($hold_order_id);
                $hold_order->delete();
                $this->session->unset_userdata('order_hold');
                $data_load['backorder'] = true;
            } else {
                $data_load['backorder'] = false;
            }
            $code = $this->input->get('status_code');
            $data_load['code']      = $response->status_code;
            $data_load['oid']       = $_order_id;
            $this->load->view('cc-payment-error',$data_load);
        }
    }

    public function finish(){
        $this->session->unset_userdata('cart');
        $id_raw = $this->input->get('order_id');

        $id = intval(str_replace('#', '', $id_raw));
        $this->load->model('mod_order','_order',true,$id);
        if(!empty($this->_order->data)){
            //$this->session->unset_userdata('order_hold');
            // $this->session->unset_userdata('cart');
            // $status_code = $this->input->get('status_code');
            // if(!empty($status_code) && $status_code == 200){
            //     $data = $this->_order->data;
            //     $data['status'] = 2;
            //     $data['mdate'] = time();
            //     $this->_order->set_value($data);
            //     $this->_order->update();
            // }
            
            //$this->mod_email->send_email_order($this->_order->id);
            $this->load->view('checkout-finish',$this->_data_load);
        } else {
           redirect(base_url().'cart/'); 
        }
        
        
    }

    public function get_option_city(){
        $province = $this->input->post('province');
        $options = '<option value=0>Pilih Kota / Kabupaten</option>';
        $json_response = array('options'=>$options.get_option_city($province));
        echo json_encode($json_response);
    }

    public function get_option_kecamatan(){
        $city_id = $this->input->post('city_id');
        $options = '<option value=0>Pilih Kecamatan</option>';
        $json_response = array('options'=>$options.get_option_kecamatan($city_id));
        echo json_encode($json_response);
    }

    public function payment_conf(){
        $order_id = $this->input->get('oid');
        if(!empty($order_id)){
            $this->load->model('mod_order','_order',true,$order_id);
        }
        $this->load->view('pay-conf',$this->_data_load);
    }

    public function payconfpost(){
        $data = array();
        $order_id               = intval($this->input->post('order_id'));
        $data['order_id']       = $order_id;
        $data['acc_no']         = $this->input->post('acc_no');
        $data['acc_name']       = $this->input->post('acc_name');
        $data['transfer_to']    = $this->input->post('transfer_to');
        $data['bank_name']      = $this->input->post('bank_name');
        $date                   = $this->input->post('date_trans');
        // $time                   = $this->input->post('time_trans');
        $data['date']           = strtotime($date);
        $data['amount']         = $this->input->post('amount');
        $data['mdate']          = time();

        $this->load->model('mod_payment');
        $this->mod_payment->set_value($data);
        if($this->mod_payment->add()){
            $this->load->model('mod_order','order',true,$order_id);
            if($this->order->status == 1){
                $data_order = $this->order->data;
                $data_order['status'] = 2;
                $this->order->set_value($data_order);
                $this->order->update();
                
            }
            $this->mod_email->send_email_payment($this->mod_payment->id);
            $this->mod_email->send_email_payment($this->mod_payment->id,true);
            redirect(base_url().'checkout/payment_sent/');
        }
    }

    public function payment_sent(){

        $this->load->view('payment-sent',$this->_data_load);
        
        
    }

    public function cc_payment(){
        $id = end($this->uri->segment_array());
        if(is_numeric($id)){
            $this->load->model('mod_order','_order',true,$id);
            //die("hererer");
            //die($id.'----------------');

            if(!empty($this->_order->data)){
                //die($id.'----------------');
                $this->_veritrans_payment($this->_order->id);
            } else {
                $this->session->set_flashdata('error','Order not found');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error','Order not found');
            redirect(base_url());
        }
    }

    public function vt_error(){
        $this->load->model('mod_order');
        $hold_order_id = $this->session->userdata('order_hold');
        //die($hold_order_id.'--------------------dsadsad-----------');
        if(!empty($hold_order_id)){
            $hold_order = new Mod_order($hold_order_id);
            $hold_order->delete();
            $this->session->unset_userdata('order_hold');
            $data_load['backorder'] = true;
        } else {
            $data_load['backorder'] = false;
        }
        $code = $this->input->get('status_code');
        $data_load['code'] = $code;
        $this->load->view('cc-payment-error',$data_load);
    }

    public function vt_cancel(){
        $id_raw = $this->input->get('order_id');
        $id = intval(str_replace('#', '', $id_raw));
        $this->load->model('mod_order','_order',true,$id);
        if(!empty($this->_order->data)){
            $hold_order_id = $this->session->userdata('order_hold');
            if(!empty($hold_order_id)){
                $hold_order = new Mod_order($hold_order_id);
                $hold_order->delete();
            }
            
            $items = $this->mod_cart->items;
            if(!empty($items)){
                $this->session->set_flashdata('error','Payment cancelled');
                redirect(base_url().'checkout/confirmation/'); 
            } else {
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error','Order not found');
            redirect(base_url()); 
        }
    }

    public function vt_notify(){
        $raw_notification = json_decode(file_get_contents( "php://input"), true);
        //die(var_dump($raw_notification));
        $posts = $this->input->post();
        
        $status = $raw_notification['status_code'];
        $oid = $raw_notification['order_id'];
        $id = intval(str_replace('#', '', $oid));
        $this->load->model('mod_order','_order',true,$id);
        //die($oid.'--------------sadasdsa----------------------');
        //echo $
        if($status == '200'){
            $this->mod_cart->clear();
            $data_order = $this->_order->data;
            $data_order['status'] = 3;
            $data_order['mdate'] = time();
            $this->_order->set_value($data_order);
            $this->_order->update();
            $this->mod_email->send_email_order($this->_order->id);
           
            //die($this->_order->id."------------success");
        } else {
            $hold_order_id = $this->session->userdata('order_hold');
            if($id == $hold_order_id){
                $this->_order->delete();
            }
        }
    }

    public function view_order($id){
        //$id = end($this->uri->segment_array());
        if(is_numeric($id)){
            $this->load->model('mod_order','_order',true,$id);
            $this->load->view('order-view-single',$this->_data_load);
        } else {
            $this->session->set_flashdata('error','Order not found.');
            redirect(base_url());
        }
    }

    

}