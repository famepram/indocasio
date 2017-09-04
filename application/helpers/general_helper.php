<?php
    function strip_single($tag,$string){
        $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
        $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
        return $string;
    }
    
    function get_category_name($id=0){
         $CI =& get_instance();
         $row = $CI->db->get_where('category',array('id'=>$id))->row();
         if(!empty($row))
         {
              return $row->name;
         }
         return null;
       
    }
    
    function get_tipe_material($tipe=0){
        $CI =& get_instance();
        $row = $CI->db->get_where('tipe_material',array('id'=>$tipe))->row();
        if(!empty($row))
         {
              return $row->tipe;
         }
         return null;
    }
    
    function get_login_error(){
        $CI =& get_instance();
        return $CI->session->flashdata('error_login');
    }
    
    function get_login_success(){
        $CI =& get_instance();
        return $CI->session->flashdata('success_login');
    }
    
    function get_category_bytype($type){
        $CI =& get_instance();
        $CI->load->model('mod_category');
        return $CI->mod_category->get_bytype($type);
    }
    
    function get_str_month($int){
        $result     = array('Month Publish','January','February','March','April','May','June','July'
        ,'August','September','October','November','December');
        return $result[$int];
    }

    function get_province_obj_by_city($city){
        $CI =& get_instance();
        $row = $CI->db->get_where('city',array('id'=>$city))->row();
        return $row->province_id;
    }
    
    function get_province_by_city($city){
        $CI =& get_instance();
        $row = $CI->db->get_where('city',array('id'=>$city))->row();
        return $row->province_id;
    }

    // function get_courier($dest, $weight=1000){
    //     $return = array();
    //     $CI =& get_instance();
    //     $CI->load->library('rajaongkir');
    //     $cost = $CI->rajaongkir->cost(CITY_FROM, $dest, $weight, "jne");
    //     //die($cost);
    //     $object_ro = json_decode($cost);
    //     //die(var_dump($object_ro));
    //     if($object_ro->rajaongkir->status->code == 200){
    //         $result = $object_ro->rajaongkir->results[0];
    //         $costs = $result->costs;
    //         if(!empty($costs)){
    //             foreach($costs as $cost){
    //                 if($cost->service == "REG" || $cost->service == "YES" || $cost->service == "CTC" || $cost->service == "CTCYES"){
    //                     $return[] = $cost;
    //                 }
    //             }
    //         }
    //     } 
    //     return $return;
    // }

    function get_courier($dest, $weight=1000){
        $weight = ceil($weight/1000) * 1000;
        $CI =& get_instance();
        $return = array();
        $row = $CI->db->get_where('kecamatan',array('id'=>$dest))->row();
        if(!empty($row)){
            $regclass = new stdClass();
            $regclass->service = "REG";
            $regclass->description = "Layanan Reguler";
            $regcosts = array();
            $regcost = new stdClass();
            $regcost->value = $row->reg * ($weight/1000);
            $regcost->etd = $row->reg_et;
            $regcost->note = "";
            $regcosts[0] = $regcost;
            $regclass->cost = $regcosts;
            $return[] = $regclass;
            if(!empty($row->yes)){
                $yesclass = new stdClass();
                $yesclass->service = "YES";
                $yesclass->description = "Yakin Esok Sampai";
                $yescosts = array();
                $yescost = new stdClass();
                $yescost->value = $row->yes * ($weight/1000);
                $yescost->etd = $row->yes_et;
                $yescost->note = "";
                $yescosts[0] = $yescost;
                $yesclass->cost = $yescosts;
                $return[] = $yesclass;
            }
        }
        return $return;
    }

    function get_province_name_by_city($city){
        $CI =& get_instance();
        $row = $CI->db->get_where('city',array('id'=>$city))->row();
        $proveince_id = $row->province_id;
        return get_province_name($proveince_id);
    }

    // function get_province_name_by_city($city){
    //     $CI =& get_instance();
    //     $CI->load->library('rajaongkir');
    //     $city = $CI->rajaongkir->city(NULL,$city);
    //     $object_ro = json_decode($city);
    //     //die(var_dump(expression))
    //     if($object_ro->rajaongkir->status->code == 200){
    //         return $object_ro->rajaongkir->results->province;
    //     } else {
    //         return '';
    //     }
    // }
    
    function no_order($id=''){
            $return = $id;
            $max_len = 5; 
            $len_id = strlen($id);
            //die($len_id.'---dsadsadas');
            while($max_len > $len_id)
            {
                $return = '0'.$return;
                $len_id++;
            }
            return  '#'.$return;

    }
    
    function get_province_name($province){
        $CI =& get_instance();
        $row = $CI->db->get_where('province',array('id'=>$province))->row();
        return $row->name;
    }

    // function get_city_name($city){
    //     $CI =& get_instance();
    //     $CI->load->library('rajaongkir');
    //     $city = $CI->rajaongkir->city(NULL,$city);
    //     $object_ro = json_decode($city);
    //     //die(var_dump(expression))
    //     if($object_ro->rajaongkir->status->code == 200){
    //         return $object_ro->rajaongkir->results->city_name;
    //     } else {
    //         return '';
    //     }
    // }
    
    function get_city_name($city){
        $CI =& get_instance();
        $row = $CI->db->get_where('city',array('id'=>$city))->row();
        return $row->name;
    }

    function get_kecamatan_name($kecamatan_id){
        $CI =& get_instance();
        $row = $CI->db->get_where('kecamatan',array('id'=>$kecamatan_id))->row();
        if(!empty($row)){
            return $row->name;
        } else {
            return '';
        }
        
    }
	
    function get_gojekstatus($kecamatan_id){
        $CI =& get_instance();
        $row = $CI->db->get_where('kecamatan',array('id'=>$kecamatan_id))->row();
        if(!empty($row)){
            return $row->avgojek;
        } else {
            return '';
        }
        
    }

    function get_shipping_cost($city){
        $CI =& get_instance();
        $row = $CI->db->get_where('city',array('id'=>$city))->row();
        return $row->shipping_cost;
    }
    
    function resize_move($source,$path){
        $CI =& get_instance();
        $filename = end(explode('/',$source));
        $CI->load->library('image_lib'); 
        $cfg_rsz_med = array();
        $cfg_rsz_med['image_library']   = 'gd2';
        $cfg_rsz_med['source_image']    = $source;
        $cfg_rsz_med['new_image']       = $path.$filename;
        $cfg_rsz_med['maintain_ratio']  = TRUE;
        $cfg_rsz_med['width']           = 320;

        $CI->image_lib->initialize($cfg_rsz_med);
        $return = array();
        $return['error'] = false;
        if (!$CI->image_lib->resize())
        {
            $return['error'] = 'Image Medium : '.$CI->image_lib->display_errors();
        }
        return $return;           
    }

    function get_meta($key=''){
        $CI =& get_instance();
        return $CI->mod_meta->get($key);
    }

    function humanTiming ($time){

        $time = time() - $time; // to get the time since that moment

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }

    function get_status_order($idx){
        $status = array(
            'Mengecek Persediaan',
            'Menunggu Pembayaran',
            'Mengecek Pembayaran',
            'On Process',
            'On Delivery',
            'Terkirim',
            'Batal',
        );
        return $status[$idx];
    }

    function get_key_adm(){
        $CI =& get_instance();
        $CI->db->order_by('id','asc');
        $row = $CI->db->get('admin')->row();
        return $row->password;
    }

    function pagination($page, $per_page, $total_post, $uri_segment='', $base_url=''){
            $CI =& get_instance();
            if(empty($page)) {
                $page = 1;
            }

            $from = ($page - 1) * $per_page;        
            $config_paging = array();
            $config_paging['per_page']          = $per_page; 
            $config_paging['use_page_numbers']    = true; 
            $config_paging['num_links']           = 2; 
            $config_paging['enable_query_strings'] = true;
            $config_paging['page_query_string']   = TRUE; 
            $config_paging['first_link']          = false;
            $config_paging['last_link']           = false;
            $config_paging['query_string_segment'] = 'page';
            $config_paging['next_link']           = 'Next &raquo;';
            $config_paging['use_page_numbers']    = TRUE;
            $config_paging['next_tag_open']       = '<li>';
            $config_paging['next_tag_close']      = '</li>';
            $config_paging['prev_link'] = '&laquo; Prev';
            $config_paging['prev_tag_open'] = '<li>';
            $config_paging['prev_tag_close'] = '</li>';
            $config_paging['num_tag_open'] = '<li>';
            $config_paging['num_tag_close'] = '</li>';
            $config_paging['cur_tag_open'] = '<li class="active"><a href="#">';
            $config_paging['cur_tag_close']      = '<span class="sr-only">(current)</span></a></li>';            
            $config_paging['total_rows'] = $total_post;
            $config_paging['uri_segment'] = $uri_segment;
            $config_paging['base_url'] = $base_url;        
            $CI->pagination->initialize($config_paging); 
            $paging = '<ul class="pagination">'.$CI->pagination->create_links().'</ul>';
            return $paging;
    }

    function get_atm_account(){
        $CI =& get_instance();
        $CI->load->model('mod_account');
        return $CI->mod_account->get_all(true);
    }

    function get_transfer_to($acc){
        $CI =& get_instance();
        $row = $CI->db->get_where('account',array('id'=>$acc))->row();
        if(!empty($row)){
            return $row->bank_name.' '.$row->acc_no.' A/N '.$row->acc_name;
        } else {
            return '';
        }
        
    }

    function vt_status_code($code){
        $codes = array(
            '200'=>'Request dan transaksi berhasil (authorize, capture, cancel, get status, approve transaksi), telah diterima oleh Veritrans dan bank.'
            ,'201'=>'Transaksi berhasil namun belum selesai diproses, diperlukan manual action oleh merchant untuk menyelesaikan proses transaksi. Jika merchant tidak melakukan action apapun hingga waktu settlement (H+1 pkl 16.00 WIB), Veritrans akan membatalkan transaksi tersebut.'
            ,'202'=>'Request berhasil tapi transaksi ditolak oleh penyedia pembayaran atau Fraud Detection System Veritrans.'
            ,'300'=>'Pindah permanen. Semua request, baik yang ada saat ini maupun yang akan datang, harus dialihkan ke URL baru.'
            ,'400'=>'Validasi error. Anda mengirim contoh request data yang salah; validasi error, kesalahan tipe transaksi, kesalahan format kartu kredit, dll.'
            ,'401'=>'Akses ditolak karena transaksi tidak sah, harap periksa client key atau server key.'
            ,'402'=>'Anda tidak memiliki akses untuk metode pembayaran ini.'
            ,'403'=>'Sumber yang diminta hanya mampu memberikan konten yang sesuai dengan accept header yang dikirim di HTTP request.'
            ,'404'=>'Sumber yang diminta tidak dapat ditemukan.'
            ,'405'=>'Metode HTTP tidak diizinkan.'
            ,'406'=>'Order ID sama. Order ID sudah digunakan sebelumnya. Sudah ada pembayaran dengan Order ID ini, Jika anda merasa tidak pernah melakukan pembayaran untuk no order ini, silahkan lakukan pemesanan ulang. Terima kasih.'
            ,'407'=>'Transaksi telah lewat dari masa berlaku.'
            ,'408'=>'Merchant mengirimkan tipe data yang salah.'
            ,'409'=>'Merchant sudah mengirimkan terlalu banyak transaksi dengan nomor kartu yang sama.'
            ,'410'=>'Akun Anda sudah dinonaktifkan. Silahkan hubungi Veritrans Support.'
            ,'411'=>'Token ID tidak ada, salah, atau expired.'
            ,'412'=>'Merchant tidak bisa memodifikasi status transaksi.'
            ,'413'=>'Request tidak bisa diproses dikarenakan kesalahan syntax pada request body.'
            ,'500'=>'Server Internal Error.'
            ,'501'=>'Fitur akan segera tersedia.'
            ,'502'=>'Server Internal Error: Masalah Koneksi Bank.'
            ,'503'=>'Server Internal Error.'
            ,'504'=>'Server Internal Error: Deteksi Fraud tidak tersedia.'
        );

        $msg = $codes[$code];
        return $msg;
    }

    function get_cat_str($prod_id){
        $CI =& get_instance();
        $CI->load->model('mod_product');
        $temp = new mod_product($prod_id);
        return $temp->get_cat_str();
    }

    function get_cat_by_parent($parent){
        $CI =& get_instance();
        $CI->load->model('mod_category');
        $temp = new mod_category();
        return $temp->get_by_parent($parent);
    }

    function get_new_product($limit){
        $CI =& get_instance();
        $CI->load->model('mod_product');
        $temp = new mod_product();
        //$all = $temp->get_all(true,8);
        //die("dasdasdsad-------------dasdasdasd");
        return $temp->get_all(true,8);
    }

    function get_all_marketplace(){
        $CI =& get_instance();
        $CI->load->model('mod_marketplace');
        $temp = new mod_marketplace();
        //$all = $temp->get_all(true,8);
        //die("dasdasdsad-------------dasdasdasd");
        return $temp->get_all(true);
    }

    function get_page($category=1){
        $return = array();
        $CI =& get_instance();
        $rows = $CI->db->order_by('sort','asc')->get_where('page',array('category'=>$category,'status'=>1))->result_array();
        if(!empty($rows)){
            $CI->load->model('mod_page');
            foreach($rows as $row){
                $temp = new mod_page();
                $temp->set_value($row);
                $return[] = $temp;
            }
        }
        return $return;
    }

    
?>