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
use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\GenderModel;
use Modules\SuperAdmin\Models\YearModel;
use Modules\SuperAdmin\Models\AcademicStatusModel;
use Modules\SuperAdmin\Models\StatusModel;
use Modules\SuperAdmin\Models\ForumSettingModel;
use Modules\SuperAdmin\Models\ForumReasonModel;
use Modules\SuperAdmin\Models\AdviserReasonModel;
use Modules\SuperAdmin\Models\AdminReasonModel;
use Modules\SuperAdmin\Models\EventTypeModel;
use Modules\SuperAdmin\Models\CourseScheduleModel;
use Modules\SuperAdmin\Models\CategoryModel;


class SuperAdminForm extends BaseController{

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

      $this->userModel = new UserModel();
			$this->data['user'] = $this->userModel->findAll();

			$this->courseModel = new CourseModel();
	 		$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

	 		$this->docTypeModel = new DocumentTypeModel();
	 		$this->data['type'] = $this->docTypeModel->findAll();

	 		$this->roleModel = new RoleModel();
	 		$this->data['role'] = $this->roleModel->findAll();

			$this->genderModel = new GenderModel();
	 		$this->data['gender'] = $this->genderModel->findAll();

			$this->yearModel = new YearModel();
	 		$this->data['year'] = $this->yearModel->findAll();

			$this->acad_statusModel = new AcademicStatusModel();
	 		$this->data['acad_status'] = $this->acad_statusModel->findAll();

			$this->statusModel = new StatusModel();
	 		$this->data['status'] = $this->statusModel->findAll();

	 		$this->moduleModel = new ModuleModel();
	 		$this->data['module'] = $this->moduleModel->findAll();

			$this->fsModel = new ForumSettingModel();
			$this->data['setting'] = $this->fsModel->findAll();

			$this->frModel = new ForumReasonModel();
			$this->data['forum_reason'] = $this->frModel->findAll();

			$this->amModel = new AdminReasonModel();
			$this->data['admin_reason'] = $this->amModel->findAll();

			$this->advModel = new AdviserReasonModel();
			$this->data['adviser_reason'] = $this->advModel->findAll();

			$this->etModel = new EventTypeModel();
			$this->data['event_type'] = $this->etModel->findAll();

			$this->categoryModel = new CategoryModel();
			$this->data['category'] = $this->categoryModel->findAll();

			$this->rModel =  new ResearchModel();
			$this->data['research'] = $this->rModel->orderBy('id', 'DESC')->findAll();
	}

  public function index(){

    // $data['admins'] = $this->userModel->findRoleID();

    // print_r($data['gender']);

    echo view('Modules\SuperAdmin\Views\templates\header');
    echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
    echo view('Modules\SuperAdmin\Views\templates\footer');

  }

	public function add_gender(){

		$this->data['validation'] = null;

		$rules = [

			'gender' => [
					'rules' => 'required|is_unique[gender.gender]',
					'errors' =>[
						'required' => 'Gender is required',
						'is_unique' => 'Gender already exist',
					],
				],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){


				$this->data = [
					'gender' => $this->request->getVar('gender', FILTER_SANITIZE_STRING),

				];


				if($this->genderModel->save($this->data) === true){

					session()->setTempdata('successGender', 'Gender added successfully', 2);
					return redirect()->to(base_url()."/superadmin/form");
				}else{
					session()->setTempdata('errorGender', 'Gender is not added. Please try again.', 2);
					return redirect()->to(base_url()."/superadmin/form");

				}

			}else{

				$this->data['validation'] = $this->validator;
			}

		}


		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}


	public function deact_gender($id = null){

		if($this->genderModel->deactivate($id)){
			session()->setTempdata('successDeactGender', 'Gender deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactGender', 'Gender is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}

	}

	public function act_gender($id = null){

		echo $id;

		if($this->genderModel->activate($id)){
			session()->setTempdata('successActGender', 'Gender activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActGender', 'Gender is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}
	}

	public function add_year(){

		$this->data['validation'] = null;

		$rules = [

			'year' => [
					'rules' => 'required|is_unique[academic_year.academic_year]',
					'errors' =>[
						'required' => 'Year is required',
						'is_unique' => 'Year already exist',
					],
				],


		];

		if($this->request->getMethod() == 'post'){


			if($this->validate($rules)){


				$this->data = [
					'academic_year' => $this->request->getVar('year', FILTER_SANITIZE_STRING),

				];


				if($this->yearModel->save($this->data) === true){

					session()->setTempdata('successYear', 'Year added successfully', 2);
					return redirect()->to(base_url()."/superadmin/form");
				}else{
					session()->setTempdata('errorYear', 'Year is not added. Please try again.', 2);
					return redirect()->to(base_url()."/superadmin/form");

				}

			}else{

				$this->data['validation'] = $this->validator;
			}

		}


		echo view('Modules\SuperAdmin\Views\templates\header');
		echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
		echo view('Modules\SuperAdmin\Views\templates\footer');
	}


	public function deact_year($id = null){

		if($this->yearModel->deactivate($id)){
			session()->setTempdata('successDeactYear', 'Year deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactYear', 'Year is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}

	}

	public function act_year($id = null){

		echo $id;

		if($this->yearModel->activate($id)){
			session()->setTempdata('successActYear', 'Year activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActYear', 'Year is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}
	}


//////////////////////////////////////////////////
	public function add_acad_status(){

				$this->data['validation'] = null;

				$rules = [

					'acad_status' => [
							'rules' => 'required|is_unique[academic_status.academic_status]',
							'errors' =>[
								'required' => 'Academic status is required',
								'is_unique' => 'Academic status already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){


					if($this->validate($rules)){


						$this->data = [
							'academic_status' => $this->request->getVar('acad_status', FILTER_SANITIZE_STRING),

						];


						if($this->acad_statusModel->save($this->data) === true){

							session()->setTempdata('successAcadStat', 'Academic status added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorAcadStat', 'Academic status is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}

				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');

	}

	public function deact_acad_status($id = null){

		if($this->acad_statusModel->deactivate($id)){
			session()->setTempdata('successDeactAcadStat', 'Academic Status deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactAcadStat', 'Academic Status is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_acad_status($id = null){

		echo $id;

		if($this->acad_statusModel->activate($id)){
			session()->setTempdata('successActAcadStat', 'Academic Status activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActAcadStat', 'Academic Status is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}


//////////////////////////////////////////////////
	public function deact_status($id = null){

		if($this->statusModel->deactivate($id)){
			session()->setTempdata('successDeactStatus', 'Status deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactStatus', 'Status is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_status($id = null){

		echo $id;

		if($this->statusModel->activate($id)){
			session()->setTempdata('successActStatus', 'Status activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActStatus', 'Status is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function add_status(){

				$this->data['validation'] = null;

				$rules = [

					'status' => [
							'rules' => 'required|is_unique[faculty_status.faculty_status]',
							'errors' =>[
								'required' => 'Status is required',
								'is_unique' => 'Status already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){


					if($this->validate($rules)){


						$this->data = [
							'faculty_status' => $this->request->getVar('status', FILTER_SANITIZE_STRING),

						];


						if($this->statusModel->save($this->data) === true){

							session()->setTempdata('successStatus', 'Status added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorStatus', 'Status is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}

				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');

	}


//////////////////////////////////////////////////
	public function add_paper_type(){

				$this->data['validation'] = null;

				$rules = [

					'paper_type' => [
							'rules' => 'required|is_unique[document_type.type]',
							'errors' =>[
								'required' => 'Document type is required',
								'is_unique' => 'Document type already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){
					if($this->validate($rules)){

						$this->data = [
							'type' => $this->request->getVar('paper_type', FILTER_SANITIZE_STRING),

						];


						if($this->docTypeModel->save($this->data) === true){

							session()->setTempdata('successPaper', 'Document type added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorPaper', 'Document type is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}
				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_paper_type($id = null){

		if($this->docTypeModel->deactivate($id)){
			session()->setTempdata('successDeactPaper', 'Paper Type deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactPaper', 'Paper Type is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_paper_type($id = null){

		echo $id;

		if($this->docTypeModel->activate($id)){
			session()->setTempdata('successActPaper', 'Paper Type activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActPaper', 'Paper Type is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}


//////////////////////////////////////////////////
	public function add_setting(){

				$this->data['validation'] = null;

				$rules = [

					'setting' => [
							'rules' => 'required|is_unique[setting.name]',
							'errors' =>[
								'required' => 'Setting is required',
								'is_unique' => 'Setting already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){
					if($this->validate($rules)){

						$this->data = [
							'name' => $this->request->getVar('setting', FILTER_SANITIZE_STRING),

						];


						if($this->fsModel->save($this->data) === true){

							session()->setTempdata('successSetting', 'Setting added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorSetting', 'Setting is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}
				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_setting($id = null){

		if($this->fsModel->deactivate($id)){
			session()->setTempdata('successDeactSetting', 'Setting deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactSetting', 'Setting is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_setting($id = null){

		if($this->fsModel->activate($id)){
			session()->setTempdata('successActSetting', 'Setting activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActSetting', 'Setting is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

 //////////////////////////////////////////////////
	public function add_forum_reason(){

				$this->data['validation'] = null;

				$rules = [

					'forum_reason' => [
							'rules' => 'required|is_unique[forum_reason.reason]',
							'errors' =>[
								'required' => 'Reason is required',
								'is_unique' => 'Reason already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){
					if($this->validate($rules)){

						$this->data = [
							'reason' => $this->request->getVar('forum_reason', FILTER_SANITIZE_STRING),

						];


						if($this->frModel->save($this->data) === true){

							session()->setTempdata('successForumReason', 'Reason added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorForumReason', 'Reason is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}
				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_forum_reason($id = null){

		if($this->frModel->deactivate($id)){
			session()->setTempdata('successDeactForumReason', 'Reason deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactForumReason', 'Reason is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_forum_reason($id = null){

		if($this->frModel->activate($id)){
			session()->setTempdata('successActForumReason', 'Reason activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActForumReason', 'Reason is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}


	//////////////////////////////////////////////////
	public function add_admin_reason(){

				$this->data['validation'] = null;

				$rules = [

					'admin_reason' => [
							'rules' => 'required|is_unique[admin_reason.reason]',
							'errors' =>[
								'required' => 'Reason is required',
								'is_unique' => 'Reason already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){
					if($this->validate($rules)){

						$this->data = [
							'reason' => $this->request->getVar('admin_reason', FILTER_SANITIZE_STRING),

						];


						if($this->amModel->save($this->data) === true){

							session()->setTempdata('successAdminReason', 'Reason added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorAdminReason', 'Reason is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}
				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_admin_reason($id = null){

		if($this->amModel->deactivate($id)){
			session()->setTempdata('successDeactAdminReason', 'Reason deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactAdminReason', 'Reason is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_admin_reason($id = null){

		if($this->amModel->activate($id)){
			session()->setTempdata('successActAdminReason', 'Reason activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActAdminReason', 'Reason is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}


  //////////////////////////////////////////////////////////
	public function add_adviser_reason(){

				$this->data['validation'] = null;

				$rules = [

					'adviser_reason' => [
							'rules' => 'required|is_unique[adviser_reason.reason]',
							'errors' =>[
								'required' => 'Reason is required',
								'is_unique' => 'Reason already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){
					if($this->validate($rules)){

						$this->data = [
							'reason' => $this->request->getVar('adviser_reason', FILTER_SANITIZE_STRING),

						];


						if($this->advModel->save($this->data) === true){

							session()->setTempdata('successAdviserReason', 'Reason added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorAdviserReason', 'Reason is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}
				}


				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_adviser_reason($id = null){

		if($this->advModel->deactivate($id)){
			session()->setTempdata('successDeactAdviserReason', 'Reason deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactAdviserReason', 'Reason is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_adviser_reason($id = null){

		if($this->advModel->activate($id)){
			session()->setTempdata('successActAdviserReason', 'Reason activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActAdviserReason', 'Reason is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}


	/////////////////////////////////////////////////////////
	public function add_event_type(){

				$this->data['validation'] = null;

				$rules = [

					'event_type' => [
							'rules' => 'required|is_unique[event_type.type]',
							'errors' =>[
								'required' => 'Event type is required',
								'is_unique' => 'Event type already exist',
							],
						],


				];

				if($this->request->getMethod() == 'post'){
					if($this->validate($rules)){

						$this->data = [
							'type' => $this->request->getVar('event_type', FILTER_SANITIZE_STRING),

						];


						if($this->etModel->save($this->data) === true){

							session()->setTempdata('successEventType', 'Event type added successfully', 2);
							return redirect()->to(base_url()."/superadmin/form");
						}else{
							session()->setTempdata('errorEventType', 'Event type is not added. Please try again.', 2);
							return redirect()->to(base_url()."/superadmin/form");

						}

					}else{

						$this->data['validation'] = $this->validator;
					}
				}

				echo view('Modules\SuperAdmin\Views\templates\header');
				echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
				echo view('Modules\SuperAdmin\Views\templates\footer');
	}

	public function deact_event_type($id = null){

		if($this->etModel->deactivate($id)){
			session()->setTempdata('successDeactEventType', 'Reason deactivated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorDeactEventType', 'Reason is not deactivated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}

	public function act_event_type($id = null){

		if($this->etModel->activate($id)){
			session()->setTempdata('successActEventType', 'Reason activated successfully', 2);
			return redirect()->to(base_url()."/superadmin/form");

		}else{
			session()->setTempdata('errorActEventType', 'Reason is not activated. Please try again.', 2);
			return redirect()->to(base_url()."/superadmin/form");
		}
	}
 //////////////////////////////////////////////////////////////////////
 public function deact_category($id = null){

	 if($this->categoryModel->deactivate($id)){
		 session()->setTempdata('successDeactCateg', 'Category deactivated successfully', 2);
		 return redirect()->to(base_url()."/superadmin/form");

	 }else{
		 session()->setTempdata('errorDeactCateg', 'Category is not deactivated. Please try again.', 2);
		 return redirect()->to(base_url()."/superadmin/form");
	 }
 }

 public function act_category($id = null){

	 echo $id;

	 if($this->categoryModel->activate($id)){
		 session()->setTempdata('successActCateg', 'Category activated successfully', 2);
		 return redirect()->to(base_url()."/superadmin/form");

	 }else{
		 session()->setTempdata('errorActCateg', 'Category is not activated. Please try again.', 2);
		 return redirect()->to(base_url()."/superadmin/form");
	 }
 }

 public function add_category(){

			 $this->data['validation'] = null;

			 $rules = [

				 'category' => [
						 'rules' => 'required|is_unique[document_category.category]',
						 'errors' =>[
							 'required' => 'Category is required',
							 'is_unique' => 'Category already exist',
						 ],
					 ],


			 ];

			 if($this->request->getMethod() == 'post'){
				 if($this->validate($rules)){

					 $this->data = [
						 'category' => $this->request->getVar('category', FILTER_SANITIZE_STRING),

					 ];


					 if($this->categoryModel->save($this->data) === true){

						 session()->setTempdata('successCateg', 'Category added successfully', 2);
						 return redirect()->to(base_url()."/superadmin/form");
					 }else{
						 session()->setTempdata('errorCateg', 'Category is not added. Please try again.', 2);
						 return redirect()->to(base_url()."/superadmin/form");

					 }

				 }else{

					 $this->data['validation'] = $this->validator;
				 }
			 }

			 echo view('Modules\SuperAdmin\Views\templates\header');
			 echo view('Modules\SuperAdmin\Views\saFormV', $this->data);
			 echo view('Modules\SuperAdmin\Views\templates\footer');

 }

}
