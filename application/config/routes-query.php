<?php 

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get('category');
$result = $query->result();
foreach( $result as $row ){
    $route[$row->slug]                 = 'category/view';
    $query_subcat = $db->get_where('category',array('parent' => $row->id));
    $result_subcat = $query_subcat->result();
    if(!empty($result_subcat)){
        foreach ($result_subcat as $row_sc) {
            $route[$row->slug.'/'.$row_sc->slug]       = 'category/view';
            $route[$row->slug.'/'.$row_sc->slug.'/(:num)'] = 'category/view';
        }
    }
}