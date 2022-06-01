<?php

namespace Modules\ReportManagement\Controllers;

use App\Controllers\BaseController;
use Modules\Student\Models\StudentModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\PanelModel;
use App\Libraries\Pdf;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Controllers\FileUploading;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;
use Modules\SuperAdmin\Models\ProfessorsModel;

use Modules\Professor\Models\ProfessorSeminarModel;
use Modules\Professor\Models\PublishedResearchModel;

use Modules\ResearchManagement\Models\UserResearchModel;
use Modules\ProfileManagement\Models\FacultySeminarModel;
use Modules\ProfileManagement\Models\FacultyPublicationModel;


class ResearchReport extends BaseController{


	public function __construct(){
		$this->session = \Config\Services::session();

    $this->psModel = new ProfessorSeminarModel();
    $this->pResearch = new PublishedResearchModel();
    $this->adminConfigModel = new AdminConfigModel();
    $this->data['ad_config'] = $this->adminConfigModel->findAll();

		$sy_cd =  $this->adminConfigModel->getsy_cd();
    $this->rModel =  new ResearchModel();
    $this->data['research'] = $this->rModel->getLatestResearch($sy_cd['archive_year']);

		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

    $this->courseModel =  new CourseModel();
	 	$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['faculty'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	$this->panelModel =  new PanelModel();
	 	$this->data['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

    $this->userModel = new UserModel();
    $this->data['user'] = $this->userModel->findAll();

    $this->urModel = new UserResearchModel();
    $this->data['user_research'] = $this->urModel->findAll();

		$this->professorModel = new ProfessorsModel();
		$this->data['professors'] = $this->professorModel->findAll();

		$this->fsModel = new FacultySeminarModel();
		$this->crModel = new FacultyPublicationModel();

		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
    $this->acModel =  new AdminConfigModel();
    $this->prModel =  new PanelResearchModel();

		helper(['form']);

    $uniid = session()->get('logged_user');
    $role = $this->userModel->getLoggedInUserRole($uniid);

    $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
     $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 


	}


	public function index(){

		// print_r($this->data['allowed_task']);
    echo view('templates/user/header', $this->data);
    echo view('Modules\ReportManagement\Views\chooseReportV', $this->data);
    echo view('templates/user/footer');

	}

		public function research_report(){

		echo view('templates/user/header', $this->data);
		echo view('Modules\ReportManagement\Views\researchReportV', $this->data);
		echo view('templates/user/footer');
	}

	public function seminar_report(){

		$data =[];
		$data['validation'] = null;

			if($this->request->getMethod() == 'post'){
				$faculty = $this->request->getVar('faculty');
				 if($faculty == 0){

					 $data['all_seminar'] = $this->fsModel->seminar_report();
					 // print_r($data['all_seminar']);
					 // die();
					 echo view('templates/user/header', $this->data);
					 echo view('Modules\ReportManagement\Views\ListReport\allSeminarV', $data);
					 echo view('templates/user/footer');
					 die();
				 }else{

					 $data1['all_seminar'] = $this->fsModel->per_seminar_report($faculty);
					 $name = $this->userModel->getFacultyId($faculty);
					 $data2 = [
							 'detail' => [
									 'id'     => $faculty,
									 'fullname'  => ucwords($name['first_name']. " " .$name['last_name']),

							 ],
						];

				   $data = array_merge($data1, $data2);

					 echo view('templates/user/header', $this->data);
					 echo view('Modules\ReportManagement\Views\ListReport\perSeminarV', $data);
					 echo view('templates/user/footer');
					 die();

				 }

			}


		echo view('templates/user/header', $this->data);
		echo view('Modules\ReportManagement\Views\seminarReportV', $this->data);
		echo view('templates/user/footer');

	}

	public function pResearch_report(){
	    
	   // print_r($this->data['professors']);
	   // die();

		$data =[];
		$data['validation'] = null;

		$rules =[

				'year_start' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Year Start is required',

					],
				],

				'classification' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Classification is required',
					],
				],

				'year_end' => [
					'rules' => 'required|differs[year_start]',
					'errors' => [
						'required' => 'Year End is required',
						'differs' => 'Year start and Year end should not be the same. Try again',

					],
				],

				'faculty' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Faculty is required',
					],
				],

			];


			if($this->request->getMethod() == 'post'){
				if($this->validate($rules)){

					$query = [
								'year_start' => $this->request->getVar('year_start'),
								'year_end' => $this->request->getVar('year_end'),
								'classification' => $this->request->getVar('classification'),
								'faculty' => $this->request->getVar('faculty'),
					 ];

											if($query['year_start'] < $query['year_end']){
												if($query['classification'] == 1){
													if($query['faculty'] == 0){

														$data1['all_completed'] = $this->crModel->completed_report($query);
														$data2 = [
																'detail' => [
																	'year_start' => $query['year_start'],
																	'year_end' => $query['year_end'],
																	'classification' => $query['classification'],
																	'faculty' => $query['faculty'],

																],
														 ];

														 $data = array_merge($data1, $data2);
														// print_r($data['all_completed']);
														// die();

														echo view('templates/user/header', $this->data);
														echo view('Modules\ReportManagement\Views\ListReport\pResearch\allCompletedV', $data);
														echo view('templates/user/footer');
													}else{

														$data1['per_completed'] = $this->crModel->per_completed_report($query);
														$data2 = [
																'detail' => [
																	'year_start' => $query['year_start'],
																	'year_end' => $query['year_end'],
																	'classification' => $query['classification'],
																	'faculty' => $query['faculty'],

																],
														 ];

														 $data = array_merge($data1, $data2);

														echo view('templates/user/header', $this->data);
														echo view('Modules\ReportManagement\Views\ListReport\pResearch\perCompletedV', $data);
														echo view('templates/user/footer');
													}//faculty

												}else{
													if($query['faculty'] == 0){
														$data1['all_published'] = $this->crModel->published_report($query);

														$data2 = [
																'detail' => [
																	'year_start' => $query['year_start'],
																	'year_end' => $query['year_end'],
																	'classification' => $query['classification'],
																	'faculty' => $query['faculty'],

																],
														 ];

														 $data = array_merge($data1, $data2);

														echo view('templates/user/header', $this->data);
														echo view('Modules\ReportManagement\Views\ListReport\pResearch\allPublishedV', $data);
														echo view('templates/user/footer');

													}else{
														$data1['per_published'] = $this->crModel->per_published_report($query);
														$data2 = [
																'detail' => [
																	'year_start' => $query['year_start'],
																	'year_end' => $query['year_end'],
																	'classification' => $query['classification'],
																	'faculty' => $query['faculty'],

																],
														 ];

														$data = array_merge($data1, $data2);
												// 		print_r($data2['detail']);
												// 		die();
														echo view('templates/user/header', $this->data);
														echo view('Modules\ReportManagement\Views\ListReport\pResearch\perPublishedV', $data);
														echo view('templates/user/footer');

													}
												}

											}else{

												session()->setTempdata('wrongSY', 'Year start should be lesser than Year end. Try again', 2);
												return redirect()->to(base_url()."/report/pResearch");
										  }//year


				}else{
					$this->data['validation'] = $this->validator;
					echo view('templates/user/header', $this->data);
					echo view('Modules\ReportManagement\Views\pResearchReportV', $this->data);
					echo view('templates/user/footer');


				}
			}else{
				echo view('templates/user/header', $this->data);
				echo view('Modules\ReportManagement\Views\pResearchReportV', $this->data);
				echo view('templates/user/footer');

			}
	}//end function

  public function report_dashboard(){

		$data['perCourse'] = $this->rModel->researchPerCourseTb();
		$data1['perYear'] = $this->rModel->researchPerYearTb();
		$data2['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();
		$data3['course'] = $this->courseModel->findAll();

		$research = array_merge($data, $data1, $data2, $data3);
		// echo "<pre>";
		// print_r($research);
		// die();

    echo view('templates/user/header', $this->data);
		echo view('Modules\ReportManagement\Views\dashboardV', $research);
    echo view('Modules\Admin\Views\templates\footer');

	}

  public function prof_seminar(){

  $data['p_seminar'] = $this->psModel->seminar_report();

    // print_r($data['p_seminar']);

  echo view('templates/user/header', $this->data);
  echo view('Modules\ReportManagement\Views\profSeminarV', $data);
  echo view('Modules\Admin\Views\templates\footer');


  }

  public function prof_published_research(){

  $data['p_research'] = $this->pResearch->pResearch_report();

    // print_r($data['p_research']);

  echo view('templates/user/header', $this->data);
  echo view('Modules\ReportManagement\Views\profPublishedResearchV', $data);
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
						'required' => 'Year End is required',
						'differs' => 'Year start and Year end should not be the same. Try again',

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

									echo view('templates/user/header', $this->data);
									echo view('Modules\ReportManagement\Views\ListReport\allCourseV', $data);
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

								echo view('templates/user/header', $this->data);
								echo view('Modules\ReportManagement\Views\ListReport\perCourseV', $data);
								echo view('Modules\Admin\Views\templates\footer');


							}

						}else{

							session()->setTempdata('wrongSY', 'Year start should be lesser than Year end. Try again', 2);
							return redirect()->to(base_url()."/report/research");

						}

				}
				else{

					$this->data['validation'] = $this->validator;
					echo view('templates/user/header', $this->data);
			    echo view('Modules\ReportManagement\Views\researchReportV', $this->data);
			    echo view('templates/user/footer');

				}
			}//endpost

	}

	public function cont_list_course($year_start,  $year_end, $course){

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

				echo view('templates/user/header', $this->data);
				echo view('Modules\ReportManagement\Views\ListReport\perCourseV', $data);
				echo view('Modules\Admin\Views\templates\footer');


	}

	public function report_all_course_pdf($year_start, $year_end, $course){
	   


				$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

						$model = new ResearchModel();
						$courses = $model->getCourse($year_start, $year_end);
						$data['year_start'] = $year_start;
						$data['year_end'] = $year_end;
					// print_r($courses);
					// die();


								$pdf->SetTitle('Report');

						    // die(PDF_HEADER_LOGO);
						    $pdf->SetHeaderData('header.png', '130', '', '');
						  // die(PDF_HEADER_LOGO);
						    $pdf->setPrintHeader(true);
						  // set header and footer fonts
						    $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
						    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
						    // (di ata kailangan)
						    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

						    // set margins
						    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
						    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
						    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

						    // set auto page breaks
						    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

						    // set image scale factor
						    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

						    // set default font subsetting mode
						    $pdf->setFontSubsetting(true);

						    // Set font
						    $pdf->SetFont('dejavusans', '', 10, '', true);

								$style = array(
								'position' => '',
								'align' => 'C',
								'stretch' => false,
								'fitwidth' => true,
								'cellfitalign' => '',
								'border' => true,
								'hpadding' => 'auto',
								'vpadding' => 'auto',
								'fgcolor' => array(0, 0, 0),
								'bgcolor' => false, //array(255,255,255),
								'text' => true,
								'font' => 'helvetica',
								'fontsize' => 8,
								'stretchtext' => 4
						);

					foreach ($courses as $course) {

							$data['information']  = $model->getResearchPerCourse($year_start, $year_end,  $course['course_id']);

							$pdf->AddPage();

							$pdf->setCellPaddings(1, 1, 1, 1);

							// set cell margins
							$pdf->setCellMargins(1, 1, 1, 1);

							$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

							$pdf->writeHTML(view('report/report', $data), true, false, true, false, '');
							$pdf->Ln(4);
							 // $data['information'] = $info;

					}


					// ---------------------------------------------------------

					// close and output PDF document
					$pdf->Output('example_011.pdf', 'I');
					die();



	}

	public function report_all_course_csv($year_start, $year_end){

		$filename = 'document_'. $year_start.'-'.$year_end.'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");

		// get data
		$data = $this->rModel->getResearchAllCourseCsv($year_start, $year_end);

		// file creation
		$file = fopen('php://output', 'w');

		$header = array("Course","ID","Research Title","Abstract", "School Year");
		fputcsv($file, $header);

			foreach ($data as $key){

				fputcsv($file,$key);
			}

		fclose($file);
		exit;

	}

	public function report_per_course_pdf($year_start, $year_end, $course){

		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

							$model = new ResearchModel();
							$data['information'] = $model->getResearchPerCourse($year_start, $year_end, $course);
						
							$data['year_start'] = $year_start;
							$data['year_end'] = $year_end;

									$pdf->SetTitle('Report');

							    // die(PDF_HEADER_LOGO);
							    $pdf->SetHeaderData('header.png', '130', '', '');
							  // die(PDF_HEADER_LOGO);
							    $pdf->setPrintHeader(true);
							  // set header and footer fonts
							    $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
							    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
							    // (di ata kailangan)
							    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

							    // set margins
							    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
							    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
							    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

							    // set auto page breaks
							    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

							    // set image scale factor
							    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

							    // set default font subsetting mode
							    $pdf->setFontSubsetting(true);

							    // Set font
							    $pdf->SetFont('dejavusans', '', 10, '', true);

							    $style = array(
							        'position' => '',
							        'align' => 'C',
							        'stretch' => false,
							        'fitwidth' => true,
							        'cellfitalign' => '',
							        'border' => true,
							        'hpadding' => 'auto',
							        'vpadding' => 'auto',
							        'fgcolor' => array(0, 0, 0),
							        'bgcolor' => false, //array(255,255,255),
							        'text' => true,
							        'font' => 'helvetica',
							        'fontsize' => 8,
							        'stretchtext' => 4
							    );

							    $pdf->AddPage();

							    $pdf->setCellPaddings(1, 1, 1, 1);

							    // set cell margins
							    $pdf->setCellMargins(1, 1, 1, 1);

							    $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

							    $pdf->writeHTML(view('report/report', $data), true, false, true, false, '');
							    $pdf->Ln(4);

					// ---------------------------------------------------------

					// close and output PDF document
					$pdf->Output('example_011.pdf', 'I');
					die();
	}

	public function report_per_course_csv($year_start, $year_end, $course){

		$filename = 'document_'. $course. '-'.$year_start.'-'.$year_end.'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");

		// get data
		 $data = $this->rModel->getResearchPerCourseCsv($year_start, $year_end, $course);

		// file creation
		$file = fopen('php://output', 'w');

		$header = array("ID","Research Title","Abstract", "School Year");
		fputcsv($file, $header);

				foreach ($data as $key){

					fputcsv($file,$key);
				}

			fclose($file);
			exit;

	 }

}
