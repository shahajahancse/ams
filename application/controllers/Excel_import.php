<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Excel_import extends Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('excel_import_model');
		$this->load->library('excel');

		if(!$this->ion_auth->logged_in()){
			redirect('login');
		}elseif(!$this->ion_auth->is_admin()){
			return show_error('You must be an administrator to view this page.');
		}
	}

	function index()
	{
		$this->load->view('excel_import');
	}

	// Import upazila name english
	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				//echo '<pre>';
				//print_r($worksheet); exit;
				for($row=1; $row<=$highestRow; $row++)
				{
					$id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$name = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					

					$data[] = array(
						'id'		=>	$id,
						'upa_name_en'  => $name
						);
				}
			}
			// echo '<pre>';
			// print_r($data); exit;
			$this->excel_import_model->update_upazila($data);
			echo 'Data Imported successfully';
		}	
	}

	// Import institute
	function import_institute()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				// echo '<pre>';
				// print_r($worksheet); exit;
				for($row=2; $row<=$highestRow; $row++)
				{
					$name = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); 			//SCHOOL_NAME
					$eiin = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); 			//SCHOOL_CODE
					$pri_school_type = $worksheet->getCellByColumnAndRow(3, $row)->getValue();	//SCHOOL_TYPE
					$district = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 		//DIST_ID
					$upazila = $worksheet->getCellByColumnAndRow(5, $row)->getValue();		//THANA_ID
					$unions = $worksheet->getCellByColumnAndRow(6, $row)->getValue();			//UNION_ID
					$land_size = $worksheet->getCellByColumnAndRow(7, $row)->getValue();		//LAND_SIZE
					$building_no = $worksheet->getCellByColumnAndRow(8, $row)->getValue();	//NO_OF_BUILDING
					$pri_grade = $worksheet->getCellByColumnAndRow(9, $row)->getValue();		//GRADE
					$shift_no = $worksheet->getCellByColumnAndRow(10, $row)->getValue();		//NO_OF_SHIFT
					$estd_year = $worksheet->getCellByColumnAndRow(11, $row)->getValue();	//ESTD_YEAR
					$reg_year = $worksheet->getCellByColumnAndRow(12, $row)->getValue();		//REG_YEAR
					$nationalization_year = $worksheet->getCellByColumnAndRow(13, $row)->getValue();	//NATIONALIZATION_YEAR
					$pri_far_thana = $worksheet->getCellByColumnAndRow(14, $row)->getValue();	//FAR_FROM_THANA
					$name_bn = $worksheet->getCellByColumnAndRow(15, $row)->getValue();		//SCHOOL_NAME_BANGLA
					$pri_model = $worksheet->getCellByColumnAndRow(16, $row)->getValue();	//MODEL_SCHOOL
					$email = $worksheet->getCellByColumnAndRow(17, $row)->getValue();			//EMAIL
					$mobile = $worksheet->getCellByColumnAndRow(18, $row)->getValue();		//MOBILE

					$data[] = array(
						'edu_level_id'		=>	11,
						'institute_type'  => 'Primary',
						'education_level'	=> 'Primary',
						'district'			=>	$district,
						'upazila'			=>	$upazila,
						'unions'				=>	$unions,
						'eiin'				=>	$eiin,
						'name'				=>	$name,
						'name_bn'			=>	$name_bn,
						'mobile'				=>	$mobile,
						'email'				=>	$email,
						'land_size'			=>	$land_size,
						'building_no'		=>	$building_no,
						'shift_no'			=>	$shift_no,
						'estd_year'			=>	$estd_year,
						'reg_year'			=>	$reg_year,
						'nationalization_year'	=>	$nationalization_year,
						'pri_school_type'	=>	$pri_school_type,
						'pri_grade'			=>	$pri_grade,
						'pri_model'			=>	$pri_model,
						'pri_far_thana'	=>	$pri_far_thana						
						);
				}
			}
			$this->excel_import_model->insert($data);
			echo 'Data Imported successfully';
		}	
	}
	
	// function fetch()
	// {
	// 	$data = $this->excel_import_model->select();
	// 	$output = '
	// 	<h3 align="center">Total Data - '.$data->num_rows().'</h3>
	// 	<table class="table table-striped table-bordered">
	// 		<tr>
	// 			<th>Customer Name</th>
	// 			<th>Address</th>
	// 			<th>City</th>
	// 			<th>Postal Code</th>
	// 			<th>Country</th>
	// 		</tr>
	// 	';
	// 	foreach($data->result() as $row)
	// 	{
	// 		$output .= '
	// 		<tr>
	// 			<td>'.$row->CustomerName.'</td>
	// 			<td>'.$row->Address.'</td>
	// 			<td>'.$row->City.'</td>
	// 			<td>'.$row->PostalCode.'</td>
	// 			<td>'.$row->Country.'</td>
	// 		</tr>
	// 		';
	// 	}
	// 	$output .= '</table>';
	// 	echo $output;
	// }
	
}

?>