<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

	private $_root_path;

	private $_page_path;

	private $_page_name = 'Ads';

	private $_admin_id;

	private $_menu_index = 1;

	private $_submenu_index = 0;

	private $_data_load = array();

// -------------------------- Default Property -------------------------------------//	

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		$this->load->model('mod_kecamatan');
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		//require_once APPPATH.'third_party/phpexcel/Classes/IOFactory.php';
		//require_once(BASEPATH . '../application/third_party/phpexcel/Classes/IOFactory.php');
		require_once(BASEPATH . '../application/third_party/phpexcel/Classes/PHPExcel/IOFactory.php');
		//die();
		$fileloc = BASEPATH.'../uploads/raw/tarif-2015.xlsx';
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load($fileloc);
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

			foreach ($worksheet->getRowIterator() as $row) {
				$row_idx = $row->getRowIndex();
				//echo '    Row number - ' , $row->getRowIndex() , EOL;


				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

				//die(var_dump($cellobjcode->getCalculatedValue()));
				foreach ($cellIterator as $cell) {
					if (!is_null($cell)) {
						$run_code = 'A'.$row_idx;
						$run_city = 'B'.$row_idx;
						$run_kec  = 'C'.$row_idx;
						$run_reg  = 'E'.$row_idx;
						$run_reg_et  = 'F'.$row_idx;
						$run_oke  = 'G'.$row_idx;
						$run_oke_et  = 'H'.$row_idx;
						$run_yes  = 'I'.$row_idx;
						
						$coord = 	$cell->getCoordinate();
						$coord = trim($coord);
						if($coord == $run_code){
							$code = $cell->getCalculatedValue();
						} elseif($coord == $run_city) {
							$city = $cell->getCalculatedValue(); 
						} elseif($coord == $run_kec) {
							$kec = $cell->getCalculatedValue(); 
						} elseif($coord == $run_reg) {
							$reg = $cell->getCalculatedValue(); 
						} elseif($coord == $run_reg_et) {
							$reg_et = $cell->getCalculatedValue(); 
						} elseif($coord == $run_oke) {
							$oke = $cell->getCalculatedValue(); 
						} elseif($coord == $run_oke_et) {
							$oke_et = $cell->getCalculatedValue(); 
						} elseif($coord == $run_yes) {
							$yes = $cell->getCalculatedValue(); 
						} 

						
					}
				}
				$exist = $this->is_exist($kec);
				if($code !='' && strtolower($code) !='coding' && !$exist){
					$city = trim(substr($city, 4));
					echo $city.'-------------';
					$row_city = $this->get_city($city);
					
					if($row_city!== false){
						$data = array();
						$data['name'] = $kec;
						$data['city_id'] = $row_city->id;
						$data['reg'] = $reg;
						$data['reg_et'] = $reg_et;
						$data['oke'] = $oke;
						$data['oke_et'] = $oke_et;
						$data['yes'] = $yes;
						$data['yes_et'] = '1-2';
						$data['cdate'] = time();
						$data['mdate'] = time();
						$mod_kec = new Mod_kecamatan();
						$mod_kec->set_value($data);
						$mod_kec->add();
						echo 'added';
					} 
					echo '<br />';
				}
				
				//echo '        Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , EOL;
			}
		}
	}

	private function get_city($city_name){
		$this->db->like('LOWER(name)',strtolower($city_name));
		$row = $this->db->get('city')->row();
		//die($this->db->last_query());
		if(empty($row)){
			return false;
		} else {
			return $row;
		}
	}

	public function is_exist($kec_name){
		$this->db->like('LOWER(name)',strtolower($kec_name));
		$count = $this->db->from('kecamatan')->count_all_results();
		//die($this->db->last_query());
		if($count > 0){
			return true;
		} else {
			return false;
		}
	}
}