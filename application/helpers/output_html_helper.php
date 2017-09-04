<?php
function breadcrump(){
    $CI =& get_instance();
    $breadcrump = '<ul class="breadcrumb">';
    $array_segment = $CI->uri->segment_array();
    if(!empty($array_segment))
    {
        $len_arr = count($array_segment);
        $link = base_url().'admin/';
        foreach($array_segment as $key => $val)
        {
            $name =  ucfirst(str_replace('_', ' ', $val));
            if($key == $len_arr)
            {
                $breadcrump.='<li class="active">'.$name.'</li>';
            }
            elseif($key == 1)
            {
                $breadcrump.='<li><a href="'.$link.'"><span class="awe-home"></span>'.$name.'</a></li>';
            }
            else
            {
                $link.= $val.'/';
                $breadcrump.='<li><a href="'.$link.'">'.$name.'</a></li>';
            }
            
        }
    }
    $breadcrump.='</ul>';
    return $breadcrump;        
}

function get_option($table,$selected=''){
    $return = '';
    $CI =& get_instance();
    $query     = $CI->db->get($table);
    $result    = $query->result(); 
    //die(print_r($result));
    if(!empty($result))
    {
        foreach ($result as $item) {
            if($item->id == $selected)
            {
                $return.='<option value="'.$item->id.'" selected="selected">'.$item->name.'</option>';
            }
            else
            {
                $return.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }
    }

    return $return;
}

function get_option_status_order($selected=''){
    $return = '';
    $CI =& get_instance();
    $status = array(
        'Mengecek Persediaan',
        'Menunggu Pembayaran',
        'Mengecek Pembayaran',
        'On Process',
        'On Delivery',
        'Terkirim',
        'Batal'
    );
    //die(print_r($result));
    if(!empty($status))
    {
        foreach ($status as $key => $item) {
            if($key == $selected)
            {
                $return.='<option value="'.$key.'" selected="selected">'.$item.'</option>';
            }
            else
            {
                $return.='<option value="'.$key.'">'.$item.'</option>';
            }
        }
    }

    return $return;
}

function get_option_category($selected='',$not_include='0'){
    $return = '';
    $CI =& get_instance();
    $array_where = array('parent'=>0);
    if(!empty($not_include)){
        $array_where['id !='] = $not_include;
    }
    $CI->db->where($array_where);
    $CI->db->order_by('name','asc');
    $query     = $CI->db->get('category');
    $result    = $query->result(); 
    if(!empty($result)){
        foreach ($result as $item) {
            if($item->id == $selected){
                $return.='<option value="'.$item->id.'" selected="selected">'.$item->name.'</option>';
            } else {
                $return.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
            $CI->db->order_by('name','asc');
            $children     = $CI->db->get_where('category',array('parent'=>$item->id,'id !='=>$not_include))->result();
            if(!empty($children)){
                foreach($children as $child) {
                    if($child->id == $selected) {
                        $return.='<option value="'.$child->id.'" selected="selected">'.$item->name.' &mdash; '.$child->name.'</option>';
                    } else {
                        $return.='<option value="'.$child->id.'">'.$item->name.' &mdash; '.$child->name.'</option>';
                    }
                }
            }
            
        }
    }

    return $return;
}

function get_option_province($selected=''){
    $return = '';
    $CI =& get_instance();
    $CI->load->library('rajaongkir');
    $provinces = $CI->rajaongkir->province();
    $obj_prov  = json_decode($provinces);
    $result    = $obj_prov->rajaongkir->results; 
    //die(var_dump($obj_prov->rajaongkir->results));
    if(!empty($result)){
        foreach ($result as $item) {
            if($item->province_id == $selected)
            {
                $return.='<option value="'.$item->province_id.'" selected="selected">'.$item->province.'</option>';
            }
            else
            {
                $return.='<option value="'.$item->province_id.'">'.$item->province.'</option>';
            }
        }
    }
    return $return;
}

// function get_option_city($province=1, $selected=''){
//     $return = '';
//     $CI =& get_instance();
//     $CI->load->library('rajaongkir');
//     $cities = $CI->rajaongkir->city($province);
//     //die($cities);
//     $obj_prov  = json_decode($cities);
//     $result    = $obj_prov->rajaongkir->results; 
//     //die(var_dump($obj_prov->rajaongkir->results));
//     if(!empty($result)){
//         foreach ($result as $item) {
//             $name = $item->type =="Kabupaten"?$item->type." ".$item->city_name:$item->city_name;
//             if($item->city_id == $selected)
//             {

//                 $return.='<option value="'.$item->city_id.'" selected="selected">'.$name.'</option>';
//             }
//             else
//             {
//                 $return.='<option value="'.$item->city_id.'">'.$name.'</option>';
//             }
//         }
//     }
//     return $return;
// }


function get_option_city($province=1, $selected=''){
    $return = '';
    $CI =& get_instance();
    $result     = $CI->db->get_where('city',array('province_id'=>$province))->result();
    if(!empty($result))
    {
        foreach ($result as $item) {
            if($item->id == $selected)
            {
                $return.='<option value="'.$item->id.'" selected="selected">'.$item->name.'</option>';
            }
            else
            {
                $return.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }
    }

    return $return;
}

function get_option_kecamatan($city_id=1, $selected=''){
    $return = '';
    $CI =& get_instance();
    $result     = $CI->db->get_where('kecamatan',array('city_id'=>$city_id))->result();
    if(!empty($result))
    {
        foreach ($result as $item) {
            if($item->id == $selected)
            {
                $return.='<option value="'.$item->id.'" selected="selected">'.$item->name.'</option>';
            }
            else
            {
                $return.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }
    }

    return $return;
}

function get_option_month($month=0){
    $return = '';
    $CI =& get_instance();
    $result     = array('Month Publish','January','February','March','April','May','June','July'
        ,'August','September','October','November','December');
    foreach ($result as $k => $v) {
            if($k == $month)
            {
                $return.='<option value="'.$k.'" selected="selected">'.$v.'</option>';
            }
            else
            {
                $return.='<option value="'.$k.'">'.$v.'</option>';
            }
        }


    return $return;
}

?>
