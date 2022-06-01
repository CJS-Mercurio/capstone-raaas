<?php

namespace Modules\ProfileManagement\Controllers;

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

use Modules\ResearchManagement\Models\UserResearchModel;
use Modules\ProfileManagement\Models\ActivityLogModel;
use Modules\ForumManagement\Models\ForumModel;

class TrashBin extends BaseController{


	public function __construct(){
		$this->session = \Config\Services::session();

    $this->userModel = new UserModel();
    $this->data['user'] = $this->userModel->findAll();

		$this->alModel =  new ActivityLogModel();
		$this->data['act_log'] = $this->alModel->findAll();

    $this->rModel =  new ResearchModel();
    $this->urModel =  new UserResearchModel();
    $this->prModel =  new PanelResearchModel();
    $this->forumModel =  new ForumModel();

		helper(['form']);

    $uniid = session()->get('logged_user');
    $role = $this->userModel->getLoggedInUserRole($uniid);
	$this->data['loggedIn'] = $this->userModel->getLoggedInUserRole($uniid);
    $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
     $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 

	}

	public function index(){
		$uniid = session()->get('logged_user');
		$user = $this->userModel->getLoggedInUserRole($uniid);

		$data1['forum'] = $this->forumModel->getUserForum($user['id']);
    $data2['research'] = $this->urModel->getResearchDetails($user['id']);

    $data = array_merge($data1, $data2);

    echo view('templates/user/header', $this->data);
    echo view('Modules\ProfileManagement\Views\trashBinV', $data);
    echo view('templates/user/footer');

	}

  public function restore_document($id){
    if($this->rModel->updateDeleteStatusRestore($id)){

        session()->setTempdata('successRestore', 'Data is restored successfully', 2);
        return redirect()->to(base_url()."/profile/trash");

    }else{
      session()->setTempdata('errorRestore', 'Data is not restored. Please try again.', 2);
      return redirect()->to(base_url()."/profile/trash");

    }

  }

  public function restore_forum($id){
    if($this->forumModel->updateDeleteStatusRestore($id)){

        session()->setTempdata('successRestore', 'Data is restored successfully', 2);
        return redirect()->to(base_url()."/profile/trash");

    }else{
      session()->setTempdata('errorRestore', 'Data is not restored. Please try again.', 2);
      return redirect()->to(base_url()."/profile/trash");

    }
  }


  public function forum_view($id){
     $data['forum'] = $this->forumModel->find($id);

     echo view('templates/user/header', $this->data);
     echo view('Modules\ProfileManagement\Views\trash\forumView', $data);
     echo view('templates/user/footer');

  }

  public function document_view($id){

        $data['panels'] = $this->prModel->getResearchPanelist($id);
        $data1['authors'] = $this->urModel->getResearchAuthors($id);
        $data2['research'] = $this->rModel->getResearch($id);

        $research = array_merge($data, $data1, $data2);

        echo view('templates/user/header', $this->data);
        echo view('Modules\ProfileManagement\Views\trash\documentView', $research);
        echo view('templates/user/footer');

  }


}
