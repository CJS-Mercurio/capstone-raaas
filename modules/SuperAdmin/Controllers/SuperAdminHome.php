<?php

namespace Modules\SuperAdmin\Controllers;

use App\Controllers\BaseController;
use Modules\Student\Models\StudentModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\PanelModel;
use Modules\Admin\Models\DocumentTypeModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Controllers\FileUploading;

use Modules\SuperAdmin\Models\RoleModel;
use Modules\SuperAdmin\Models\ModuleModel;
use Modules\SuperAdmin\Models\PermissionModel;
use Modules\SuperAdmin\Models\TaskModel;





class SuperAdminHome extends BaseController{

	public function __construct(){

			$this->data['validation'] = null;

			helper("form");
			helper('date');


			$this->adminConfigModel = new AdminConfigModel();
			$this->data['ad_config'] = $this->adminConfigModel->findAll();

			$this->permissionModel = new PermissionModel();
			$this->data['permission'] = $this->permissionModel->findAll();

			$this->taskModel = new TaskModel();
			$this->data['task'] = $this->taskModel->findAll();

			$this->courseModel = new CourseModel();
	 		$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

	 		$this->documentTypeModel = new DocumentTypeModel();
	 		$this->data['type'] = $this->documentTypeModel->findAll();

	 		$this->roleModel = new RoleModel();
	 		$this->data['role'] = $this->roleModel->findAll();

	 		$this->moduleModel = new ModuleModel();
	 		$this->data['module'] = $this->moduleModel->findAll();

			$this->rModel =  new ResearchModel();
			$this->data['document'] = $this->rModel->orderBy('id', 'DESC')->findAll();
	}



	public function index(){
		// print_r($this->data['ad_config']);

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saHomeV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');


	}

	public function config_department(){

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saDepartmentV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');


	}

	public function add_department(){

			$this->data['validation'] = null;

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
					'rules' => 'required|min_length[3]',
					'errors' =>[
							'required' => 'Abbreviate field is required',
							'min_length' => 'Abbreviate field should atleast have {param} characters',
					],

				],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){


				$this->data = [
					'course_name' => $this->request->getVar('course_name', FILTER_SANITIZE_STRING),
					'abbreviate' => $this->request->getVar('abbreviate', FILTER_SANITIZE_STRING),

				];


				if($this->courseModel->save($this->data) === true){

					session()->setTempdata('successCourse', 'Course added successfully', 2);
					return redirect()->to(base_url()."/superadmin/addDepartment");
				}

			}else{

				$this->data['validation'] = $this->validator;
			}



		}


		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saDepartmentV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');

	}

	public function deact_department($id = null){

	 	if($this->courseModel->deactivate($id)){
	 		session()->setTempdata('successDeact', 'Department deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/department");

	 	}else{
	 		session()->setTempdata('errorDeact', 'Department deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/department");

	 	}

	}

	public function act_department($id = null){

	 	if($this->courseModel->activate($id)){
	 		session()->setTempdata('successAct', 'Department activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/department");

	 	}else{
	 		session()->setTempdata('errorAct', 'Department activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/department");

	 	}

	}

	public function config_role(){

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saRoleV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function add_role(){

		$this->data['validation'] = null;

		$rules = [

			'role_name' => [
					'rules' => 'required|alpha_numeric_space|is_unique[role.role_name]',
					'errors' =>[
						'required' => 'Role name is required',
						'is_unique' => 'Role name already exist',
					],
				],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){


				$this->data = [
					'role_name' => $this->request->getVar('role_name', FILTER_SANITIZE_STRING),

				];


				if($this->roleModel->save($this->data) === true){

					session()->setTempdata('successRole', 'Role added successfully', 2);
					return redirect()->to(base_url()."/superadmin/role");
				}else{
					session()->setTempdata('errorRole', 'Role is not added. Please try again.', 2);
					return redirect()->to(base_url()."/superadmin/role");

				}

			}else{

				$this->data['validation'] = $this->validator;
			}

		}


		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saRoleV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');

	}

	public function deact_role($id = null){

	 	if($this->roleModel->deactivate($id)){
	 		session()->setTempdata('successDeact', 'Role deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/role");

	 	}else{
	 		session()->setTempdata('errorDeact', 'Role is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/role");

	 	}

	}

	public function act_role($id = null){

	 	if($this->roleModel->activate($id)){
	 		session()->setTempdata('successAct', 'Role activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/role");

	 	}else{
	 		session()->setTempdata('errorAct', 'Role is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/role");

	 	}

	}


	public function config_permission(){

		$data1['permission'] = $this->permissionModel->getPermission();
		$data2['task'] = $this->taskModel->getActiveTask();

		$data = array_merge($data1, $data2);

		// print_r($data);
		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saPermissionV', $data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function edit_permission(){

		$data1['permission'] = $this->permissionModel->getPermission();
		$data2['task'] = $this->taskModel->getActiveTask();
		$data3['role'] = $this->roleModel->findAll();


		$data = array_merge($data1, $data2, $data3);

		if($this->request->getMethod() == 'post'){
			$myCheck = $this->request->getVar('myCheck');
			$task_id = $this->request->getVar('task_id');


			if($myCheck){
				 if($this->permissionModel->deletePermission($task_id)){

							foreach ($myCheck as $mC) {
								 $permission_data = [
										'task_id' => $task_id,
										'role_id' => $mC,
									];

									$this->permissionModel->insertPermission($permission_data);
							}
					}else{

							foreach ($myCheck as $mC) {
								 $permission_data = [
										'task_id' =>$task_id,
										'role_id' => $mC,
									];

									$this->permissionModel->insertPermission($permission_data);
							}

					}

				session()->setTempdata('successPermission', 'Changes saved successfully.', 2);
				return redirect()->to(base_url()."/superadmin/editPermission");


			}else{

					if($this->permissionModel->deletePermission($task_id)){
						session()->setTempdata('successPermission', 'Changes saved successfully.', 2);
						return redirect()->to(base_url()."/superadmin/editPermission");
					}
			}

	  }

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saEditPermissionV', $data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}


	public function config_module(){

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saModuleV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}


	public function add_module(){

		$this->data['validation'] = null;

		$rules = [

			'module_name' => [
					'rules' => 'required|alpha_numeric_space|is_unique[module.module_name]',
					'errors' =>[
						'required' => 'Module name is required',
						'is_unique' => 'Module already exist',
					],
				],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){


				$this->data = [
					'module_name' => $this->request->getVar('module_name', FILTER_SANITIZE_STRING),

				];


				if($this->moduleModel->save($this->data) === true){

					session()->setTempdata('successModule', 'Module added successfully', 2);
					return redirect()->to(base_url()."/superadmin/module");
				}else{
					session()->setTempdata('errorModule', 'Module is not added. Please try again.', 2);
					return redirect()->to(base_url()."/superadmin/module");

				}

			}else{

				$this->data['validation'] = $this->validator;
			}

		}


		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saModuleV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_module($id = null){

		if($this->moduleModel->deactivate($id)){
 			if($this->taskModel->deactivate1($id)){
 				session()->setTempdata('successDeact', 'Module deactivated successfully', 2);
 				return redirect()->to(base_url()."/superadmin/module");

 			}


	 	}else{
	 		session()->setTempdata('errorDeact', 'Module is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/module");

	 	}

	}

	public function act_module($id = null){

		if($this->moduleModel->activate($id)){
			if($this->taskModel->activate1($id)){
				session()->setTempdata('successAct', 'Module activated successfully', 2);
				return redirect()->to(base_url()."/superadmin/module");

			}

	 	}else{
	 		session()->setTempdata('errorAct', 'Module is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/module");

	 	}

	}


	public function edit_module($id = null){

		$data1['module']= $this->moduleModel->getModule($id);
		$data2['function'] = $this->taskModel->getFunction($id);


		$data = array_merge($data1, $data2);

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saEditModuleV', $data);
		echo view('Modules\SuperAdmin\Views\templates\footer');


	}


	public function add_function($id){

		$this->data['validation'] = null;

		$rules = [

			'func_name' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Function name is required',
					],
				],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){


				$task = [
					'task_name' => $this->request->getVar('func_name', FILTER_SANITIZE_STRING),
					'module_id' => $id,

				];

				if($this->taskModel->createTask($task) === true){


					session()->setTempdata('successFunction', 'Function added successfully', 2);
					return redirect()->to(base_url()."/superadmin/editModule/".$id);

				}else{
					session()->setTempdata('errorFunction', 'Function is not added. Please try again.', 2);
					return redirect()->to(base_url()."/superadmin/editModule/".$id);

				}

			}else{

				$data3['validation'] = $this->validator;
			}

		}

		$data1['module']= $this->moduleModel->getModule($id);
		$data2['function'] = $this->taskModel->getFunction($id);


		$data = array_merge($data1, $data2, $data3);

		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saEditModuleV', $data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}


	public function deact_function($id = null, $module_id){
	 	if($this->taskModel->deactivate($id)){
	 		session()->setTempdata('successDeact', 'Function deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/editModule/".$module_id);

	 	}else{
	 		session()->setTempdata('errorDeact', 'Function is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/editModule/".$module_id);

	 	}

	}

	public function act_function($id = null, $module_id){

	 	if($this->taskModel->activate($id)){
	 		session()->setTempdata('successAct', 'Function activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/editModule/".$module_id);

	 	}else{
	 		session()->setTempdata('errorAct', 'Function is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/editModule/".$module_id);

	 	}

	}



	public function config_archive(){
		$data =[];
		$data['validation'] = null;

		$rules =[

				'year_start' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Year Start is required',

					],
				],

				'year_end' => [
					'rules' => 'required|differs[year_start]',
					'errors' => [
						'required' => 'Year End Status is required',
						'differs' => 'Invalid year. Please try again',

					],
				],

			];
			if($this->request->getMethod() == 'post'){

				if($this->validate($rules)){

						$year_start = $this->request->getVar('year_start');
						$year_end = $this->request->getVar('year_end');

						if($year_start < $year_end){

							$archive_year = $year_start. "-". $year_end;
							if($this->adminConfigModel->updateAY($archive_year)){
								session()->setTempdata('successAY', 'Year updated successfully', 2);
								return redirect()->to(base_url()."/superadmin");
							}

						}else{

							session()->setTempdata('wrongAY', 'Invalid year. Please try again', 2);
							return redirect()->to(base_url()."/superadmin");

						}
				}
				else{

					$this->data['validation'] = $this->validator;

				}
			}//endpost


			echo view('Modules\SuperAdmin\Views\templates\header');
			echo view('Modules\SuperAdmin\Views\saHomeV', $this->data);
			echo view('Modules\SuperAdmin\Views\templates\footer');




	}

}
