<?php

namespace Modules\ResearchManagement\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\PanelModel;

use Modules\Admin\Models\AdminConfigModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Models\StudentModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\ResearchModel;

use Modules\Professor\Models\ProfessorModel;

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\RoleModel;
use Modules\SuperAdmin\Models\AdviserReasonModel;
use Modules\SuperAdmin\Models\AdminReasonModel;
use Modules\ProfileManagement\Models\ActivityLogModel;

use Modules\ResearchManagement\Models\UserResearchModel;



use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;


class ProfResearchApproval extends BaseController{

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

			$this->amModel = new AdminReasonModel();
			$this->data['admin_reason'] = $this->amModel->findAll();

			$this->advModel = new AdviserReasonModel();
			$this->data['adviser_reason'] = $this->advModel->findAll();

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

	 		$this->scModel =  new StudentCourseModel();
	 	  $this->data['student_course'] = $this->scModel->findAll();

			$sy_cd =  $this->adminConfigModel->getsy_cd();

      $this->rModel =  new ResearchModel();
      $this->data['document'] = $this->rModel->getLatestResearch($sy_cd['archive_year']);

      $this->urModel = new UserResearchModel();
      $this->data['user_research'] = $this->urModel->findAll();

      $this->prModel =  new PanelResearchModel();
			$this->alModel =  new ActivityLogModel();

		 //kunin ang role id ng user
		 $uniid = session()->get('logged_user');
		 $role = $this->userModel->getLoggedInUserRole($uniid);

		 $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
         $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 


	}

	public function index(){

    $uniid = session()->get('logged_user');
    $prof = $this->userModel->getLoggedInUserRole($uniid);

		$sy_cd =  $this->adminConfigModel->getsy_cd();

    $data['research'] = $this->rModel->getToApproveResearch($prof['faculty_code'], $sy_cd['archive_year']);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\ProfApproval\toApproveV', $data);
    echo view('templates/user/footer');


	}


  public function view_research_to_approve($id){

    $data['panels'] = $this->prModel->getResearchPanelist($id);
    $data2['author'] = $this->urModel->getResearchAuthors($id);
    $data3['research'] = $this->rModel->getResearch($id);

    $research = array_merge($data, $data2, $data3);

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\ProfApproval\researchV', $research);
    echo view('templates/user/footer');

  }

	public function approve_research($id=null){

		if($this->rModel->approveResearch($id)){
			if($this->rModel->adviserApproval($id)){

				session()->setTempdata('approved','Research is approved.', 3);
				return redirect()->to(base_url()."/research/profApproval");

			}else {
				echo "mali";
			}

		}
	}

	public function disapprove_research($id=null){

		$this->data['validation'] = null;

		$rules = [

			'reason' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Reason for denial is required',
					],
				],
			];

		if($this->validate($rules)){
			if($this->request->getMethod() == 'post'){

				$reason = $this->request->getVar('reason');

				if($this->rModel->disapproveResearch($id, $reason)){
					session()->setTempdata('disapproved','Research is disapproved.', 3);
					return redirect()->to(base_url()."/research/profApproval");


				}else{
					session()->setTempdata('notDisapproved','Research status is not disapproved.', 3);
					return redirect()->to(base_url()."/research/profApproval");

				}

			}
		}else{

			$this->data['validation'] = $this->validator;
		}


		$data['panels'] = $this->prModel->getResearchPanelist($id);
		$data1['authors'] = $this->srModel->getResearchAuthors($id);
		$data2['research'] = $this->rModel->getResearch($id);

		$research = array_merge($data, $data1, $data2);

		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\ProfApproval\toApproveV', $this->data);
		echo view('templates/user/footer');
	}


	/////////////////////////////////////////admin

	public function admin_toApprove_research(){
		// print_r($this->data['document']);
		// die();

		echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\AdminApproval\pendingApproval', $this->data);
    echo view('templates/user/footer');

	}

	public function admin_view_research($id = null){

		$data['panels'] = $this->prModel->getResearchPanelist($id);
		$data2['author'] = $this->urModel->getResearchAuthors($id);
		$data3['research'] = $this->rModel->getResearch($id);

		// print_r($data2['author']);
		// die();

		$research = array_merge($data, $data2, $data3);

		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\AdminApproval\researchV', $research);
		echo view('templates/user/footer');

	}

	public function pending_list_student(){

		$this->data['list_res'] = $this->urModel->getPendingProfRes();

		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\AdminApproval\listStudent', $this->data);
		echo view('templates/user/footer');

	}

	public function pending_list_prof(){

		$this->data['list_res'] = $this->urModel->getPendingStudentRes();

		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\AdminApproval\listProf', $this->data);
		echo view('templates/user/footer');

	}

	public function admin_approve_research($id= null){

		$task = "Approve Document";
		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$uid = $name['id'];
		$research = $this->rModel->find($id);

		if($this->rModel->adminApproveResearch($id)){
			$act = [
				'user_id' => $uid,
				'task_name' => $task,
				'detail_id' => $research['slugs'],

			];

			//get the research id and author id
			$notif = $this->urModel->getResearchAuthors($id);

			$mail_array =  array_column($notif, 'email');
			// couting how many emails
      $mail_count = count($mail_array); 

      for($i=0; $i<$mail_count; $i++) {

     		$subject = 'Research Status Update';
				// $message = 'Hi <br><br>'
				// . 'Congratulations! Your research has been approved.'
				// . '<br><br>Sincerely yours, RAAAS!';

				$email = \Config\Services::email();
				$view = \Config\Services::renderer();

				$mail_template = $view->render('email_template_approve');

				$email->setTo($mail_array);
				$email->setFrom('puptraaas@gmail.com', 'RAAAS');
				$email->setSubject($subject);
				$email->setMessage($mail_template);
    	}

			if($email->send()) {

				session()->setTempdata('approved','Research is approved successfully.', 3);
				return redirect()->to(base_url()."/research/adminApproval");

			}else{

				$data = $email->printDebugger(['headers']);
				print_r($data);
			}

			if($this->alModel->save($act)){
				session()->setTempdata('approved','Research is approved successfully.', 3);
				return redirect()->to(base_url()."/research/adminApproval");
			}else {
				session()->setTempdata('notApproved','Research is not approved. Try again.', 3);
				return redirect()->to(base_url()."/research/adminViewRes/".$id);
			}	
		}
	}

	public function admin_disapprove_research($id=null){
		$task = "Disapprove Document";
		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$uid = $name['id'];
		$research = $this->rModel->find($id);


		$this->data['validation'] = null;

		$rules = [

			'reason' => [
					'rules' => 'required',
					'errors' =>[
						'required' => 'Reason for denial is required',
					],
				],
			];

		if($this->validate($rules)){

			if($this->request->getMethod() == 'post'){

				$reason = $this->request->getVar('reason');

				if($this->rModel->adminDisapproveResearch($id, $reason)){
					$act = [
						'user_id' => $uid,
						'task_name' => $task,
						'detail_id' => $research['slugs'],

					];

					//get the research id and author id
					$notif = $this->urModel->getResearchAuthors($id);
					//send email
					
					$mail_array =  array_column($notif, 'email');
					// couting how many emails
		      $mail_count = count($mail_array); 

		      for($i=0; $i<$mail_count; $i++) {

		     		$subject = 'Research Status Update';
						// $message = 'Hi <br><br>'
						// . 'Sorry, your research has been dispproved. Please login to RAAAS for more details.'
						// . '<br><br>Sincerely yours, RAAAS!';

						$email = \Config\Services::email();
						$view = \Config\Services::renderer();

						$mail_template = $view->render('email_template_disapprove');

						$email->setTo($mail_array);
						$email->setFrom('puptraaas@gmail.com', 'RAAAS');
						$email->setSubject($subject);
						$email->setMessage($mail_template);
		    	}

					if($email->send()) {

						session()->setTempdata('disapproved','Research is disapproved.', 3);
					 	return redirect()->to(base_url()."/research/adminApproval");

					}else{

						$data = $email->printDebugger(['headers']);
						print_r($data);
					}

					if($this->alModel->save($act)) {

						session()->setTempdata('disapproved','Research is disapproved.', 3);
						return redirect()->to(base_url()."/research/adminApproval");

					}else {

						session()->setTempdata('notDisapproved','Research is not disapproved. Try again.', 3);
						return redirect()->to(base_url()."/research/adminViewRes/".$id);
					}
				}
			}

		}else{

			$this->data['validation'] = $this->validator;
		}


		// $data['panels'] = $this->prModel->getResearchPanelist($id);
		// $data1['authors'] = $this->srModel->getResearchAuthors($id);
		// $data2['research'] = $this->rModel->getResearch($id);
		//
		// $research = array_merge($data, $data1, $data2);

		echo view('templates/user/header', $this->data);
		echo view('Modules\ResearchManagement\Views\AdminApproval\pendingApproval', $this->data);
		echo view('templates/user/footer');

	} // end admin_disapprove_research

}
