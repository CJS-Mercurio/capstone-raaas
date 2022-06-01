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
use Modules\SuperAdmin\Models\ProfessorsModel;



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Professors extends BaseController
{

  public function __construct(){

			$this->data['validation'] = null;

			helper("form");
			helper('date');

      $this->professorModel = new ProfessorsModel();
      $this->data['professors'] = $this->professorModel->getDetail();
      // $this->courseModel = new CourseModel();
      // $this->data['courses'] = $this->courseModel->orderBy('id', 'DESC')->findAll();
      // $this->academicStatusModel = new AcademicStatusModel();
      // $this->data['academic_status'] = $this->academicStatusModel->orderBy('id', 'DESC')->findAll();
      // $this->genderModel = new GenderModel();
      // $this->data['genders'] = $this->genderModel->orderBy('id', 'DESC')->findAll();

      $this->userModel = new UserModel();

    }

    public function index()
    {
        // $this->data['view'] = 'Modules\SuperAdmin\Views\students\index';
        // $this->data['view'] = 'Modules\SuperAdmin\Views\templates\header';
        echo view('Modules\SuperAdmin\Views\templates\header');
        echo view('Modules\SuperAdmin\Views\professors\index' , $this->data);
        echo view('Modules\SuperAdmin\Views\templates\footer');
        // return view('template/index', $this->data);

    }

    public function add()
    {

      $this->data['validation'] = null;

  		$rules = [

  			'facultycode' => [
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

          'birthdate' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],
          'position' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],
          'status' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'required',
    					],
    				],

  		];

        // $this->data['courses'] = $this->courseModel->get();
        // $this->data['academic_status'] = $this->academicStatusModel->get();
        $this->data['edit'] = false;
        $this->data['view'] = 'Modules\SuperAdmin\Views\professors\form';
				if($this->request->getMethod() == 'post')
				{
					if($this->validate($rules))
					{
						if($this->professorModel->insertProfessor($_POST))
						{
							session()->setTempdata('successAct', 'Professor activated successfully', 2);
							return redirect()->to(base_url('superadmin/professors'));
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
        echo view('Modules\SuperAdmin\Views\templates\header');
    		echo view('Modules\SuperAdmin\Views\professors\form', $this->data);
    		echo view('Modules\SuperAdmin\Views\templates\footer');

    }

    public function insertSpreadsheet()
    {

      $this->data['validation'] = null;

      $rules = [

        'professors' => [
          'rules' => 'uploaded[professors]|ext_in[professors,xlsx]',
          'errors' =>[
            'uploaded' => 'Upload a file (.xlsx).',
            'ext_in' => 'Invalid file extension. Try again.',
            ],
          ],

      ];
        if ($this->validate($rules)) {
          $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->request->getFile('professors'));
          $xlsx = new Xlsx($spreadsheet);
          $array = $spreadsheet->getActiveSheet()->toArray();

          $data = [];
          foreach($array as $key => $value)
          {
              if($key == 0)
                  continue;
              $temp = [
                  'facultycode' =>  $value[0],
                  'firstname' =>  $value[1],
                  'lastname' =>  $value[2],
                  'middlename' =>  $value[3],
                  'email' =>  $value[4],
                  'birthdate' =>  date($value[5]),
                  'position' =>  $value[6],
                  'status' =>  $value[7]

              ];
              array_push($data, $temp);
          }

          foreach($data as $key => $value)
          {
              $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
              $userData = [
                  'faculty_code' => $data[$key]['facultycode'],
                  'first_name' => $data[$key]['firstname'],
                  'last_name' => $data[$key]['lastname'],
                  'middle_name' => $data[$key]['middlename'],
                  'password' => password_hash($data[$key]['facultycode'], PASSWORD_DEFAULT),
                  'email' => $data[$key]['email'],
                  'role_id' => 3,
                  'uniid' => $uniid
              ];

                $data[$key]['user_id'] = $this->userModel->insert($userData, 'id');
                $this->professorModel->insert($data[$key]);

          }

          session()->setTempdata('successAct', 'Student activated successfully', 2);
          return redirect()->to(base_url('superadmin/professors'));
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
