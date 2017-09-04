<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['profile_id']	= '72465653'; // GA profile id
$config['email']		= 'rajaampatweb@gmail.com'; // GA Account mail
$config['password']		= 'rajaampat2013'; // GA Account password

$config['cache_data']	= true; // request will be cached
$config['cache_folder']	= './ga_cache/'; // read/write
$config['clear_cache']	= array('date', '1 day ago'); // keep files 1 day
	
$config['debug']		= false; // print request url if true