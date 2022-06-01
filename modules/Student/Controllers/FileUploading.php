<?php

namespace Modules\Student\Controllers;

use App\Controllers\BaseController;
use Modules\Student\Models\StudentModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;

class FileUploading extends BaseController{


	public $rid;
	public $data = [];

	function __construct()
	{

		helper(['form']);

		$this->sModel =  new StudentModel();
	 	$this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

		$this->fModel =  new FacultyModel();
	 	$this->data['panel'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	}

	public function index(){
		$this->data['validation'] = null;

		echo view('Modules\Student\Views\templates\student_header', $data);
		echo view('Modules\Student\Views\studentUploadV', $this->data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

	public function uploadResearchDetail(){

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
					'rules' => 'required|max_length[400]',
					'errors' =>[
						'required' => 'Abstract is required',
						'max_length' => 'Abstract has reached the maximum length',
					],
				],

				'keyword' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Keyword is required',
					],
				],

				'author' => [
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

				'panelist' => [
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



			];

			if($this->validate($rules)){

				$sy_cd =  $this->acModel->getsy_cd();
				$student_id =  $this->sModel->getStudentId(session()->get('logged_user'));
				$course_id = $this->scModel->getStudentCourseId($student_id['id']);
				$paper_type = $this->cModel->getCourseData($course_id['course_id']);


				$research_status = 0;
				$data = [
					'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
					'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
					'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
					'school_year' => $sy_cd['school_year'],
					'director' => $sy_cd['current_director'],
					'paper_type' => $paper_type['paper_type'],
					// 'author' => $this->request->getVar('author'),
					'adviser' => $this->request->getVar('adviser'),
					// 'panelist' => $this->request->getVar('panelist'),
					'research_status' => $research_status,
					'defense_date' => $this->request->getVar('defense_date'),
					'date_submitted' => $this->request->getVar('date_submitted'),

				];


				$title = $data['title'];

				if($this->rModel->createResearch($data)){

						$research_id = $this->rModel->getResearchId($title);
						$temp = $research_id['id'];
						$this->rid = $temp;

						$student_id =  $this->sModel->getStudentId(session()->get('logged_user'));
						$course_id = $this->scModel->getStudentCourseId($student_id['id']);

							$student_research_data = [
								'research_id' =>$research_id['id'],
								'student_id' => $student_id['id'],
								'course_id' => $course_id['course_id'],
							];

						if($this->srModel->createStudentResearch($student_research_data)){

							$this->session->setTempdata('success','Research created successfully.', 3);
							return redirect()->to(base_url('/student/upload'));
						}

				}else{

						$this->session->setTempdata('error','Sorry! Unable to upload research. Try again', 3);
						return redirect()->to(base_url('/student/upload'));

					}

			}else{
				$this->data['validation'] = $this->validator;
			}
		}

		echo view('Modules\Student\Views\templates\student_header', $data);
		echo view('Modules\Student\Views\studentUploadV', $this->data);
		echo view('Modules\Student\Views\templates\student_footer');
	}

	public function setrid($rid){

		$this->rid = $rid;
	}
}
