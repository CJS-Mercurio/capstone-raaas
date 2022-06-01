<?php

namespace Modules\ForumManagement\Controllers;

use App\Controllers\BaseController;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\AdminConfigModel;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\PanelModel;
use Modules\Admin\Models\PaperTypeModel;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\StudentCourseModel;
use Modules\Student\Models\StudentResearchModel;
use Modules\Student\Models\PanelResearchModel;
use Modules\Student\Controllers\FileUploading;
use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\RoleModel;
use Modules\Professor\Models\ProfessorResearchModel;
use Modules\Professor\Models\ProfessorModel;
use Modules\ForumManagement\Models\ForumModel;

use Modules\SuperAdmin\Models\ForumSettingModel;
use Modules\SuperAdmin\Models\ForumReasonModel;
use Modules\SuperAdmin\Models\EventTypeModel;

use Modules\ProfileManagement\Models\ActivityLogModel;

class ForumHome extends BaseController{

	public function __construct(){

    $this->data['validation'] = null;


    $temp_papertype;
    helper("form");
    helper('date');
    $this->session = \Config\Services::session();

		$this->fsModel = new ForumSettingModel();
		$this->data['setting'] = $this->fsModel->findAll();

		$this->frModel = new ForumReasonModel();
		$this->data['forum_reason'] = $this->frModel->findAll();

    $this->courseModel = new CourseModel();
    $this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

    $this->facultyModel = new FacultyModel();
    $this->data['faculty'] = $this->facultyModel->orderBy('id', 'DESC')->findAll();

    $this->userModel =  new UserModel();
    $this->data['user'] = $this->userModel->orderBy('id', 'DESC')->findAll();

    $this->roleModel =  new RoleModel();
    $this->data['role'] = $this->roleModel->orderBy('id', 'DESC')->findAll();

		$this->etModel =  new EventTypeModel();
    $this->data['event_type'] = $this->etModel->orderBy('id', 'DESC')->findAll();

    $this->panelModel = new PanelModel();
    $this->data['panel'] = $this->panelModel->findAll();

    $this->adminConfigModel = new AdminConfigModel();
    $this->data['ad_config'] = $this->adminConfigModel->findAll();

    $this->pModel =  new ProfessorModel();
    $this->data['professor'] = $this->pModel->orderBy('id', 'DESC')->findAll();

    $this->scModel =  new StudentCourseModel();
    $this->data['student_course'] = $this->scModel->findAll();

    $this->forumModel =  new ForumModel();
    $this->data['forum'] = $this->forumModel->findAll();
// 	$this->data['forum_view'] = $this->forumModel->orderBy('date', 'ASC')->findAll();
	$this->alModel =  new ActivityLogModel();
   

   //kunin ang role id ng user
   $uniid = session()->get('logged_user');
   $role = $this->userModel->getLoggedInUserRole($uniid);

   $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
   $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 

	}

	public function index(){

		// print_r($this->data['allowed_task']);
		// die();

		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$id = $name['id'];

		$this->data['user'] = $this->userModel->find($id);

		if($name['role_id'] == 1){
			echo view('templates/user/header', $this->data);
			echo view('Modules\ForumManagement\Views\adminForumHome', $this->data);
			echo view('templates/user/footer');

		}else {
			echo view('templates/user/header', $this->data);
	    echo view('Modules\ForumManagement\Views\forumHomeV', $this->data);
	    echo view('templates/user/footer');
		}
	}

  public function addForum() {
		$task = "Add Forum";

    $data = [];
    $data['validation'] = null;

		$uniid = session()->get('logged_user');
    $name = $this->userModel->getLoggedInUserRole($uniid);

		$user_name = ucwords($name['first_name']. " ". $name['last_name']);
		$id = $name['id'];

		if($name['role_id'] == 1){
		$status = 1;
		}else {
			$status = 0;
		}

    if($this->request->getMethod() == 'post') {

              $rules = [
                //names sa input form
                'forumTitle' => [
                  'rules' => 'required|min_length[5]',
                  'errors' =>[
                    'required' => 'Title is required',
                    'min_length' => 'Title should atleast contain {param} characters'
                  ],
                ],

								'forumFrom' => [
									'rules' => 'required',
									'errors' =>[
										'required' => 'Date is required',
									],
								],

								'forumTo' => [
									'rules' => 'required',
									'errors' =>[
										'required' => 'Date is required',
									],
								],

								'forumLocation' => [
                  'rules' => 'required',
                  'errors' =>[
                    'required' => 'Location is required',
                  ],
                ],

								'forumParam' => [
									'rules' => 'required',
									'errors' =>[
										'required' => 'Setting is required',
									],
								],

                'forumStart' => [
                  'rules' => 'required',
                  'errors' =>[
                    'required' => 'Date is required',
                  ],
                ],

                'forumTime' => [
                  'rules' => 'required',
                  'errors' =>[
                    'required' => 'Time is required',
                  ],
                ],

                'forumType' => [
                  'rules' => 'required',
                  'errors' =>[
                    'required' => 'Type is required',
                  ],
                ],

								'forumImage' => [
				          'rules' => 'ext_in[forumImage,png,jpg,jpeg]',
				          'errors' =>[
				            'ext_in' => 'Invalid file extension. Use .png, .jpg, .jpeg.',
				          ],
				        ],


              ];


          if($this->validate($rules)){

						$forumTime = date('h:i a', strtotime($this->request->getVar('forumTime', FILTER_SANITIZE_STRING)));

						$file = $this->request->getFile('forumImage');
						if($file->isValid() && !$file->hasMoved()){

							if($file->move(FCPATH.'public/forumImages', $file->getName())){
								$filename = $file->getName();



								$var = [
								//fields                             input name
									'title' => $this->request->getVar('forumTitle', FILTER_SANITIZE_STRING),
									'dateFrom' => $this->request->getVar('forumFrom', FILTER_SANITIZE_STRING),
									'dateTo' => $this->request->getVar('forumTo', FILTER_SANITIZE_STRING),
									'location' => $this->request->getVar('forumLocation', FILTER_SANITIZE_STRING),
									'parameter' => $this->request->getVar('forumParam', FILTER_SANITIZE_STRING),
									'start_posting' => $this->request->getVar('forumStart', FILTER_SANITIZE_STRING),
									'time' => $forumTime,
									'event_type' => $this->request->getVar('forumType', FILTER_SANITIZE_STRING),
									'forum_image' => $filename,
									'details' => $this->request->getVar('forumDetail', FILTER_SANITIZE_STRING),
									'submitted_name' => $user_name,
									'submitted_id' => $id,
									'status' => $status,
								];

						}//hasMoved
					}//isValid
					else {


						$var = [
						//fields                             input name
							'title' => $this->request->getVar('forumTitle', FILTER_SANITIZE_STRING),
							'dateFrom' => $this->request->getVar('forumFrom', FILTER_SANITIZE_STRING),
							'dateTo' => $this->request->getVar('forumTo', FILTER_SANITIZE_STRING),
							'location' => $this->request->getVar('forumLocation', FILTER_SANITIZE_STRING),
							'parameter' => $this->request->getVar('forumParam', FILTER_SANITIZE_STRING),
							'start_posting' => $this->request->getVar('forumStart', FILTER_SANITIZE_STRING),
							'time' => $forumTime,
							'event_type' => $this->request->getVar('forumType', FILTER_SANITIZE_STRING),
							'details' => $this->request->getVar('forumDetail', FILTER_SANITIZE_STRING),
							'submitted_name' => $user_name,
							'submitted_id' => $id,
							'status' => $status,
						];
					}

					if($this->forumModel->save($var)){
						$forumId = $this->forumModel->getForum($var['title']);

												$act = [
													'user_id' => $id,
													'task_name' => $task,
													'detail_id' => $forumId['id'],
												];

											  if($this->alModel->save($act)){
													session()->setTempdata('successForum', 'Forum added successfully', 2);
						              return redirect()->to(base_url()."/forum");
												}
				    }
            else{
							session()->setTempdata('errorForum', 'Forum is not added. Try again.', 2);
              return redirect()->to(base_url()."/forum/addForum");
            }


          }else {
            $data['validation'] = $this->validator;
          }
    }

    echo view('templates/user/header', $this->data);
    echo view('Modules\ForumManagement\Views\forumAddV', $data);
    echo view('templates/user/footer');
  }


	public function delete_forum($id = null){
		$task = "Delete Forum";
		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$uid = $name['id'];


			if($this->forumModel->deactivate($id)){
						$act = [
							'user_id' => $uid,
							'task_name' => $task,
							'detail_id' => $id,
						];
						if($this->alModel->save($act)){
							session()->setTempdata('successDeact', 'Forum deleted successfully', 2);
							return redirect()->to(base_url()."/forum");
						}

		 	}else{
		 		session()->setTempdata('errorDeact', 'Forum is not deleted. Please try again.', 2);
				return redirect()->to(base_url()."/forum");

	 	}

	}

	public function edit_forum($id = null){
		$task = "Edit Forum";
		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$uid = $name['id'];

		$data = [];
    $data['validation'] = null;

    if($this->request->getMethod() == 'post'){

				$rules = [
					'forumImage' => [
						'rules' => 'ext_in[forumImage,png,jpg,jpeg]',
						'errors' =>[
							'ext_in' => 'Invalid file extension. Use .png, .jpg, .jpeg.',
						],
					],
				];

				if($this->validate($rules)){

					$forumTime = date('h:i a', strtotime($this->request->getVar('forumTime', FILTER_SANITIZE_STRING)));
					$file = $this->request->getFile('forumImage');

					if($file->isValid() && !$file->hasMoved()){

						if($file->move(FCPATH.'public/forumImages', $file->getName())){
							$filename = $file->getName();

							$var = [
							//fields                             input name
								'title' => $this->request->getVar('forumTitle', FILTER_SANITIZE_STRING),
								'dateFrom' => $this->request->getVar('forumFrom', FILTER_SANITIZE_STRING),
								'dateTo' => $this->request->getVar('forumTo', FILTER_SANITIZE_STRING),
								'location' => $this->request->getVar('forumLocation', FILTER_SANITIZE_STRING),
								'parameter' => $this->request->getVar('forumParam', FILTER_SANITIZE_STRING),
								'start_posting' => $this->request->getVar('forumStart', FILTER_SANITIZE_STRING),
								'time' => $forumTime,
								'event_type' => $this->request->getVar('forumType', FILTER_SANITIZE_STRING),
								'forum_image' => $filename,
								'details' => $this->request->getVar('forumDetail', FILTER_SANITIZE_STRING),

							];

					}//hasMoved
				}//isValid
				 else {

					  $var = [
							'title' => $this->request->getVar('forumTitle', FILTER_SANITIZE_STRING),
							'dateFrom' => $this->request->getVar('forumFrom', FILTER_SANITIZE_STRING),
							'dateTo' => $this->request->getVar('forumTo', FILTER_SANITIZE_STRING),
							'location' => $this->request->getVar('forumLocation', FILTER_SANITIZE_STRING),
							'parameter' => $this->request->getVar('forumParam', FILTER_SANITIZE_STRING),
							'start_posting' => $this->request->getVar('forumStart', FILTER_SANITIZE_STRING),
							'time' => $forumTime,
							'event_type' => $this->request->getVar('forumType', FILTER_SANITIZE_STRING),
							'forum_image' => $this->request->getVar('forum_image', FILTER_SANITIZE_STRING),
							'details' => $this->request->getVar('forumDetail', FILTER_SANITIZE_STRING),

						];
				 }

						 if($this->forumModel->update($id, $var) ===  true){
								 $act = [
									 'user_id' => $uid,
									 'task_name' => $task,
									 'detail_id' => $id,
								 ];
								 if($this->alModel->save($act)){
									 session()->setTempdata('successForum', 'Forum updated successfully', 2);
									 return redirect()->to(base_url()."/forum/viewForum/".$id);
								 }

						 }
						else{
							session()->setTempdata('errorForum', 'Forum is not updated. Try again.', 2);
							return redirect()->to(base_url()."/forum/addForum");
						}


				}else {
					$data['validation'] = $this->validator;
				}
		}

		$data['forum'] = $this->forumModel->find($id);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ForumManagement\Views\forumEditV', $data);
    echo view('templates/user/footer');

	}

	public function view_forum($id = null){

		$data['forum'] = $this->forumModel->find($id);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ForumManagement\Views\forumView', $data);
    echo view('templates/user/footer');

	}

	public function view_forum_user($id = null){

		$data['forum'] = $this->forumModel->find($id);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ForumManagement\Views\forumUserV', $data);
    echo view('templates/user/footer');

	}

	public function toApprove_forum(){

		echo view('templates/user/header', $this->data);
		echo view('Modules\ForumManagement\Views\toApproveForum', $this->data);
		echo view('templates/user/footer');
	}

	public function post_forum($id){

		if($this->forumModel->post($id)){
			session()->setTempdata('successPost', 'Forum posted successfully', 2);
			return redirect()->to(base_url()."/forum");

		}else{
			session()->setTempdata('errorPost', 'Forum is not posted. Please try again.', 2);
			return redirect()->to(base_url()."/forum");

		}

	}

	public function unpost_forum($id){

		if($this->forumModel->unpost($id)){
			session()->setTempdata('successUnpost', 'Forum is unposted', 2);
			return redirect()->to(base_url()."/forum");

		}else{
			session()->setTempdata('errorUnpost', 'Forum is not unposted. Please try again.', 2);
			return redirect()->to(base_url()."/forum");

		}

	}

	public function admin_view_forum($id){

		$data['forum'] = $this->forumModel->find($id);

		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$id = $name['id'];

		$this->data['user'] = $this->userModel->find($id);

		echo view('templates/user/header', $this->data);
    echo view('Modules\ForumManagement\Views\adminForumView', $data);
    echo view('templates/user/footer');

	}

	public function admin_approve_forum($id){
		if($this->forumModel->approve($id)){
			session()->setTempdata('successPost', 'Forum approved successfully', 2);
			return redirect()->to(base_url()."/forum");

		}else{
			session()->setTempdata('errorPost', 'Forum is not approved. Please try again.', 2);
			return redirect()->to(base_url()."/forum");

		}

	}

	public function admin_disapprove_forum($id){

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

				if($this->forumModel->disapprove($id, $reason)){
					session()->setTempdata('disapproved','Forum is disapproved.', 3);
					return redirect()->to(base_url()."/forum");


				}else{
					session()->setTempdata('notDisapproved','Forum status is not disapproved.', 3);
					return redirect()->to(base_url()."/forum");


				}

			}
		}else{

			$this->data['validation'] = $this->validator;
		}


		// $data['panels'] = $this->prModel->getResearchPanelist($id);
		// $data1['authors'] = $this->srModel->getResearchAuthors($id);
		// $data2['research'] = $this->rModel->find($id);

		// $research = array_merge($data, $data1, $data2);

		// echo view('Modules\Admin\Views\templates\header');
		// echo view('Modules\Admin\Views\adminResearchV', $research, $this->data);
		// echo view('Modules\Admin\Views\templates\footer');

	}

	public function admin_edit_forum($id){
		$task = "Edit Forum";
		$uniid = session()->get('logged_user');
		$name = $this->userModel->getLoggedInUserRole($uniid);
		$uid = $name['id'];

				$data = [];
		    $data['validation'] = null;

		    if($this->request->getMethod() == 'post'){

						$rules = [
							'forumImage' => [
								'rules' => 'ext_in[forumImage,png,jpg,jpeg]',
								'errors' =>[
									'ext_in' => 'Invalid file extension. Use .png, .jpg, .jpeg.',
								],
							],
						];

						if($this->validate($rules)){

							$forumTime = date('h:i a', strtotime($this->request->getVar('forumTime', FILTER_SANITIZE_STRING)));
							$file = $this->request->getFile('forumImage');

							if($file->isValid() && !$file->hasMoved()){

								if($file->move(FCPATH.'public/forumImages', $file->getName())){
									$filename = $file->getName();

									$var = [
									//fields                             input name
										'title' => $this->request->getVar('forumTitle', FILTER_SANITIZE_STRING),
										'date' => $this->request->getVar('forumDate', FILTER_SANITIZE_STRING),
										'location' => $this->request->getVar('forumLocation', FILTER_SANITIZE_STRING),
										'parameter' => $this->request->getVar('forumParam', FILTER_SANITIZE_STRING),
										'start_posting' => $this->request->getVar('forumStart', FILTER_SANITIZE_STRING),
										'time' => $forumTime,
										'event_type' => $this->request->getVar('forumType', FILTER_SANITIZE_STRING),
										'forum_image' => $filename,
										'details' => $this->request->getVar('forumDetail', FILTER_SANITIZE_STRING),

									];

							}//hasMoved
						}//isValid
						 else {

							  $var = [
									'title' => $this->request->getVar('forumTitle', FILTER_SANITIZE_STRING),
									'date' => $this->request->getVar('forumDate', FILTER_SANITIZE_STRING),
									'location' => $this->request->getVar('forumLocation', FILTER_SANITIZE_STRING),
									'parameter' => $this->request->getVar('forumParam', FILTER_SANITIZE_STRING),
									'start_posting' => $this->request->getVar('forumStart', FILTER_SANITIZE_STRING),
									'time' => $forumTime,
									'event_type' => $this->request->getVar('forumType', FILTER_SANITIZE_STRING),
									'forum_image' => $this->request->getVar('forum_image', FILTER_SANITIZE_STRING),
									'details' => $this->request->getVar('forumDetail', FILTER_SANITIZE_STRING),

								];
						 }

						 		if($this->forumModel->update($id, $var) ===  true){
										 $act = [
											 'user_id' => $uid,
											 'task_name' => $task,
											 'detail_id' => $id,
										 ];
										 if($this->alModel->save($act)){
											 session()->setTempdata('successForum', 'Forum updated successfully', 2);
											 return redirect()->to(base_url()."/forum/adminViewForum/".$id);
										 }
								}
								else{
									session()->setTempdata('errorForum', 'Forum is not updated. Try again.', 2);
									return redirect()->to(base_url()."/forum/adminViewForum/".$id);
								}


						}else {
							$data['validation'] = $this->validator;
						}

				}

				$data['forum'] = $this->forumModel->find($id);

				echo view('templates/user/header', $this->data);
		    echo view('Modules\ForumManagement\Views\adminForumEdit', $data);
		    echo view('templates/user/footer');
}

	public function submit_again($id = null){

				if($this->forumModel->updateForumStatus($id)){

						session()->setTempdata('submit','Forum successfully submitted.', 3);
						return redirect()->to(base_url()."/forum/viewForum/".$id);
				}else {

						session()->setTempdata('errorSubmit','Forum is not submitted. Try again.', 3);
						return redirect()->to(base_url()."/forum/viewForum/".$id);
				}

	}

}
