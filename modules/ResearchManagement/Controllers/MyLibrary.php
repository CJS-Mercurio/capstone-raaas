<?php

namespace Modules\ResearchManagement\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\PanelModel;

use Modules\Admin\Models\AdminConfigModel;
use Modules\Student\Models\StudentModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\ResearchModel;

use Modules\Professor\Models\ProfessorModel;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\RoleModel;

use Modules\ResearchManagement\Models\UserFavoriteModel;


use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;


class MyLibrary extends BaseController{

	public $courseModel;
	public $facultyModel;
	public $paperTypeModel;
	public $adminConfigModel;
	public $temp, $session;
	public $data =[];

	public function __construct(){

			$this->data['validation'] = null;


			$temp_papertype;
			helper("form");
			helper('date');
		 	$this->session = \Config\Services::session();

			$this->ufModel = new UserFavoriteModel();

			$this->courseModel = new CourseModel();
	 		$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

	 		$this->facultyModel = new FacultyModel();
	 		$this->data['faculty'] = $this->facultyModel->orderBy('id', 'DESC')->findAll();

			$this->userModel =  new UserModel();
			$this->data['user'] = $this->userModel->orderBy('id', 'DESC')->findAll();

			$this->roleModel =  new RoleModel();
			$this->data['role'] = $this->roleModel->orderBy('id', 'DESC')->findAll();

	 		$this->panelModel = new PanelModel();
	 		$this->data['panel'] = $this->panelModel->findAll();

	 		$this->adminConfigModel = new AdminConfigModel();
	 		$this->data['ad_config'] = $this->adminConfigModel->findAll();

	 		$this->sModel =  new StudentModel();
	 		$this->data['student'] = $this->sModel->orderBy('id', 'DESC')->findAll();

	 		$this->pModel =  new ProfessorModel();
			$this->data['professor'] = $this->pModel->orderBy('id', 'DESC')->findAll();

			$this->rModel =  new ResearchModel();
			$this->data['document'] = $this->rModel->orderBy('id', 'DESC')->findAll();

	 		$this->scModel =  new StudentCourseModel();
	 	  $this->data['student_course'] = $this->scModel->findAll();

		 //kunin ang role id ng user
		 $uniid = session()->get('logged_user');
		 $role = $this->userModel->getLoggedInUserRole($uniid);

		 $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
         $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 


	}

	public function index(){
		$uniid = session()->get('logged_user');
		$uid = $this->userModel->getLoggedInUserRole($uniid);

		$data['library'] = $this->ufModel->my_library($uid['id']);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\MyLibrary\ListOfFav', $data);
    echo view('templates/user/footer');


	}

	public function add_favorite($id = null){

		$uniid = session()->get('logged_user');
		$uid = $this->userModel->getLoggedInUserRole($uniid);

		if($this->request->getMethod() == 'post'){

					$data = [
						'user_id' => $uid['id'],
						'document_id' => $id,

					];

					if($this->ufModel->save($data)){

						session()->setTempdata('success','Research successfully added to your library.', 3);
		        return redirect()->to(base_url()."/research/viewResearchHome/".$id);

					}else {
						session()->setTempdata('error','Research is not added to your library. Try again.', 3);
		        return redirect()->to(base_url()."/research/viewResearchHome/".$id);
					}
		}
	}

	public function remove_favorite($id = null){

		$uniid = session()->get('logged_user');
		$uid = $this->userModel->getLoggedInUserRole($uniid);

		if($this->request->getMethod() == 'post'){

						$user_id = $uid['id'];
						$did = $id;

					if($this->ufModel->deleteFavorite($did, $user_id)){

						session()->setTempdata('success','Research successfully removed to your library.', 3);
						return redirect()->to(base_url()."/research/viewResearchHome/".$id);

					}else {
						session()->setTempdata('error','Research is not removed to your library. Try again.', 3);
		        return redirect()->to(base_url()."/research/viewResearchHome/".$id);
					}
		}
	}

}
