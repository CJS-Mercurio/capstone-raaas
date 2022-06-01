<?php

namespace Modules\Student\Controllers;

use App\Controllers\BaseController;
use Modules\Student\Models\StudentModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\PanelModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Controllers\FileUploading;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;


class StudentHome extends BaseController{


	public $sModel, $fModel, $rModel, $session, $rid;
	public $data = [];

	public function __construct(){
		$this->session = \Config\Services::session();

		$this->userModel =  new UserModel();
		$this->taskModel =  new TaskModel();

		$this->acModel = new AdminConfigModel();
    $this->data['ad_config'] = $this->acModel->findAll();

		$sy_cd =  $this->acModel->getsy_cd();

		$this->rModel =  new ResearchModel();
		$this->data['research'] = $this->rModel->getLatestResearch($sy_cd['archive_year']);


		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['faculty'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	$this->panelModel =  new PanelModel();
	 	$this->data['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

		$this->cModel =  new CourseModel();
		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();

		helper(['form']);


		$uniid = session()->get('logged_user');
		$role = $this->sModel->getLoggedInUserRole($uniid);

		$this->data['allowed_task'] = $this->taskModel->getUserPermission($role['role_id']);


	}
	public function index(){

		// print_r($this->data['allowed_task']);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentHomeV', $this->data);
		echo view('Modules\Student\Views\templates\student_footer');

	}

	public function studentProfile(){

		$data = [];

		$uniid = session()->get('logged_user');

		$data['userdata'] = $this->sModel->getLoggedInUserData($uniid);

		if($this->request->getMethod() == 'post'){
			$rules =[
				'opwd' => 'required',
				'npwd' => 'required|min_length[8]|max_length[16]',
				'cnpwd' => 'required|matches[npwd]',

				'opwd' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Old Password is required',
						'min_length' => 'First name must be atleast {param} characters in length',
					],
				],

				'npwd' => [
					'rules' => 'required|min_length[8]|max_length[16]',
					'errors' =>[
						'required' => 'New Password is required',
						'min_length' => 'New Password must be atleast {param} characters in length',
					],
				],

				'cnpwd' => [
					'rules' => 'required|matches[npwd]',
					'errors' =>[
						'required' => 'Confirm Password is required',
						'matches' => 'Password entered do not match',
					],
				],


			];

			if($this->validate($rules)){

				$opwd = $this->request->getVar('opwd');
				$npwd = password_hash($this->request->getVar('npwd'), PASSWORD_DEFAULT);

				if(password_verify($opwd, $data['userdata']->password)){

					if($this->sModel->updatePassword($npwd, session()->get('logged_user'))){

						session()->setTempdata('success', 'Password Updated successfully', 3);
						return redirect()->to(base_url('/student/profile'));

					}else{
						session()->setTempdata('error', 'Unable to update the password. Try again!', 3);
						return redirect()->to(base_url('/student/profile'));

					}

				}else{
					session()->setTempdata('error', 'Old Password does not matched', 3);
					return redirect()->to(base_url('/student/profile'));
				}



			}else{
				$data['validation'] = $this->validator;
			}
		}

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentProfileV', $data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

	public function edit(){


		$data = [];
		$data['validation'] = null;

		$uniid = session()->get('logged_user');
		$data['userdata'] = $this->sModel->getLoggedInUserData($uniid);

		if($this->request->getMethod() == 'post'){

			$rules = [

					'first_name' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'First name is required',
						'min_length' => 'First name must be atleast {param} characters in length',
					],
				],


				'middle_name' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Middle name is required',
						'min_length' => 'Middle name must be atleast {param} characters in length',
					],
				],

				'last_name' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Last name is required',
						'min_length' => 'Last name must be atleast {param} characters in length',
					],
				],

				'gender' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Choose a gender',
					],
				],

				'birthdate' => [
					'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
					'errors' => [
						'required' => 'Birthday is required',
						'regex_match' => 'Birthday field format is incorrect',
					],
				],

				'batch_year' => [
					'rules' => 'required|regex_match[^(201[5-9]|202[0-1])$]|exact_length[4]',
					'errors' => [
						'required' => 'Batch Year is required',
						'regex_match' => 'Batch Year field format is incorrect',

					],
				],

				'student_number' => [
					'rules' => 'required|regex_match[^(201[5-9]|202[0-1])[-.](00[0-9][0-9][0-9])[-.]TG[-.]0$]',
					'errors' => [
						'required' => 'Student Number is required',
						'regex_match' => 'Student number field format is incorrect',
						// 'is_unique' => 'Student number already exist',
					],
				],

				'course' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Choose a course',
					],
				],

				'academic_status' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Choose current Academic Status',
					],
				],

				'email' => [
					'rules' => 'required|valid_email',
					'errors' => [
						'required' => 'Email is required',
						'valid_email' => 'Enter a valid Email',
						// 'is_unique' => 'Email already exist',
					],
				],

			];

			if($this->validate($rules)){

				$userdata = [
					'first_name' => $this->request->getVar('first_name', FILTER_SANITIZE_STRING),
					'middle_name' => $this->request->getVar('middle_name', FILTER_SANITIZE_STRING),
					'last_name' => $this->request->getVar('last_name', FILTER_SANITIZE_STRING),
					'gender' => $this->request->getVar('gender'),
					'birthdate' => $this->request->getVar('birthdate'),
					'batch_year' => $this->request->getVar('batch_year'),
					'student_number' => $this->request->getVar('student_number'),
						// 'branch_id' => $this->request->getVar('pup_branch');
						// 'course_id' => $this->request->getVar('course');
					'academic_status' => $this->request->getVar('academic_status'),
					'email' => $this->request->getVar('email'),
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),

				];


				if($this->sModel->updateUserInfo($userdata, session()->get('logged_user'))){
					session()->setTempdata('success', 'Profile Updated successfully', 3);
					return redirect()->to(base_url('/student/edit'));

				}else{
					session()->setTempdata('error', 'Unable to update profile. Try again!', 3);
					return redirect()->to(base_url('/student/edit'));
				}

			}else{
				$data['validation'] = $this->validator;
			}
		}

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentEditProfileV', $data);
		echo view('Modules\Student\Views\templates\student_footer');

	}

	public function after_upload() {
		$student_id = $this->sModel->getStudentId(session()->get('logged_user'));
		$data['stud_research'] = $this->srModel->getResearchDetails($student_id['id']);

		$this->session->setTempdata('success', 'Research created Successfully.', 3);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentManageV', $data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

	public function manageResearch(){


		$student_id = $this->sModel->getStudentId(session()->get('logged_user'));
		$data['stud_research'] = $this->srModel->getResearchDetails($student_id['id']);
		// $data['stud_research'] = $this->srModel->getResearchOfStudent();



		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentManageV', $data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

	public function uploadResearch(){

		$this->data['validation'] = null;

		if($this->request->getMethod() == 'post'){

			$rules = [

				'title' => [
					'rules' => 'required|is_unique[research.title]',
					'errors' =>[
						'required' => 'Title is required',
						'is_unique' => 'Research Title already in the Database',
					],
				],


				'abstract' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Abstract is required',
					],
				],

				'keyword' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Keyword is required',
					],
				],

				'selectedAuthors' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Authors is required',
					],
				],

				'adviser' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Adviser is required',
					],
				],

				'selectedPanelist' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Panelist is required',


					],
				],

				'defense_date' => [
					'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
					'errors' => [
						'required' => 'Defense date is required',
						'regex_match' => 'Defense date field format is incorrect',
						// 'is_unique' => 'Student number already exist',
					],
				],

				'date_submitted' => [
					'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
					'errors' => [
						'required' => 'Date submitted is required',
						'regex_match' => 'Date submitted field format is incorrect',
						// 'is_unique' => 'Student number already exist',
					],
				],

				'uploadFile' => [
					'rules' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,wpd,pdf]',
					'errors' =>[
						'uploaded' => 'Upload a file (.zip, .wpd, .pdf).',
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],

			];

			$abstract = $this->request->getVar('abstract', FILTER_SANITIZE_STRING);
			$keywords = $this->request->getVar('keyword', FILTER_SANITIZE_STRING);

			$count = str_word_count($abstract);
			$count1 = str_word_count($keywords);

			if($this->validate($rules)){

				$sy_cd =  $this->acModel->getsy_cd();
				$student_id =  $this->sModel->getStudentId(session()->get('logged_user'));
				$course_id = $this->scModel->getStudentCourseId($student_id['id']);
				$paper_type = $this->cModel->getCourseData($course_id['course_id']);

				if($count >= 300 && $count <= 350){

					if($count1 >= 5){

						$file = $this->request->getFile('uploadFile');
						if($file->isValid() && !$file->hasMoved()){

							if($file->move(FCPATH.'public/researches', $file->getName())){
								$filename = $file->getName();

								$research_status = 0;
								$this->data = [
										'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
										'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
										'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
										'school_year' => $sy_cd['school_year'],
										'director' => $sy_cd['current_director'],
										'file' => $filename,
										'paper_type' => $paper_type['paper_type'],
										'adviser' => $this->request->getVar('adviser'),
										'research_status' => $research_status,
										'defense_date' => $this->request->getVar('defense_date'),
										'date_submitted' => $this->request->getVar('date_submitted'),
										'course_id' => $course_id['course_id'],

									];


							}//fcpath
							else{
								$this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
							}

						}//isValid hasMoved

						$selectedAuthors = $this->request->getVar('selectedAuthors');
					    $selectedPanelist = $this->request->getVar('selectedPanelist');
						$title = $this->data['title'];

						if($this->rModel->save($this->data)){

								$research_id = $this->rModel->getResearchId($title);
								$temp = $research_id['id'];
								$this->rid = $temp;

								$student_id =  $this->sModel->getStudentId(session()->get('logged_user'));


									 foreach ($selectedAuthors as $author){

									 	$student_research_data = [
											'research_id' =>$research_id['id'],
											'student_id' => $author,
										];

										$this->srModel->createStudentResearch($student_research_data);

										// if($this->srModel->createStudentResearch($student_research_data)){

										// 	echo "tama";

										// }else{
										// 	echo "mali";
										// }

								      }

								       foreach ($selectedPanelist as $panel){
								         	$research_panel_data = [
											'research_id' =>$research_id['id'],
											'panel_id' => $panel,
										];

								        $this->prModel->createResearchPanelist($research_panel_data);

								      }



								$this->session->setTempdata('success','Research created successfully.', 3);
								$this->session->setTempdata('rid', $temp);

								return redirect()->to(base_url('/student/afterUpload'));

						}else{

								$this->session->setTempdata('error','Sorry! Unable to upload research. Try again', 3);
								return redirect()->to(base_url('/student/upload'));
							 }


					}//count1
					else{
						$this->session->setTempdata('errorKey','Minimum number of keywords must be 5', 3);

					}
				}//count
				else{
					$this->session->setTempdata('errorAbs','Minimum word for Abstract is 300. Maximum is 350', 3);

				}


			}else{
				$this->data['validation'] = $this->validator;
			}
		}

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentUploadV', $this->data);
		echo view('Modules\Student\Views\templates\student_footer');

	}

	function add_panelist(){

		$this->data['validation'] = null;

		if($this->request->getMethod() == 'post'){
				$rules = [

				'firstname' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Firstname is required',
						'min_length' => 'Firstname should atleast have {param} characters',

					],
				],


				'lastname' => [
					'rules' => 'required|min_length[2]',
					'errors' =>[
						'required' => 'Abstract is required',
						'min_length' => 'Lastname should atleast have {param} characters',
					],
				],


			];


				if($this->validate($rules)){
					$panelData = [
						'f_firstname' => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
						'f_lastname' => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
						'occupation' => $this->request->getVar('company', FILTER_SANITIZE_STRING),
						'position' => $this->request->getVar('position', FILTER_SANITIZE_STRING),

					];

					if($this->panelModel->save($panelData) === true) {
						session()->setTempdata('successPanel', 'Panel added successfully', 2);
						return redirect()->to(base_url('/student/upload'));

					}
					else{
						session()->setTempdata('successPanel', 'Panel added successfully', 2);


					}


				}//validation
				else{

					  $this->data['validation'] = $this->validator;

					}


			}//post

		$this->upload_reseach_view();

	}



	public function fileUpload(){

	$this->data['validation'] = null;
	$page_session = \Config\Services::session();



	$rules = [

			'uploadFile' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,docx,pdf]',

			'uploadFile' => [
					'rules' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,docx,pdf]',
					'errors' =>[
						'uploaded' => 'Upload a file (.zip, .docx, .pdf).',
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],
		];

		if($this->validate($rules)){
			if($this->request->getMethod() == 'post'){

				$file = $this->request->getFile('uploadFile');
				if($file->isValid() && !$file->hasMoved()){

					if($file->move(FCPATH.'public/researches', $file->getName())){

						$path = base_url().'/public/researches/' .$file->getName();
             		    $rid = $page_session->getTempdata('file_rid');
						$filename = $file->getName();


						$status = $this->rModel->updateFile($filename, $rid);

						if($status == true){

							$this->session->setTempdata('tama','Research File uploaded successfully.', 3);

						}//status
						else{
							$this->session->setTempdata('mali','Research File not uploaded. Try again.', 3);
						}

					}//fcpath
					else{
						$this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
					}

				}//isValid hasMoved

			}//post


		}else{
		  	$this->data['validation'] = $this->validator;
		}


		$this->upload_reseach_view();

	}



	public function fileEditUpload($id=null){

	$this->data['validation'] = null;
	$page_session = \Config\Services::session();



	$rules = [

			'uploadFile' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,docx,pdf]',

			'uploadFile' => [
					'rules' => 'uploaded[uploadFile]|ext_in[uploadFile,zip,docx,pdf]',
					'errors' =>[
						'uploaded' => 'Upload a file (.zip, .docx, .pdf).',
						'ext_in' => 'Invalid file extension. Try again.',
					],
				],
		];

		if($this->validate($rules)){
			if($this->request->getMethod() == 'post'){

				$file = $this->request->getFile('uploadFile');
				if($file->isValid() && !$file->hasMoved()){

					if($file->move(FCPATH.'public/researches', $file->getName())){

						$path = base_url().'/public/researches/' .$file->getName();
						$filename = $file->getName();


						$status = $this->rModel->updateFile($filename, $id);

						if($status == true){

							$this->session->setTempdata('tama','Research File uploaded successfully.', 3);

						}//status
						else{
							$this->session->setTempdata('mali','Research File not uploaded. Try again.', 3);
						}

					}//fcpath
					else{
						$this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
					}

				}//isValid hasMoved

			}//post


		}else{
		  	$this->data['validation'] = $this->validator;
		}


		$this->upload_reseach_view();

	}


	function view_research($id = null){


		$data['panels'] = $this->prModel->getResearchPanelist($id);
    $data1['students'] = $this->srModel->getResearchAuthors($id);
    $data2['profs'] = $this->rpModel->getResearchAuthors($id);
		$data4['user'] = $this->urModel->getResearchAuthors($id);
    $data3['research'] = $this->rModel->find($id);

    $research = array_merge($data, $data1, $data2, $data3, $data4);

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentResearch2V', $research);
		echo view('Modules\Student\Views\templates\student_footer');

	}


	function upload_reseach_view(){

		echo view('Modules\Student\Views\templates\student_header', $this->data);
		echo view('Modules\Student\Views\studentUploadV', $this->data);
		echo view('Modules\Student\Views\templates\student_footer');

	}


}
