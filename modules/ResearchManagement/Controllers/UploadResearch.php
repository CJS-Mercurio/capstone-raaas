<?php

namespace Modules\ResearchManagement\Controllers;

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

use Modules\SuperAdmin\Models\UserModel;
use Modules\SuperAdmin\Models\TaskModel;
use Modules\SuperAdmin\Models\DocumentCourseModel;
use Modules\SuperAdmin\Models\StudentsModel;
use Modules\SuperAdmin\Models\ProfessorsModel;
use Modules\SuperAdmin\Models\CourseScheduleModel;
use Modules\SuperAdmin\Models\CategoryModel;

use Modules\ResearchManagement\Models\UserResearchModel;
use Modules\ResearchManagement\Models\UserFavoriteModel;

use Modules\ProfileManagement\Models\ActivityLogModel;

use Modules\Professor\Models\ProfessorResearchModel;


class UploadResearch extends BaseController{

  public $data = [], $role;

	public function __construct(){
		$this->session = \Config\Services::session();

    $this->csModel = new CourseScheduleModel();
    $this->data['course_sched'] = $this->csModel->getSchedule();

    $this->studentModel = new StudentsModel();
    $this->professorModel = new ProfessorsModel();

    $this->acModel = new AdminConfigModel();
    $this->data['ad_config'] = $this->acModel->findAll();

    $sy_cd =  $this->acModel->getsy_cd();
    $this->rModel =  new ResearchModel();
    $this->data['research'] = $this->rModel->getLatestResearch($sy_cd['archive_year']);

		// $this->sModel =  new StudentModel();
	 	// $this->data['author'] = $this->sModel->orderBy('id', 'DESC')->findAll();

		$this->courseModel =  new CourseModel();
	 	$this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

    $this->fModel =  new FacultyModel();
	 	$this->data['faculty'] = $this->fModel->orderBy('id', 'DESC')->findAll();

	 	$this->panelModel =  new PanelModel();
	 	$this->data['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();

		$this->scModel =  new StudentCourseModel();
	 	$this->data['student_course'] = $this->scModel->findAll();

    $this->docTypeModel = new DocumentTypeModel();
	 	$this->data['type'] = $this->docTypeModel->findAll();

		$this->srModel =  new StudentResearchModel();
	 	$this->data['student_research'] = $this->srModel->findAll();

    $this->userModel = new UserModel();
    $this->data['user'] = $this->userModel->findAll();

    $this->urModel = new UserResearchModel();
    $this->data['user_research'] = $this->urModel->findAll();

    $this->categoryModel = new CategoryModel();
    $this->data['category'] = $this->categoryModel->findAll();

		$this->fileUploading =  new FileUploading();
		$this->prModel =  new PanelResearchModel();
    $this->prModel =  new PanelResearchModel();
    $this->rpModel =  new ProfessorResearchModel();
    $this->cdModel =  new DocumentCourseModel();
    $this->ufModel =  new UserFavoriteModel();

    $this->alModel =  new ActivityLogModel();
    helper(['form']);
		helper(['text']);

    $uniid = session()->get('logged_user');
    $this->role = $this->userModel->getLoggedInUserRole($uniid);
    $this->data['loggedIn'] = $this->userModel->getLoggedInUserRole($uniid);
    $this->data['allowed_task']= $this->userModel->getUserPermission($this->role['role_id']);
     $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 
	}


	public function index(){

		// print_r($this->data['allowed_task']);
    $user = $this->userModel->getUserId(session()->get('logged_user'));
    $data['user_research'] = $this->urModel->getResearchDetails($user['id']);

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\UploadedResearchV', $data);
    echo view('templates/user/footer');

	}

  public function privacy_policy(){
    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\TermsAndCondition');
    echo view('templates/user/footer');

  }

  public function upload_research(){
    $task = "Upload Document";
    $this->data['validation'] = null;

    $uniid = session()->get('logged_user');
    $user = $this->userModel->getLoggedInUserRole($uniid);
    $uid = $user['id'];

    // if($user['role_id'] == 2){
    //   $this->data['author'] = $this->studentModel->findAll();
    // }elseif ($user['role_id'] == 3) {
    //   $this->data['author'] = $this->professorModel->findAll();
    // }else {
    // $this->data['author'] = null;
    // }

    $this->data['author'] = $this->userModel->findAll();


    if($this->request->getMethod() == 'post'){

      $rules = [

        'title' => [
          'rules' => 'required|is_unique[document.title]',
          'errors' =>[
            'required' => 'Title is required',
            'is_unique' => 'Research Title already in the Database',
          ],
        ],


        'paper_type' => [
        				'rules' => 'required',
        				'errors' =>[
        						'required' => 'Document type required',

        					],
        ],

        'abstract' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Abstract is required',
          ],
        ],

        'keyword' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Keyword is required',
          ],
        ],

        'category' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Category is required',
          ],
        ],

        'course' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Course is required',
          ],
        ],

        'selectedAuthors' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Authors is required',
          ],
        ],

        'date_submitted' => [
          'rules' => 'required|regex_match[^(19|20)\d\d[-.](0[1-9]|1[012])[-.](0[1-9]|[12][0-9]|3[01])$]',
          'errors' => [
            'required' => 'Date submitted is required',
            'regex_match' => 'Date submitted field format is incorrect',
            // 'is_unique' => 'Student number already exist',
          ],
        ],

        'uploadFile' => [
          'rules' => 'uploaded[uploadFile]|ext_in[uploadFile,wpd,pdf]',
          'errors' =>[
            'uploaded' => 'Upload a file (.wpd, .pdf).',
            'ext_in' => 'Invalid file extension. Try again.',
          ],
        ],

        'uploadFull' => [
          'rules' => 'ext_in[uploadFile,wpd,pdf]',
          'errors' =>[
            'ext_in' => 'Invalid file extension. Try again.',
          ],
        ],

      ];

      $abstract = $this->request->getVar('abstract', FILTER_SANITIZE_STRING);
      $keywords = $this->request->getVar('keyword', FILTER_SANITIZE_STRING);

      $count = str_word_count($abstract);
      $count1 = str_word_count($keywords);

      if($this->validate($rules)){

        $sy_cd =  $this->acModel->getsy_cd();

        if($count >= 300 && $count <= 350){

          if($count1 >= 5){

            $file = $this->request->getFile('uploadFile');
            $full = $this->request->getFile('uploadFull');

          if($file->isValid() && !$file->hasMoved()){

            if($file->move(FCPATH.'public/researches', $file->getName())){
              $filename = $file->getName();

                if($full->isValid() && !$full->hasMoved()){
                  if($full->move(FCPATH.'public/fullpaper', $full->getName())){
                    $fullpaper = $full->getName();

                    // $categ = $this->request->getVar('category', FILTER_SANITIZE_STRING);
                    // if($categ){
                    //   $category = $categ;
                    // }else{
                    //   $category = 0;
                    // }

                    $slugs = random_string('alnum', 12);
                    $this->data = [
                        'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                        'document_type_id' => $this->request->getVar('paper_type'),
                        'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
                        'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
                        'category_id' => $this->request->getVar('category'),
                        'school_year' => $sy_cd['school_year'],
                        'director' => $sy_cd['current_director'],
                        'file' => $filename,
                        'full_paper' => $fullpaper,
                        'adviser' => $this->request->getVar('adviser'),
                        'research_status' => 1,
                        'privacy' => 2,
                        'defense_date' => $this->request->getVar('defense_date'),
                        'date_submitted' => $this->request->getVar('date_submitted'),
                        'course_id' => $this->request->getVar('course'),
                        'slugs' => $slugs
                      ];
                  }
                }else{
                  $slugs = random_string('alnum', 12);
                  $this->data = [
                      'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                      'document_type_id' => $this->request->getVar('paper_type'),
                      'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
                      'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
                      'category_id' => $this->request->getVar('category'),
                      'school_year' => $sy_cd['school_year'],
                      'director' => $sy_cd['current_director'],
                      'file' => $filename,
                      'adviser' => $this->request->getVar('adviser'),
                      'research_status' => 1,
                      'privacy' => 2,
                      'defense_date' => $this->request->getVar('defense_date'),
                      'date_submitted' => $this->request->getVar('date_submitted'),
                      'course_id' => $this->request->getVar('course'),
                      'slugs' => $slugs
                    ];
                }

              }//fcpath

              else{
                $this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
              }

            }//isValid hasMoved
            //get the author's id

            $selectedAuthors = $this->request->getVar('selectedAuthors');
            $selectedPanelist = $this->request->getVar('selectedPanelist');
            $title = $this->data['title'];

            if($this->rModel->save($this->data)){

              $research_id = $this->rModel->getResearchId($title);
              $data = [
                  'course_id' => $this->request->getVar('course'),
                  'document_id' => $research_id['id'],

              ];
              //
              // print_r($data);
              // die();

              if($this->cdModel->save($data)){

                  foreach ($selectedAuthors as $author){

                    $author_research_data = [
                      'document_id' =>$research_id['id'],
                      'author_id' => $author,
                    ];

                      $this->urModel->createUserResearch($author_research_data);
                  }

                  if($selectedPanelist){
                    foreach ($selectedPanelist as $panel){
                            $research_panel_data = [
                              'research_id' =>$research_id['id'],
                              'panel_id' => $panel,
                            ];

                                $this->prModel->createResearchPanelist($research_panel_data);
                    }
                  }
              }//end of saving course
              
                 $act = [
                  'user_id' => $uid,
                  'task_name' => $task,
                  'detail_id' => $research_id['slugs'],

                ];
                if($this->alModel->save($act)){
                  $this->session->setTempdata('success','Research created successfully.', 3);
             
                  return redirect()->to(base_url('/research'));
                }
             

            }else{

                $this->session->setTempdata('error','Sorry! Unable to upload research. Try again', 3);
                return redirect()->to(base_url('/research'));
               }
          }//count1
          else{
            $this->session->setTempdata('errorKey','Minimum number of keywords must be 5', 3);

          }
        }//count
        else{
          $this->session->setTempdata('errorAbs','Minimum word for Abstract is 300. Maximum is 350', 3);

        }
      }else{
        $this->data['validation'] = $this->validator;
      }

    }

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\UploadResearchV', $this->data);
    echo view('templates/user/footer');

  }

  public function view_research($id){

    $this->data['validation'] = null;

    $data['panels'] = $this->prModel->getResearchPanelist($id);
    $data1['author'] = $this->urModel->getResearchAuthors($id);
    $data2['research'] = $this->rModel->getResearch($id);

    $research = array_merge($data, $data1, $data2);

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\UserResearchV', $research);
    echo view('templates/user/footer');
  }

  function view_research_home($id = null){

    $uniid = session()->get('logged_user');
    $uid = $this->userModel->getLoggedInUserRole($uniid);

    $view = $this->rModel->find($id);

    $count = $view['views'] + 1;

    $this->rModel->addCountView($id, $count);

    $data['panels'] = $this->prModel->getResearchPanelist($id);
    $data4['author'] = $this->urModel->getResearchAuthors($id);
    $data3['research'] = $this->rModel->getResearch($id);


    $data2['favorite'] = $this->ufModel->check_favorite($id, $uid['id']);

    $research = array_merge($data, $data3, $data4, $data2);

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\ResearchV', $research);
    echo view('templates/user/footer');

  }

  public function get_student_research(){

    $this->data['stud_research'] = $this->srModel->getResearchOfStudent();

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\sResearchListV', $this->data);
    echo view('templates/user/footer');

  }

  public function get_professor_research(){

    $this->data['prof_research'] = $this->rpModel->getResearchOfProf();

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\pResearchListV', $this->data);
    echo view('templates/user/footer');

  }

  public function choose_document_type(){

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\chooseDocumentTypeV', $this->data);
    echo view('templates/user/footer');
  }

  public function admin_submit_again($id=null){

    if($this->rModel->updateDocumentStatus($id, 2)){

        session()->setTempdata('submit','Research successfully submitted.', 3);
        return redirect()->to(base_url()."/research/viewResearch/".$id);
    }else {

        session()->setTempdata('errorSubmit','Research is not submitted. Try again.', 3);
        return redirect()->to(base_url()."/research/viewResearch/".$id);
    }

  }

  public function adviser_submit_again($id=null){

    if($this->rModel->updateDocumentStatus($id, 4)){

        session()->setTempdata('submit','Research successfully submitted.', 3);
        return redirect()->to(base_url()."/research/viewResearch/".$id);
    }else {

        session()->setTempdata('errorSubmit','Research is not submitted. Try again.', 3);
        return redirect()->to(base_url()."/research/viewResearch/".$id);
    }

  }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function edit_research($id = null){
    $task = "Edit Document";
    $this->data['validation'] = null;

    $uniid = session()->get('logged_user');
    $user = $this->userModel->getLoggedInUserRole($uniid);
    $uid = $user['id'];
    $research = $this->rModel->find($id);

    // if($user['role_id'] == 2){
    //   $data5['author'] = $this->studentModel->findAll();
    // }elseif ($user['role_id'] == 3) {
    //   $data5['author'] = $this->professorModel->findAll();
    // }else {
    //   $data5['author'] = null;
    // }
    $data5['author'] = $this->userModel->findAll();

    $rules = [

      'uploadFile' => [
          'rules' => 'ext_in[uploadFile,pdf]',
          'errors' =>[
            'ext_in' => 'Invalid file extension. Try again.',
          ],
        ],

        'uploadFull' => [
            'rules' => 'ext_in[uploadFull,pdf]',
            'errors' =>[
              'ext_in' => 'Invalid file extension. Try again.',
            ],
          ],
    ];


     $data1['authors'] = $this->srModel->getResearchAuthors($id);
     $data2['research'] = $this->rModel->find($id);
     $data3['panel'] = $this->panelModel->orderBy('id', 'DESC')->findAll();
     $data4['adviser'] = $this->fModel->orderBy('id', 'DESC')->findAll();
 	 	 $data6['type'] = $this->docTypeModel->findAll();
     $data7['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();
     $data8['category'] = $this->categoryModel->orderBy('id', 'DESC')->findAll();


     if($this->request->getMethod() == 'post'){

          if($this->validate($rules)){

               $file = $this->request->getFile('uploadFile');
               $full = $this->request->getFile('uploadFull');

               if($file->isValid() && !$file->hasMoved()){
                 if($file->move(FCPATH.'public/researches', $file->getName())){

                   $path = base_url().'/public/researches/' .$file->getName();
                   $filename = $file->getName();

                   $status = $this->rModel->updateFile($filename, $id);

                   if($status == true){

                     $this->session->setTempdata('tama','Research updated successfully.', 3);
                     return redirect()->to(base_url()."/research/viewResearch/".$id);
                   }//status
                   else{

                     $this->session->setTempdata('mali','File not uploaded. Try again.', 3);
                     return redirect()->to(base_url()."/research/editResearch/".$id);

                   }
                 }//fcpath
                 else{

                   $this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
                   return redirect()->to(base_url()."/research/editResearch/".$id);
                 }
               }//isValid

               /////////////////full paper
            if($full->isValid() && !$full->hasMoved()){
              if($full->move(FCPATH.'public/fullpaper', $full->getName())){

                $path = base_url().'/public/fullpaper/' .$full->getName();
                $fullpaper = $full->getName();

                $status1 = $this->rModel->updateFull($fullpaper, $id);
                if($status1 == true){
                  $this->session->setTempdata('tama','Research updated successfully.', 3);
                  return redirect()->to(base_url()."/research/viewResearch/".$id);
                }//status
                else{

                  $this->session->setTempdata('mali','File not uploaded. Try again.', 3);
                  return redirect()->to(base_url()."/research/editResearch/".$id);
                }
              }//fcpath
              else{

                $this->session->setTempdata('mali', 'You have uploaded an invalid file', 3);
                return redirect()->to(base_url()."/research/editResearch/".$id);
              }
            }//isValid

          }else{
            $file = $this->request->getFile('uploadFile');
            $full = $this->request->getFile('uploadFull');

             if(!empty($file)){
               $this->session->setTempdata('mali', 'You have uploaded an invalid file. Try again.', 3);
               return redirect()->to(base_url()."/research/editResearch/".$id);
             }

             if(!empty($full)){
               $this->session->setTempdata('mali', 'You have uploaded an invalid file. Try again.', 3);
               return redirect()->to(base_url()."/research/editResearch/".$id);
             }

        }


          $count = str_word_count($this->request->getVar('abstract', FILTER_SANITIZE_STRING));
          $count1 = str_word_count($this->request->getVar('keyword', FILTER_SANITIZE_STRING));

          if($count >= 300 && $count <= 350){
                if($count1 >= 5){

                }else{
                  $this->session->setTempdata('errorKey','Minimum number of keywords must be 5', 3);
                  return redirect()->to(base_url()."/research/editResearch/".$id);
                }
          }//count
          else{
            $this->session->setTempdata('errorAbs','Minimum word for Abstract is 300. Maximum is 350', 3);
            return redirect()->to(base_url()."/research/editResearch/".$id);

          }

          $newdata = [
              'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
              'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
              'keywords' => $this->request->getVar('keyword', FILTER_SANITIZE_STRING),
              'document_type_id' => $this->request->getVar('paper_type'),
              'adviser' => $this->request->getVar('adviser'),
              'course_id' => $this->request->getVar('course'),
              'defense_date' => $this->request->getVar('defense_date'),
              'date_submitted' => $this->request->getVar('date_submitted'),
              'category_id' => $this->request->getVar('category'),

          ];

            $selectedAuthors = $this->request->getVar('selectedAuthors');
            $selectedPanelist = $this->request->getVar('selectedPanelist');
            $file = $this->request->getFile('uploadFile');

            if($this->rModel->update($id, $newdata) ===  true){
                if(!empty($selectedAuthors)){
                     if($this->srModel->deleteStudentResearch($id)){
                      foreach ($selectedAuthors as $author){
                        $research_data = [
                          'document_id' =>$id,
                          'author_id' => $author,
                        ];

                            $this->srModel->createAuthorResearch($research_data);
                            // if($this->srModel->createAuthorResearch($research_data)){
                            //
                            // echo "tama";
                            // die();
                            //
                            // }else{
                            // 	echo "mali";
                            //   die();
                            // }
                       }
                     }
                 }

                 if(!empty($selectedPanelist)){
                            if($this->prModel->deleteResearchPanelist($id)){
                               foreach ($selectedPanelist as $panel){
                                      $research_panel_data = [
                                      'research_id' =>$id,
                                      'panel_id' => $panel,
                                ];
                                 $this->prModel->createResearchPanelist($research_panel_data);
                                }
                            }else{
                               foreach ($selectedPanelist as $panel){
                                      $research_panel_data = [
                                      'research_id' =>$id,
                                      'panel_id' => $panel,
                                ];
                                 $this->prModel->createResearchPanelist($research_panel_data);
                                } 
                            }
                  }

                  $act = [
                    'user_id' => $uid,
                    'task_name' => $task,
                    'detail_id' =>  $research['slugs'],
                  ];
                  
                  if($this->alModel->save($act)){

                    session()->setTempdata('success','Research updated successfully.', 3);
                    return redirect()->to(base_url()."/research/viewResearch/".$id);
                  }
                 
            }//rModel
            else{
                session()->setTempdata('error','Research not updated. Try again.', 3);
            }

      }//post
    $research = array_merge($data5, $data1, $data2, $data3, $data4, $data6,  $data7, $data8);

    echo view('templates/user/header', $this->data);
    echo view('Modules\ResearchManagement\Views\Uploading\editResearchV',  $research);
    echo view('templates/user/footer');


  }

  public function delete_research($id = null){
    $task = "Delete Document";
    $uniid = session()->get('logged_user');
    $user = $this->userModel->getLoggedInUserRole($uniid);
    $uid = $user['id'];
    $research = $this->rModel->find($id);

    if($this->rModel->updateDeleteStatus($id)){
      $act = [
        'user_id' => $uid,
        'task_name' => $task,
        'detail_id' => $research['slugs'],
      ];
      if($this->alModel->save($act)){
        session()->setTempdata('successDelete', 'Document deleted successfully', 2);
        return redirect()->to(base_url()."/research");
      }

    }else{
      session()->setTempdata('errorDelete', 'Document is not deleted. Please try again.', 2);
      return redirect()->to(base_url()."/research");

    }

  }

  public function download_research($file){

    helper(['download']);
    $name = $file;
    $research = $this->rModel->find($name);

    $file = 'public/researches/'. $research['file'];

    // echo $file;
    // die();

    $pdfFile = $file;
    $watermarkText = "RAAS";
    $pdf = new Watermark($pdfFile, $watermarkText);
    //$pdf = new FPDI();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);


    /*$txt = "FPDF is a PHP class which allows to generate PDF files with pure PHP, that is to say " .
            "without using the PDFlib library. F from FPDF stands for Free: you may use it for any " .
            "kind of usage and modify it to suit your needs.\n\n";
    for ($i = 0; $i < 25; $i++) {
        $pdf->MultiCell(0, 5, $txt, 0, 'J');
    }*/


    if($pdf->numPages>1) {
        for($i=2;$i<=$pdf->numPages;$i++) {
            //$pdf->endPage();
            $pdf->_tplIdx = $pdf->importPage($i);
            $pdf->AddPage();
        }
    }

    $pdf->Output(); //If you Leave blank then it should take default "I" i.e. Browser



  }

//  Citation 
  public function download_citation($id = null){

    $cite = $this->rModel->find($id);
    $count = $cite['downloads'] + 1;

    $author = $this->urModel->getResearchAuthors($id);

          //////////////////////////////////apa
          if($author){
              foreach($author as $a){
                $initial = '';
                $first_name = explode(" ", $a['first_name']);
                foreach($first_name as $fn){
                  $initial .= ucwords($fn[0]) . ".";
                }
                $name .= " ". ucwords($a['last_name']) . ", " . $initial;
              }
              $apa = $name. " (" . date("Y", strtotime ($cite['date_submitted'])) . ")" . ". " . $cite['title'];
            }else{
              $apa = "None";
          }
          /////////////////////////////////MLA
          if($author){
            foreach($author as $a){
              $name1 .= ucwords($a['last_name']. ", ".  $a['first_name']) . ". ";
            }
            $mla = $name1. " ". $cite['title'] . ". " . date("Y", strtotime ($cite['date_submitted']));
          }else{
            $mla = "None";
          }

          ////////////////////////////////chicago
          if($author){
            foreach($author as $a){
              $name2 .= ucwords($a['last_name']. ", ".  $a['first_name']). " ";
            }
            $chicago = $name2. " ". $cite['title'] . ". " . date("Y", strtotime ($cite['date_submitted']));
          }else {
            $chicago = "None";
          }

          //////////////////////////////ASA
          if($author){
            foreach($author as $a){
              $name3 .= ucwords($a['last_name']. ", ".  $a['first_name']) . ". ";
            }
            $asa = $name3. " ". date("Y", strtotime ($cite['date_submitted'])) . ". " . $cite['title'];
          }else{
            $asa = "None";
          }

          $n = '\n';
          ////////////////////////////////downloading file
          $namefile = $cite['title']. ".txt";
          $content = $cite['abstract']. "\n\nAPA\n"
          .$apa. "\n"
          ."\nMLA\n"
          .$mla. "\n"
          ."\nChicago\n"
          .$chicago. "\n"
          ."\nASA\n"
          .$asa. "\n";

          //save file
          $file = fopen($namefile, "w") or die("Unable to open file!");
          fwrite($file, $content);
          fclose($file);

          //header download
          header("Content-Disposition: attachment; filename=\"" . $namefile . "\"");
          header("Content-Type: application/force-download");
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header("Content-Type: text/plain");

          echo $content;

  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  public function add_panelist(){

    $this->data['validation'] = null;

		if($this->request->getMethod() == 'post'){
				$rules = [

				'firstname' => [
					'rules' => 'required|min_length[3]',
					'errors' =>[
						'required' => 'Firstname is required',
						'min_length' => 'Firstname should atleast have {param} characters',

					],
				],


				'lastname' => [
					'rules' => 'required|min_length[2]',
					'errors' =>[
						'required' => 'Abstract is required',
						'min_length' => 'Lastname should atleast have {param} characters',
					],
				],


			];


				if($this->validate($rules)){
					$panelData = [
						'first_name' => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
						'last_name' => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
						'occupation' => $this->request->getVar('occupation', FILTER_SANITIZE_STRING),
						'company' => $this->request->getVar('company', FILTER_SANITIZE_STRING),

					];

					if($this->panelModel->save($panelData) === true) {
						session()->setTempdata('successPanel', 'Panel added successfully', 2);
						return redirect()->to(base_url('/research/upload'));

					}
					else{
						session()->setTempdata('errorPanel', 'Panel is not added. Try again.', 2);
            return redirect()->to(base_url('/research/upload'));
					}

				}//validation
				else{
					  $this->data['validation'] = $this->validator;
					}
			}//post

      return redirect()->to(base_url('/research/upload'));

  }

  public function edit_add_panel($id = null){

    $this->data['validation'] = null;

    if($this->request->getMethod() == 'post'){
        $rules = [

        'firstname' => [
          'rules' => 'required|min_length[3]',
          'errors' =>[
            'required' => 'Firstname is required',
            'min_length' => 'Firstname should atleast have {param} characters',

          ],
        ],


        'lastname' => [
          'rules' => 'required|min_length[2]',
          'errors' =>[
            'required' => 'Lastname is required',
            'min_length' => 'Lastname should atleast have {param} characters',
          ],
        ],


      ];


        if($this->validate($rules)){
          $panelData = [
            'first_name' => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
            'last_name' => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
            'occupation' => $this->request->getVar('occupation', FILTER_SANITIZE_STRING),
            'company' => $this->request->getVar('company', FILTER_SANITIZE_STRING),

          ];

          if($this->panelModel->save($panelData) === true) {
            session()->setTempdata('successPanel', 'Panel added successfully', 2);
            return redirect()->to(base_url('/research/editResearch/'.$id));

          }
          else{
            session()->setTempdata('errorPanel', 'Panel is not added. Try again.', 2);
            return redirect()->to(base_url('/research/editResearch/'.$id));
          }

        }//validation
        else{
            $this->data['validation'] = $this->validator;
          }
      }//post

      return redirect()->to(base_url('/research/editResearch/'.$id));


  }

  ///////////////////////////////////////////////////////////////////////////////////
  public function add_author(){

    $this->data['validation'] = null;

    if($this->request->getMethod() == 'post'){
        $rules = [

        'firstname' => [
          'rules' => 'required|min_length[3]',
          'errors' =>[
            'required' => 'Firstname is required',
            'min_length' => 'Firstname should atleast have {param} characters',

          ],
        ],


        'lastname' => [
          'rules' => 'required|min_length[2]',
          'errors' =>[
            'required' => 'Lastname is required',
            'min_length' => 'Lastname should atleast have {param} characters',
          ],
        ],


      ];


        if($this->validate($rules)){
          $data = [
            'first_name' => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
            'middle_name' => $this->request->getVar('middlename', FILTER_SANITIZE_STRING),
            'last_name' => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
          ];

          if($this->userModel->save($data) === true) {
            session()->setTempdata('successAuthor', 'Author added successfully', 2);
            return redirect()->to(base_url('/research/upload'));

          }
          else{
            session()->setTempdata('errorAuthor', 'Author is not added. Try again.', 2);
            return redirect()->to(base_url('/research/upload'));
          }

        }//validation
        else{
            $this->data['validation'] = $this->validator;
          }
      }//post

      return redirect()->to(base_url('/research/upload'));
  }

  public function edit_add_author($id = null){

    $this->data['validation'] = null;

    if($this->request->getMethod() == 'post'){
        $rules = [

        'firstname' => [
          'rules' => 'required|min_length[3]',
          'errors' =>[
            'required' => 'Firstname is required',
            'min_length' => 'Firstname should atleast have {param} characters',

          ],
        ],


        'lastname' => [
          'rules' => 'required|min_length[2]',
          'errors' =>[
            'required' => 'Lastname is required',
            'min_length' => 'Lastname should atleast have {param} characters',
          ],
        ],


      ];


        if($this->validate($rules)){
          $data = [
            'first_name' => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
            'middle_name' => $this->request->getVar('middlename', FILTER_SANITIZE_STRING),
            'last_name' => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),

          ];

          if($this->userModel->save($data) === true) {
            session()->setTempdata('successAuthor', 'Author added successfully', 2);
            return redirect()->to(base_url('/research/editResearch/'.$id));

          }
          else{
            session()->setTempdata('errorAuthor', 'Author is not added. Try again.', 2);
            return redirect()->to(base_url('/research/editResearch/'.$id));
          }
        }//validation
        else{
            $this->data['validation'] = $this->validator;
          }
      }//post
      return redirect()->to(base_url('/research/editResearch/'.$id));

  }

  //////////////////////////////////////////////////////////////////////////////////
  public function upload_copyright($id = null){
    $rules = [

      'uploadCert' => [
        'rules' => 'uploaded[uploadCert]|ext_in[uploadCert,jpg,jpeg,png]',
        'errors' =>[
          'uploaded' => 'Upload a file (.jpg, .png, .jpeg).',
          'ext_in' => 'Invalid file extension. Try again.',
        ],
      ],
  ];

   if($this->request->getMethod() == 'post'){
        if($this->validate($rules)){

                $file = $this->request->getFile('uploadCert');
                if($file->isValid() && !$file->hasMoved()){
                  if($file->move(FCPATH.'public/copyright', $file->getName())){

                    $filename = $file->getName();
                    $newdata = [
                        'copyright' => $filename,
                        'privacy' => 1,
                    ];

                      if($this->rModel->update($id, $newdata) ===  true){
                          $this->session->setTempdata('tama','Copyright certificate uploaded successfully.', 3);
                          return redirect()->to(base_url()."/research/viewResearchHome/".$id);
                        }//status
                        else{
                          $this->session->setTempdata('mali','File not uploaded. Try again.', 3);
                          return redirect()->to(base_url()."/research/viewResearchHome/".$id);

                        }
                  }//move
                }//valid
        }
    }
    $this->session->setTempdata('mali','No file uploaded. Try again.', 3);
    return redirect()->to(base_url()."/research/viewResearchHome/".$id);
  }

  public function update_copyright($id=null){
  $rules = [

      'uploadCert' => [
        'rules' => 'uploaded[uploadCert]|ext_in[uploadCert,jpg,jpeg,png]',
        'errors' =>[
          'uploaded' => 'Upload a file (.jpg, .png, .jpeg).',
          'ext_in' => 'Invalid file extension. Try again.',
        ],
      ],
  ];

   if($this->request->getMethod() == 'post'){
        if($this->validate($rules)){

                $file = $this->request->getFile('uploadCert');
                if($file->isValid() && !$file->hasMoved()){
                  if($file->move(FCPATH.'public/copyright', $file->getName())){

                    $filename = $file->getName();
                    $newdata = [
                        'copyright' => $filename,
                    ];

                      if($this->rModel->update($id, $newdata) ===  true){
                          $this->session->setTempdata('tama','Copyright certificate updated successfully.', 3);
                          return redirect()->to(base_url()."/research/viewResearchHome/".$id);
                        }//status
                        else{
                          $this->session->setTempdata('mali','File not uploaded. Try again.', 3);
                          return redirect()->to(base_url()."/research/viewResearchHome/".$id);

                        }
                  }//move
                }//valid
        }
    }
    $this->session->setTempdata('mali','No file uploaded. Try again.', 3);
    return redirect()->to(base_url()."/research/viewResearchHome/".$id);

}

public function remove_certificate($id=null){

          $newdata = [
             'copyright' => null,
             'privacy' => 2,
          ];

          if($this->rModel->update($id, $newdata) ===  true){
             $this->session->setTempdata('tama','Copyright certificate removed successfully.', 3);
             return redirect()->to(base_url()."/research/viewResearchHome/".$id);
           }//status
           else{
             $this->session->setTempdata('mali','Copyright certificate is not removed. Try again.', 3);
             return redirect()->to(base_url()."/research/viewResearchHome/".$id);
           }

    }

}//end class
