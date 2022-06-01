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
use Modules\Student\Models\StudentSeminarModel;

use Modules\Student\Controllers\FileUploading;



class StudentInfo extends BaseController{


	public $data = [], $session;

	public function __construct(){

		helper("form");

		$this->data['validation'] = null;
		$this->session = \Config\Services::session();

		$this->sModel =  new StudentModel();
	 	$this->data['student'] = $this->sModel->orderBy('id', 'DESC')->findAll();

	 	$this->ssModel = new StudentSeminarModel();
	 }


	public function index(){
	
		$student = $this->sModel->getStudentId(session()->get('logged_user'));
		$id = $student['id'];
		$data1['student'] = $this->sModel->find($id);
		$data2['s_seminar'] = $this->ssModel->getStudentSeminar($id);

		$data = array_merge($data1, $data2);

		// print_r($data2['s_seminar']);
		echo view('Modules\Student\Views\templates\student_header');
		echo view('Modules\Student\Views\studentInfoV', $data);
		echo view('Modules\Student\Views\templates\student_footer');

	}

	public function add_seminar($id=null){

		$this->data['validation'] = null;

		$rules = [

			'title' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],

			'venue' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],

			'date' => [
				'rules' => 'required',
					'errors' =>[
						'required' => 'Course Title is required',
					],
				],



		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){
			
				$data = [

					'seminar_title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
					'sponsor' => $this->request->getVar('sponsor', FILTER_SANITIZE_STRING),
					'venue' => $this->request->getVar('venue'),
					'event_date' => $this->request->getVar('date'),
					'student_id' => $id,

				];


				if($this->ssModel->save($data) === true){

					session()->setTempdata('successSeminar', 'Seminar added successfully', 2);
						return redirect()->to(base_url('/student/infoSheet'));
				
				}else{

					session()->setTempdata('errorSeminar', 'Seminar failed to add. Try again.', 2);
						return redirect()->to(base_url('/student/infoSheet'));

				}

			}else{

				$this->data3['validation'] = $this->validator;

				$this->data1['student'] = $this->sModel->find($id);
				$this->data2['s_seminar'] = $this->ssModel->getStudentSeminar($id);

				$this->data = array_merge($this->data1, $this->data2, $this->data3);

				echo view('Modules\Student\Views\templates\student_header');
				echo view('Modules\Student\Views\studentInfoV', $this->data);
				echo view('Modules\Student\Views\templates\student_footer');

			}

		}

		


		// $this->view_config();

	}

	public function delete_seminar($id=null){
		

			if($this->ssModel->where('id', $id)->delete()){

					$this->session->setTempdata('deleted', 'Seminar deleted successfully', 3);
					return redirect()->to(base_url('/student/infoSheet'));
					
				
			}


	}

}



