<?php

namespace Modules\Admin\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\PanelModel;
use App\Libraries\Pdf;

use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\PaperTypeModel;
use Modules\Student\Models\StudentModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\m_excel;
use Modules\Student\Models\StudentSeminarModel;

use Modules\Professor\Models\ProfessorSeminarModel;
use Modules\Professor\Models\PublishedResearchModel;
use Modules\Professor\Models\ProfessorModel;

use Modules\SuperAdmin\Models\UserModel;


use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;

class AdminReports extends BaseController{
	public function __construct(){

			$this->data['validation'] = null;

			helper("form");
		 	$this->session = \Config\Services::session();

			$this->rModel = new ResearchModel();
			$this->srModel = new StudentResearchModel();
			$this->psModel = new ProfessorSeminarModel();
			$this->pResearch = new PublishedResearchModel();
			$this->ssModel = new StudentSeminarModel();


			$this->courseModel = new CourseModel();
	 		$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

	 		$this->facultyModel = new FacultyModel();
	 		$this->data['faculty'] = $this->facultyModel->orderBy('id', 'DESC')->findAll();

	 		$this->panelModel = new PanelModel();
	 		$this->data['panel'] = $this->panelModel->findAll();

			$this->userModel =  new UserModel();
			$this->data['user'] = $this->userModel->orderBy('id', 'DESC')->findAll();

	 		$this->adminConfigModel = new AdminConfigModel();
	 		$this->data['ad_config'] = $this->adminConfigModel->findAll();

	 		$this->paperTypeModel = new PaperTypeModel();
	 		$this->data['paper_type'] = $this->paperTypeModel->findAll();

	 		$this->sModel =  new StudentModel();
	 		$this->data['student'] = $this->sModel->orderBy('id', 'DESC')->findAll();

	 		$this->pModel =  new ProfessorModel();
			$this->data['professor'] = $this->pModel->orderBy('id', 'DESC')->findAll();


	 		$this->scModel =  new StudentCourseModel();
	 	  $this->data['student_course'] = $this->scModel->findAll();

			$this->data['allowed_task'] = $this->userModel->getUserPermission(1);



	}

	public function index(){

		$data['perCourse'] = $this->rModel->researchPerCourseTb();
		$data1['perYear'] = $this->rModel->researchPerYearTb();
		$data2['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();
		$data3['course'] = $this->courseModel->findAll();
		$research = array_merge($data, $data1, $data2, $data3);
		// echo "<pre>";
		// print_r($research);
		// die();

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminReportsV', $research);
		echo view('Modules\Admin\Views\templates\footer');

	}

  public function report_dashboard(){

		$data['perCourse'] = $this->rModel->researchPerCourseTb();
		$data1['perYear'] = $this->rModel->researchPerYearTb();
		$data2['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();
		$data3['course'] = $this->courseModel->findAll();
		$research = array_merge($data, $data1, $data2, $data3);
		// echo "<pre>";
		// print_r($research);
		// die();

		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\adminDashboardV', $research);
		echo view('Modules\Admin\Views\templates\footer');


	}

	public function report_by_course(){
		$data =[];
		$data['validation'] = null;

		$rules =[

				'year_start' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Year Start is required',

					],
				],

				'course' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Course is required',
					],
				],

				'year_end' => [
					'rules' => 'required|differs[year_start]',
					'errors' => [
						'required' => 'Year End Status is required',
						'differs' => 'Invalid school year',

					],
				],

			];

			if($this->request->getMethod() == 'post'){
				if($this->validate($rules)){

						$year_start = $this->request->getVar('year_start');
						$year_end = $this->request->getVar('year_end');
						$course = $this->request->getVar('course');

						if($year_start < $year_end){

							if($course == 0){
							$data1['research'] = $this->rModel->getResearchAllCourse($year_start, $year_end);
							$data2 = [
							    'sy' => [
							        'year_start'     => $year_start,
							        'year_end'  => $year_end,

							    ],
							 ];
							$data = array_merge($data1, $data2);

									echo view('Modules\Admin\Views\templates\header', $this->data);
									echo view('Modules\Admin\Views\reports\allCourseV', $data);
									echo view('Modules\Admin\Views\templates\footer');
							}else{
								$data1['research'] = $this->rModel->getResearchPerCourse($year_start, $year_end, $course);
								$course_name = $this->courseModel->findCourse($course);

								$data2 = [
								    'sy' => [
								        'year_start'     => $year_start,
								        'year_end'  => $year_end,
								        'course_name' => $course_name['course_name'],
												'course_id' => $course_name['id']
								    ],
								 ];
								$data = array_merge($data1, $data2);

										echo view('Modules\Admin\Views\templates\header', $this->data);
										echo view('Modules\Admin\Views\reports\perCourseV', $data);
										echo view('Modules\Admin\Views\templates\footer');


							}

						}else{

							session()->setTempdata('wrongSY', 'Invalid School Year. Try again', 2);
							return redirect()->to(base_url()."/admin/reports");


						}



				}
				else{

					$this->data['validation'] = $this->validator;
					echo view('Modules\Admin\Views\templates\header', $this->data);
					echo view('Modules\Admin\Views\adminReportsV', $this->data);
					echo view('Modules\Admin\Views\templates\footer');


				}
			}//endpost


	}

	public function count_by_course(){

		// return view(base_url()."/admin/reports");
	}


	public function report_by_course_pdf($year_start, $year_end, $course){

	  	$data = $this->rModel->getResearchPerCourse($year_start, $year_end, $course);
			$course_name = $this->courseModel->findCourse($course);

			$title = "List of ". $course_name['course_name'] . '' . " research " . $year_start . ' - ' . $year_end;
			$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle('Report');

			// set default header data
			// die(PDF_HEADER_LOGO);
			$pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 12);
			// add a page
			$pdf->AddPage();
			$pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
			$pdf->SetFont('helvetica', '', 12);

			// column titles
			$header = array('ID', 'Title', 'School Year');



			// data loading
			// $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
			// echo "<pre>";
			// print_r($data);
			// die();
			// print colored table
			$pdf->SetFillColor(255, 0, 0);
			$pdf->SetTextColor(255);
			$pdf->SetDrawColor(128, 0, 0);
			$pdf->SetLineWidth(0.3);
			$pdf->SetFont('', 'B');
			// Header
			$w = array(25, 100, 50);
			$num_headers = count($header);
			for($i = 0; $i < $num_headers; ++$i) {
					$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
			}
			$pdf->Ln();
			// Color and font restoration
			$pdf->SetFillColor(224, 235, 255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
			// Data
			$fill = 0;

			if (!empty($data)) {
							foreach($data as $row) {
								$pdf->Cell($w[0], 7, $row['id'], 'LR', 0, 'C', $fill, '', 3, true);
								$pdf->Cell($w[1], 7, $row['title'], 'LR', 0, 'C', $fill, '', 3, true);
								$pdf->Cell($w[2], 7, $row['school_year'], 'LR', 0, 'C', $fill, '', 3, true);

								$pdf->Ln();
								$fill=!$fill;
							}

			}
			$pdf->Cell(array_sum($w), 0, '', 'T');

			// ---------------------------------------------------------

			// close and output PDF document
			$pdf->Output('example_011.pdf', 'I');
			die();
	}

	public function report_all_course_pdf($year_start, $year_end, $course){

		if($course == 0){
		$data = $this->rModel->getResearchAllCourse($year_start, $year_end);
		$title = "List of all research " . $year_start . ' - ' . $year_end;
		// echo "<pre>";
		// print_r($data);
		// die();
		}

		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Report');

		// set default header data
		// die(PDF_HEADER_LOGO);
		$pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
			$pdf->SetFont('helvetica', '', 15);
		// add a page
		$pdf->AddPage();
		$pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 12);

		// column titles
		$header = array('Course', 'ID', 'Title', 'School Year');



		// data loading
		// $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
		// echo "<pre>";
		// print_r($data);
		// die();
		// print colored table
		$pdf->SetFillColor(255, 0, 0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128, 0, 0);
		$pdf->SetLineWidth(0.3);
		$pdf->SetFont('', 'B');
		// Header
		$w = array(70, 15, 60, 30);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
				$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$pdf->Ln();
		// Color and font restoration
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		// Data
		$fill = 0;

		if (!empty($data)) {
			$ctr = 0;
			foreach($data as $row) {

					if($row['id'] == $ctr){
						$loop = true;
					}

					if($row['id'] > $ctr){
						$loop = false;
						$ctr = $row['id'];
					}

					if($loop == false){
						$pdf->Cell($w[0], 7, $row['course_name'], 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[1], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[2], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[3], 7, '', 'LR', 0, 'C', $fill, '', 1, true);

							$pdf->Ln();
							$fill=!$fill;



						foreach($data as $row) {
							if($row['id'] == $ctr){
							$pdf->Cell($w[0], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[1], 7, $row['rid'], 'LR', 0, 'C', $fill, '', 3, true);
							$pdf->Cell($w[2], 7, $row['title'], 'LR', 0, 'C', $fill, '', 3, true);
							$pdf->Cell($w[3], 7, $row['school_year'], 'LR', 0, 'C', $fill, '', 3, true);

							$pdf->Ln();
							$fill=!$fill;
							}else{
								$loop = true;
							}
						}
				    }
			}
		}
		$pdf->Cell(array_sum($w), 0, '', 'T');

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();
	}

	public function per_year_graph(){
		return $this->rModel->getReseachByYear();
	}
	public function per_course_graph(){
		return $this->rModel->getReseachByCourse();
	}
	public function per_adviser_graph(){
		return $this->rModel->getReseachByAdviser();
	}


	//seminar reports
	  	public function prof_seminar(){

  		$data['p_seminar'] = $this->psModel->seminar_report();

  		// print_r($data['p_seminar']);

  		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\reports\profSeminarV', $data);
		echo view('Modules\Admin\Views\templates\footer');


  	}

  	public function prof_published_research(){

  		$data['p_research'] = $this->pResearch->pResearch_report();

  		// print_r($data['p_research']);

  		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\reports\profPubResearchV', $data);
		echo view('Modules\Admin\Views\templates\footer');


  	}

  	public function all_student_seminar(){

  		$data['s_seminar'] = $this->ssModel->seminar_report();

  		// print_r($data['p_research']);

  		echo view('Modules\Admin\Views\templates\header', $this->data);
		echo view('Modules\Admin\Views\reports\studSeminarV', $data);
		echo view('Modules\Admin\Views\templates\footer');
  	}

  	public function per_student_seminar(){




  	}

  	/////////////////////////////////////////print seminars and pub research/////////////////////
  	public function faculty_seminar_pdf(){

  		$data = $this->psModel->seminar_report();
		$title = "Faculty Seminars/ Conferences and Trainings Attended";


  		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Report');

		// set default header data
		// die(PDF_HEADER_LOGO);
		$pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 15);
		// add a page
		$pdf->AddPage();
		$pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 10);

		// column titles
		$header = array('Professor', 'Seminar Title', 'Sponsor', 'Venue', 'Event date');



		// data loading
		// $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
		// echo "<pre>";
		// print_r($data);
		// die();
		// print colored table
		$pdf->SetFillColor(255, 0, 0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128, 0, 0);
		$pdf->SetLineWidth(0.3);
		$pdf->SetFont('', 'B');
		// Header
		$w = array(35, 35, 45, 35, 30);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
				$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$pdf->Ln();
		// Color and font restoration
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		// Data
		$fill = 0;
		if (!empty($data)) {
			$ctr = 0;
			foreach($data as $row) {

					if($row['professor_id'] == $ctr){
						$loop = true;
					}

					if($row['professor_id'] > $ctr){
						$loop = false;
						$ctr = $row['professor_id'];
					}

					if($loop == false){
						$pdf->Cell($w[0], 7, ucwords($row['f_firstname']. " " .$row['f_lastname']), 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[1], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[2], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[3], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[4], 7, '', 'LR', 0, 'C', $fill, '', 1, true);

							$pdf->Ln();
							$fill=!$fill;



						foreach($data as $row) {
							if($row['professor_id'] == $ctr){
							$pdf->Cell($w[0], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[1], 7, $row['seminar_title'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[2], 7, $row['sponsor'], 'LR', 0, 'C', $fill, '', 1, false);
							$pdf->Cell($w[3], 7, $row['venue'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[4], 7, $row['event_date'], 'LR', 0, 'C', $fill, '', 1, true);

							$pdf->Ln();
							$fill=!$fill;
							}else{
								$loop = true;
							}
						}
				    }
			}
		}
		$pdf->Cell(array_sum($w), 0, '', 'T');

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();

  	}

  	public function faculty_pResearch_pdf(){

  		$data = $this->pResearch->pResearch_report();
		$title = "List of Faculty Published Research";


  		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Report');

		// set default header data
		// die(PDF_HEADER_LOGO);
		$pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 15);
		// add a page
		$pdf->AddPage();
		$pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 10);

		// column titles
		$header = array('Faculty', 'Research Title', 'Publication', 'Volume', 'Institute','Event date');



		// data loading
		// $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
		// echo "<pre>";
		// print_r($data);
		// die();
		// print colored table
		$pdf->SetFillColor(255, 0, 0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128, 0, 0);
		$pdf->SetLineWidth(0.3);
		$pdf->SetFont('', 'B');
		// Header
		$w = array(30, 35, 30, 30, 30, 25);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
				$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$pdf->Ln();
		// Color and font restoration
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		// Data
		$fill = 0;
		if (!empty($data)) {
			$ctr = 0;
			foreach($data as $row) {

					if($row['professor_id'] == $ctr){
						$loop = true;
					}

					if($row['professor_id'] > $ctr){
						$loop = false;
						$ctr = $row['professor_id'];
					}

					if($loop == false){
						$pdf->Cell($w[0], 7, ucwords($row['f_firstname']. " " .$row['f_lastname']), 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[1], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[2], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[3], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[4], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[5], 7, '', 'LR', 0, 'C', $fill, '', 1, true);


							$pdf->Ln();
							$fill=!$fill;



						foreach($data as $row) {
							if($row['professor_id'] == $ctr){
							$pdf->Cell($w[0], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[1], 7, $row['research_title'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[2], 7, $row['publication'], 'LR', 0, 'C', $fill, '', 1, false);
							$pdf->Cell($w[3], 7, $row['volume'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[4], 7, $row['institute'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[5], 7, $row['event_date'], 'LR', 0, 'C', $fill, '', 1, true);


							$pdf->Ln();
							$fill=!$fill;
							}else{
								$loop = true;
							}
						}
				    }
			}
		}
		$pdf->Cell(array_sum($w), 0, '', 'T');

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();

  	}

  	public function student_seminar_pdf(){

  		$data = $this->ssModel->seminar_report();
		$title = "Student Seminars/ Conferences and Trainings Attended";


  		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Report');

		// set default header data
		// die(PDF_HEADER_LOGO);
		$pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 15);
		// add a page
		$pdf->AddPage();
		$pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 10);

		// column titles
		$header = array('Student', 'Seminar Title', 'Sponsor', 'Venue', 'Event date');



		// data loading
		// $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
		// echo "<pre>";
		// print_r($data);
		// die();
		// print colored table
		$pdf->SetFillColor(255, 0, 0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128, 0, 0);
		$pdf->SetLineWidth(0.3);
		$pdf->SetFont('', 'B');
		// Header
		$w = array(35, 35, 45, 35, 30);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
				$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$pdf->Ln();
		// Color and font restoration
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		// Data
		$fill = 0;
		if (!empty($data)) {
			$ctr = 0;
			foreach($data as $row) {

					if($row['student_id'] == $ctr){
						$loop = true;
					}

					if($row['student_id'] > $ctr){
						$loop = false;
						$ctr = $row['student_id'];
					}

					if($loop == false){
						$pdf->Cell($w[0], 7, ucwords($row['first_name']. " " .$row['last_name']), 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[1], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[2], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[3], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
						$pdf->Cell($w[4], 7, '', 'LR', 0, 'C', $fill, '', 1, true);

							$pdf->Ln();
							$fill=!$fill;



						foreach($data as $row) {
							if($row['student_id'] == $ctr){
							$pdf->Cell($w[0], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[1], 7, $row['seminar_title'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[2], 7, $row['sponsor'], 'LR', 0, 'C', $fill, '', 1, false);
							$pdf->Cell($w[3], 7, $row['venue'], 'LR', 0, 'C', $fill, '', 1, true);
							$pdf->Cell($w[4], 7, $row['event_date'], 'LR', 0, 'C', $fill, '', 1, true);

							$pdf->Ln();
							$fill=!$fill;
							}else{
								$loop = true;
							}
						}
				    }
			}
		}
		$pdf->Cell(array_sum($w), 0, '', 'T');

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();

  	}

  	public function faculty_seminar_csv(){


  		 $filename = 'seminar_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
  		   $data = $this->psModel->seminar_report2();

		   // file creation
		   $file = fopen('php://output', 'w');

		   $header = array("First Name","Last Name","Seminar","Sponsor","Venue", "Eventdate");
		   fputcsv($file, $header);

			   foreach ($data as $key){

			     fputcsv($file,$key);
			   }

		   fclose($file);
		   exit;
  	}

  	public function faculty_pResearch_csv(){


  		 $filename = 'pResearch_'.date('Ymd').'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
  		   $data = $this->pResearch->pResearch_report2();

		   // file creation
		   $file = fopen('php://output', 'w');

		   $header = array("First Name","Last Name","Research Title","Publication","Volume", "Institute", "Event Date");
		   fputcsv($file, $header);

			   foreach ($data as $key){

			     fputcsv($file,$key);
			   }

		   fclose($file);
		   exit;
  	}

  	public function research_allCourse_csv($year_start, $year_end){


  		 $filename = 'research_'. $year_start.'-'.$year_end.'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
  		  $data = $this->rModel->getResearchAllCourse2($year_start, $year_end);

		   // file creation
		   $file = fopen('php://output', 'w');

		   $header = array("ID","Research Title","School Year","Course");
		   fputcsv($file, $header);

			   foreach ($data as $key){

			     fputcsv($file,$key);
			   }

		   fclose($file);
		   exit;
  	}

  	 public function research_perCourse_csv($year_start, $year_end, $course){


  		 $filename = 'research_'. $year_start.'-'.$year_end.'.csv';
		   header("Content-Description: File Transfer");
		   header("Content-Disposition: attachment; filename=$filename");
		   header("Content-Type: application/csv; ");

		   // get data
  		  $data = $this->rModel->getResearchPerCourse2($year_start, $year_end, $course);

		   // file creation
		   $file = fopen('php://output', 'w');

		   $header = array("ID","Research Title","School Year");
		   fputcsv($file, $header);

			   foreach ($data as $key){

			     fputcsv($file,$key);
			   }

		   fclose($file);
		   exit;
  	}



}
