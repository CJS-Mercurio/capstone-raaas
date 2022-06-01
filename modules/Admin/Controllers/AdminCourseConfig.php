<?php

namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use monken\TablesIgniter;


class AdminCourseConfig extends BaseController{

	public $courseModel;
	public $facultyModel;
	public function __construct(){

			helper("form");
			$this->courseModel = new CourseModel();
			$data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

		}


	public function addCourse(){

		$data =[];
		$data['validation'] = null;

		$rules = [

			'course_name' => [
					'rules' => 'required|alpha_numeric_space|min_length[5]|is_unique[course.course_name]',
					'errors' =>[
						'required' => 'Course Title is required',
						'min_length' => 'Course should atleast have {param} characters',
						'is_unique' => 'Course Title already exist',
					],
				],

			'abbreviate' => [
				'rules' => 'required|alpha_numeric_space|min_length[3]',
				'errors' =>[
						'required' => 'Abbreviate field is required',
						'min_length' => 'Abbreviate field should atleast have {param} characters',
				],

			],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){

				$data = [
				'course_name' => $this->request->getVar('course_name', FILTER_SANITIZE_STRING),
				'abbreviate' => $this->request->getVar('abbreviate', FILTER_SANITIZE_STRING),

				];

				if($this->courseModel->save($data) === true){

				session()->setTempdata('success', 'Course added successfully', 2);
				return redirect()->to(base_url()."/admin/addCourse");
				}

			}else{

				$data['validation'] = $this->validator;
			}



		}

		// $errors = $this->courseModel->errors();

		echo view('Modules\Admin\Views\templates\header');
		echo view('Modules\Admin\Views\adminConfigV', $data);
		echo view('Modules\Admin\Views\templates\footer');

	}

	public function viewCourse(){


	}

	public function editCourse($id=null){


	}
	public function delete_course($id=null){

		if($this->request->getMethod() == 'post'){

			if($this->courseModel->where('id', $id)->delete()){
				return redirect()->to(base_url()."/admin/config");

			}else{
				echo "malli";
			}

		}

	}

}
