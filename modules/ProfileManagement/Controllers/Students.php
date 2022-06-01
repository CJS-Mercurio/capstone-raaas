<?php
namespace Modules\ProfileManagement\Controllers;

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
use Modules\SuperAdmin\Models\StudentsModel;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Students extends BaseController
{

  public function __construct(){
    
      $this->session = \Config\Services::session();
      
			$this->data['validation'] = null;

			helper("form");
			helper('date');

      $this->studentModel = new StudentsModel();
      $this->data['students'] = $this->studentModel->getDetail();
      $this->courseModel = new CourseModel();
      $this->data['courses'] = $this->courseModel->orderBy('id', 'DESC')->findAll();
      $this->academicStatusModel = new AcademicStatusModel();
      $this->data['academic_status'] = $this->academicStatusModel->orderBy('id', 'DESC')->findAll();
      $this->genderModel = new GenderModel();
      $this->data['genders'] = $this->genderModel->orderBy('id', 'DESC')->findAll();

      $this->userModel = new UserModel();

      $uniid = session()->get('logged_user');
      $role = $this->userModel->getLoggedInUserRole($uniid);

      $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);
      $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 

    }

    public function index()
    {
        // $this->data['view'] = 'Modules\SuperAdmin\Views\students\index';
        // $this->data['view'] = 'Modules\SuperAdmin\Views\templates\header';
        // return view('template/index', $this->data);
        echo view('templates/user/header', $this->data);
        echo view('Modules\ProfileManagement\Views\students\index', $this->data);
        echo view('templates/user/footer');

    }

    public function add()
    {

      $this->data['validation'] = null;

  		$rules = [

  			'student_number' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'required',
  					],
  				],
  			'email' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'required',
  					],
  				],
  			'firstname' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'required',
  					],
  				],
  			'lastname' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'required',
  					],
  				],
          'course_id' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],
          'birthdate' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],
          'academic_status' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],
          'contact' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],
  		];

        // $this->data['courses'] = $this->courseModel->get();
        // $this->data['academic_status'] = $this->academicStatusModel->get();
        $this->data['edit'] = false;
        $this->data['view'] = 'Modules\ProfileManagement\Views\students\form';
				if($this->request->getMethod() == 'post')
				{
					if($this->validate($rules))
					{
						if($this->studentModel->insertStudent($_POST))
						{
							$this->session->setTempdata('successAct', 'Student added successfully', 2);
							return redirect()->to(base_url('profile/professors'));
						}
						else
						{
							die('Something Went Wrong!');
						}
					}
					else
					{

							$this->data['validation'] = $this->validator;
					}
				}

        echo view('templates/user/header', $this->data);
        echo view('Modules\ProfileManagement\Views\students\form', $this->data);
        echo view('templates/user/footer');

    }

    public function insertSpreadsheet()
    {
      $this->data['validation'] = null;

      $rules = [

        'students' => [
          'rules' => 'uploaded[students]|ext_in[students,xlsx]',
          'errors' =>[
            'uploaded' => 'Upload a file (.xlsx).',
            'ext_in' => 'Invalid file extension. Try again.',
            ],
          ],
          'course_id' => [
              'rules' => 'required',
              'errors' =>[
                'required' => 'required',
              ],
            ],
          'academic_status' => [
              'rules' => 'required',
              'errors' =>[
                'required' => 'required',
              ],
            ],

      ];

        if ($this->validate($rules)) {
          $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->request->getFile('students'));
          $xlsx = new Xlsx($spreadsheet);
          $array = $spreadsheet->getActiveSheet()->toArray();

          $data = [];
          foreach($array as $key => $value)
          {
              if($key == 0)
                  continue;
              $temp = [
                  'student_number' =>  $value[0],
                  'firstname' =>  $value[1],
                  'lastname' =>  $value[2],
                  'middlename' =>  $value[3],
                  'birthdate' =>  date($value[4]),
                  'email' => $value[5],
                  'contact' =>  $value[6],
                  'academic_status' => $_POST['academic_status'],
                  'course_id' => $_POST['course_id'],


              ];
              array_push($data, $temp);
          }

          foreach($data as $key => $value)
          {
              $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
              $userData = [
                  'student_number' => $data[$key]['student_number'],
                  'first_name' => $data[$key]['firstname'],
                  'last_name' => $data[$key]['lastname'],
                  'middle_name' => $data[$key]['middlename'],
                  'password' => password_hash($data[$key]['student_number'], PASSWORD_DEFAULT),
                  'email' => $data[$key]['email'],
                  'role_id' => 2,
                  'status' => 1,
                  'uniid' => $uniid
              ];
              $data[$key]['user_id'] = $this->userModel->insert($userData, 'id');
              $this->studentModel->insert($data[$key]);


          }
          // echo "<pre>";
          // print_r($data);
          // die();
          session()->setTempdata('successActStudent', 'File uploaded successfully', 2);
          return redirect()->to(base_url('profile/professors'));
        }
        else {
          $this->data['validation'] = $this->validator;
          return $this->index();
        }


    }

    // public function sendPassword($password = null, $email = null)
    // {
    //
		// 	  $email = \Config\Services::email();
      // $email->setTo($to);
      // $email->setFrom('ORTAC@gmail.com', 'ORTAC');
      // $email->setSubject($subject);
      // $email->setMessage($message);
    // }
}
