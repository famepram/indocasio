<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $_root_path;

	public $_page_path;

	private $_page_name = 'Dashboard';

	private $_admin_id;

	private $_menu_index = 1;

	private $_submenu_index = 0;

	private $_data_load = array();

// -------------------------- Default Property -------------------------------------//	

	public function __construct(){
		parent::__construct();
		$this->_init();
	}

	private function _init(){
		$this->_root_path = base_url().DIR_ADMIN;
		$this->_page_path = $this->_root_path.'dashboard/';
		$this->_admin_id  = $this->session->userdata('admin_id');

		if(empty($this->_admin_id)){
			redirect($this->_root_path.'login/');
		}

		$this->_data_load['root_path'] 		= $this->_root_path;
		$this->_data_load['page_path'] 		= $this->_page_path;
		$this->_data_load['page_name'] 		= $this->_page_name.' | '.GG_APPNAME;
		
		$this->_data_load['menu_index'] 	= $this->_menu_index;
		$this->_data_load['submenu_index'] 	= $this->_submenu_index;

		$this->_data_load['error'] = $this->session->flashdata('error');
		$this->_data_load['success'] = $this->session->flashdata('success');
		$this->_init_admin();
	}

	private function _init_admin(){
		$this->load->model('mod_admin','adm',true,$this->_admin_id);
		$this->_data_load['adm'] 		= $this->adm;
	}

	private function _init_ga(){
		//die()
		require_once(BASEPATH . '../application/third_party/Google/Client.php');
		require_once(BASEPATH . '../application/third_party/Google/Service/Analytics.php');

		$client_id 					= '59955786982-caeg0mq36nfqc22t7tkd1j9e80u7g0b4.apps.googleusercontent.com'; //Client ID
		$service_account_name 		= '59955786982-caeg0mq36nfqc22t7tkd1j9e80u7g0b4@developer.gserviceaccount.com'; //Email Address 
		$key_file_location 			= BASEPATH . '../application/third_party/Google/API-Project-bdefb9f8f602.p12'; //key.p12

		$client = new Google_Client();
		$client->setApplicationName("new ga api test");
		$service = new Google_Service_Analytics($client);

		$ga_service_token = '';
		//$ga_service_token = $this->session->userdata('ga_service_token');

		if (!empty($ga_service_token)) {
		  $client->setAccessToken($ga_service_token);
		}

		$key = file_get_contents($key_file_location);
		$cred = new Google_Auth_AssertionCredentials(
		    $service_account_name,
		    array(
		        'https://www.googleapis.com/auth/analytics',
		    ),
		    $key,
		    'notasecret'
		);

		//die(print_r($cred));

		$client->setAssertionCredentials($cred);
		if($client->getAuth()->isAccessTokenExpired()) {
		  $client->getAuth()->refreshTokenWithAssertion($cred);
		}

		$token = $client->getAccessToken();
		$this->session->set_userdata('ga_service_token', $token);

		$analytics = new Google_Service_Analytics($client);

		$date_visitor = array();

		$profileId = "ga:105408857";
		$startDate = date('Y-m-d', strtotime('-1 week')); // 31 days from now
		$endDate = date('Y-m-d'); // todays date

		$metrics = "ga:sessions";

		$optParams = array("dimensions" => "ga:date");
		$results = $analytics->data_ga->get($profileId, $startDate, $endDate, $metrics, $optParams);
		if(isset($results->rows) && !empty($results->rows)){
			$date_visitor = $results->rows;
		}

		$datavis = array();
		if(!empty($date_visitor)){
			foreach($date_visitor as $dv){
				$object = new stdClass();
                $y = 'y';
                $x = 'item1';
                $object->$y = date('d-m-Y',strtotime($dv[0]));
                $object->$x = $dv[1];
                
                $datavis[] = $object;
			}
		}

		//die(json_encode($datavis));
		$this->_data_load['datavis'] = $datavis;


		$total_user = 0;
		$startDate = '2013-01-01'; // 31 days from now
		$endDate = date('Y-m-d'); // todays date
		$results_user = $analytics->data_ga->get($profileId, $startDate, $endDate, $metrics);
		//die(json_encode($results_user));
		if(isset($results_user->rows[0][0]) && !empty($results_user->rows)){
			$total_user = $results_user->rows[0][0];
		}

		$this->_data_load['total_user'] = $total_user;
	}

	public function index(){
		$this->_init_ga();
		$this->load->model('mod_order','_order');
		$this->load->model('mod_customer','_customer');
		$this->load->model('mod_product','_product');
		

		
		$this->load->view('admin/dashboard',$this->_data_load);
	}
}