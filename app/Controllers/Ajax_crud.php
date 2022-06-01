<?php

namespace Modules\Admin\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;

use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;


class AdminHome extends BaseController{


	public function index(){

		$data = [];

		echo view('Modules\Admin\Views\templates\header', $data);
		echo view('Modules\Admin\Views\adminHomeV');
		echo view('Modules\Admin\Views\templates\footer');

	}

	public function configure(){

		$courseModel = new CourseModel();
 		$data['course'] = $courseModel->orderBy('id', 'DESC')->findAll();

		echo view('Modules\Admin\Views\templates\header');
		echo view('Modules\Admin\Views\adminConfigV', $data);
		echo view('Modules\Admin\Views\templates\footer');


	}

	public function add(){
		echo view('Modules\Admin\Views\templates\header');
		echo view('Modules\Admin\Views\adminConfigV');
		echo view('Modules\Admin\Views\templates\footer');

	}

	function add_course_validation()
	{
		helper(['form', 'url']);

		$error = $this->validate([
			'course_name'	=>	'required|min_length[3]|alpha_space',
			'abbreviate'	=>	'required|alpha_space'
		]);

		if(!$error)
		{
			echo view('add_course_data', [
				'error' 	=> $this->validator
			]);
		}
		else
		{
			$courseModel = new CourseModel();

			$crudModel->save([
				'course_name'	=>	$this->request->getVar('course_name'),
				'abbreviate'	=>	$this->request->getVar('abbreviate')
			]);

			$session = \Config\Services::session();

			$session->setFlashdata('success', 'Course Data Added');

			return $this->response->redirect(site_url('/admin/config'));
		}
	}

	function fetch_all()
	{
		$courseModel = new CourseModel();

		$data_table = new TablesIgniter();

		$data_table->setTable($courseModel->noticeTable())
				   // ->setDefaultOrder("id", "DESC")
				   // ->setSearch(["name", "email"])
				   // ->setOrder(["id", "name", "email", "gender"])
				   ->setOutput(["course_name", "abbreviate"]);
		return $data_table->getDatatable();
	}

	function courseAction(){
		echo "hello";
	}


}
