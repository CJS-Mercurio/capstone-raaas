<?php namespace App\Controllers;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;
use Modules\SuperAdmin\Models\PermissionModel;

use Modules\Admin\Models\DocumentTypeModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentModel;

use Modules\ForumManagement\Models\ForumModel;

class Home extends BaseController
{

	public function __construct(){
		$this->session = \Config\Services::session();

		$this->data['validation'] = null;

		helper("form");
		helper('date');

		$this->adminConfigModel = new AdminConfigModel();
		$this->data['ad_config'] = $this->adminConfigModel->findAll();

		$sy_cd =  $this->adminConfigModel->getsy_cd();

		$this->rModel =  new ResearchModel();
		$year = $sy_cd['archive_year'];

		$this->data['document'] = $this->rModel->getLatestResearch($year);

		// $this->data = [
		// 				'document' => $this->rModel->paginate(3),
    //         'pager' => $this->rModel->pager
		// ];

		$this->sModel = new StudentModel();
		$this->taskModel = new TaskModel();

		$this->userModel = new UserModel();
		$this->data['user'] = $this->userModel->findAll();

		$this->courseModel =  new CourseModel();
	 	$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

		$this->docTypeModel = new DocumentTypeModel();
	 	$this->data['type'] = $this->docTypeModel->findAll();

		$uniid = session()->get('logged_user');
		$role = $this->userModel->getLoggedInUserRole($uniid);

		$this->data['user'] = $this->userModel->getLoggedInUserRole($uniid);

		$this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);

		$this->forumModel =  new ForumModel();
		$this->data['forum'] = $this->forumModel->findAll();
		$this->data['forum_view'] = $this->forumModel->orderBy('dateFrom', 'ASC')->findAll();

		$uniid = session()->get('logged_user');
		$role = $this->userModel->getLoggedInUserRole($uniid);
		$this->data['user'] = $this->userModel->getLoggedInUserRole($uniid);
		 $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 

	}


	public function index()
	{

		// $uniid = session()->get('logged_user');
		// $role = $this->userModel->getLoggedInUserRole($uniid);
		//
		// $data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
		// echo $uniid;
		// die();



		echo view('templates/user/header', $this->data);
		echo view('user/userHomeV', $this->data);
		echo view('templates/user/footer');
	}



	//--------------------------------------------------------------------

}
