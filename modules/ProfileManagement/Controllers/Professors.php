<?php
namespace Modules\ProfileManagement\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Pdf;

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
use Modules\SuperAdmin\Models\StudentsModel;

use Modules\ProfileManagement\Models\FacultySeminarModel;
use Modules\ProfileManagement\Models\FacultyPublicationModel;



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Professors extends BaseController
{

  public function __construct(){

      $this->session = \Config\Services::session();


			$this->data['validation'] = null;

			helper("form");
			helper('date');

      $this->professorModel = new ProfessorsModel();
      $this->data['professors'] = $this->professorModel->getDetail();
      $this->studentModel = new StudentsModel();
      $this->data['students'] = $this->studentModel->getDetail();
      $this->courseModel = new CourseModel();
      $this->data['courses'] = $this->courseModel->orderBy('id', 'DESC')->findAll();
      $this->academicStatusModel = new AcademicStatusModel();
      $this->data['academic_status'] = $this->academicStatusModel->orderBy('id', 'DESC')->findAll();
      $this->genderModel = new GenderModel();
      $this->data['genders'] = $this->genderModel->orderBy('id', 'DESC')->findAll();
      $this->statusModel = new StatusModel();
      $this->data['status'] = $this->statusModel->orderBy('id', 'DESC')->findAll();
      $this->fsModel = new FacultySeminarModel();
      $this->data['p_seminar'] = $this->fsModel->orderBy('id', 'DESC')->findAll();
      $this->fpModel = new FacultyPublicationModel();
      $this->data['p_research'] = $this->fpModel->orderBy('id', 'DESC')->findAll();
      $this->professorModel = new ProfessorsModel();
      $this->data['faculty'] = $this->professorModel->findAll();
      $this->userModel = new UserModel();

      $uniid = session()->get('logged_user');
      $role = $this->userModel->getLoggedInUserRole($uniid);
      $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 
      $this->data['loggedIn'] = $this->userModel->getLoggedInUserRole($uniid);
      $this->data['allowed_task']= $this->userModel->getUserPermission($role['role_id']);

    }

    public function index()
    {
        // $this->data['view'] = 'Modules\SuperAdmin\Views\students\index';
        // $this->data['view'] = 'Modules\SuperAdmin\Views\templates\header';
        // return view('template/index', $this->data);
        echo view('templates/user/header', $this->data);
        echo view('Modules\ProfileManagement\Views\professors\index', $this->data);
        echo view('templates/user/footer');

    }
    
      public function add()
    {

      $this->data['validation'] = null;

  		$rules = [

  			'facultycode' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'Required',
  					],
  				],
  			'email' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'Required',
  					],
  				],
  			'firstname' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'Required',
  					],
  				],
  			'lastname' => [
  					'rules' => 'required',
  					'errors' =>[
  						'required' => 'Required',
  					],
  				],

          'birthdate' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'Required',
    					],
    				],
          'position' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'Required',
    					],
    				],
          'status' => [
    					'rules' => 'required',
    					'errors' =>[
    						'required' => 'Required',
    					],
    				],

  		];

        // $this->data['courses'] = $this->courseModel->get();
        // $this->data['academic_status'] = $this->academicStatusModel->get();
        $this->data['edit'] = false;
        $this->data['view'] = 'Modules\ProfileManagement\Views\professors\form';
				if($this->request->getMethod() == 'post')
				{
					if($this->validate($rules))
					{
						if($this->professorModel->insertProfessor($_POST))
						{
							$this->session->setTempdata('successAct', 'Professor activated successfully', 2);
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
        echo view('Modules\ProfileManagement\Views\professors\form', $this->data);
        echo view('templates/user/footer');


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
                  'status' => 1,
                  'uniid' => $uniid
              ];

                $data[$key]['user_id'] = $this->userModel->insert($userData, 'id');
                $this->professorModel->insert($data[$key]);

          }

          session()->setTempdata('successAct', 'File uploaded successfully', 2);
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
    public function seminar(){

      $uniid = session()->get('logged_user');
      $professor = $this->userModel->getLoggedInUserRole($uniid);

      $id = $professor['id'];

      $data['allowed_task']= $this->userModel->getUserPermission($professor['role_id']);

      $this->data['p_seminar'] = $this->fsModel->getSeminar($id);
      $this->data['validation'] = null;
      $this->data['p_research'] = $this->fpModel->getPublication($id);
      $this->data['current_user'] = $this->userModel->getLoggedInUserRole($uniid); 
      
    //   print_r($this->data['current_user']);
    //   die();


      echo view('templates/user/header', $this->data);
      echo view('Modules\ProfileManagement\Views\professors\infoSheetV', $this->data);
      echo view('templates/user/footer');
    }

    public function add_seminar(){
      $uniid = session()->get('logged_user');
      $professor = $this->userModel->getLoggedInUserRole($uniid);

      $id = $professor['id'];
      $task['allowed_task']= $this->userModel->getUserPermission($professor['role_id']);


      $this->data['validation'] = null;

  		$rules = [

  			'title' => [
  				'rules' => 'required',
  					'errors' =>[
  						'required' => 'Seminar Title is required',
  					],
  				],

  			'venue' => [
  				'rules' => 'required',
  					'errors' =>[
  						'required' => 'Venue is required',
  					],
  				],

  			'date' => [
  				'rules' => 'required',
  					'errors' =>[
  						'required' => 'Date attended is required',
  					],
  				],

  		];

  		if($this->request->getMethod() == 'post'){


  			if($this->validate($rules)){

  				$data = [
            'faculty_id' => $id,
  					'event_title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
  					'sponsor' => $this->request->getVar('sponsor', FILTER_SANITIZE_STRING),
  					'venue' => $this->request->getVar('venue'),
  					'date_attended' => $this->request->getVar('date'),

  				];

  				if($this->fsModel->save($data) === true){

  					session()->setTempdata('successSeminar', 'Seminar added successfully', 2);
  						return redirect()->to(base_url('/profile/professors/seminar'));

  				}else{

  					session()->setTempdata('errorSeminar', 'Seminar failed to add. Try again.', 2);
  						return redirect()->to(base_url('/profile/professors/seminar'));

  				}

  			}else{

  				$data3['validation'] = $this->validator;

  			}

  		}


  		$data2['p_seminar'] = $this->fsModel->getSeminar($id);
  		$data4['p_research'] = $this->fpModel->getPublication($id);

  		$this->data = array_merge($data2, $data3, $data4);

      echo view('templates/user/header', $task);
      echo view('Modules\ProfileManagement\Views\professors\infoSheetV', $this->data);
      echo view('templates/user/footer');


    }

    public function delete_seminar($id = null){

      if($this->fsModel->where('id', $id)->delete()){
        session()->setTempdata('successDelete', 'Deleted successfully', 2);
        return redirect()->to(base_url()."/profile/professors/seminar");

      }else{
        session()->setTempdata('errorDelete', 'Not deleted. Please try again.', 2);
        return redirect()->to(base_url()."/profile/professors/seminar");

      }

    }

    public function add_publication(){

      $uniid = session()->get('logged_user');
      $professor = $this->userModel->getLoggedInUserRole($uniid);

      $id = $professor['id'];
      $task['allowed_task']= $this->userModel->getUserPermission($professor['role_id']);

      $this->data['validation'] = null;

      $rules = [

        'research_title' => [
          'rules' => 'required',
            'errors' =>[
              'required' => 'Title is required',
            ],
          ],

        'abstract' => [
          'rules' => 'required',
            'errors' =>[
              'required' => 'Abstract is required',
            ],
          ],

        'school_year' => [
    					'rules' => 'required|regex_match[^(201[5-9]|202[0-9])[-.](201[5-9]|202[0-9])$]|exact_length[9]',
    					'errors' =>[
    						'required' => 'School Year is required',
    						'regex_match' => 'You entered wrong school year format',
    					],
    				],

      ];


      if($this->request->getMethod() == 'post'){
        if($this->validate($rules)){
          $year = $this->request->getVar('school_year');

          [$year_start, $year_end] = explode( '-', $year );

    			if($year_start > $year_end || $year_start == $year_end){

    				session()->setTempdata('errorSY', 'Invalid school year. Try again.', 2);
    				return redirect()->to(base_url()."/profile/professors/seminar");
    			}else {
              $data = [

                'research_title' => $this->request->getVar('research_title', FILTER_SANITIZE_STRING),
                'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
                'school_year' => $this->request->getVar('school_year'),
                'faculty_id' => $id,

              ];

    			}

          if($this->fpModel->save($data) === true){

            session()->setTempdata('successResearch', 'Research added successfully', 2);
            return redirect()->to(base_url('/profile/professors/seminar'));



          }else{

            session()->setTempdata('errorResearch', 'Research failed to add. Try again.', 2);
            return redirect()->to(base_url('/profile/professors/seminar'));

          }


        }else{

          $data3['validation'] = $this->validator;

        }

      }

      $data2['p_seminar'] = $this->fsModel->getSeminar($id);
      $data4['p_research'] = $this->fpModel->getPublication($id);

      $this->data = array_merge($data2, $data3, $data4);

      echo view('templates/user/header', $task);
      echo view('Modules\ProfileManagement\Views\professors\infoSheetV', $this->data);
      echo view('templates/user/footer');

    }

    public function delete_publication($id = null){

    	if($this->fpModel->where('id', $id)->delete()){
        session()->setTempdata('successDeleteP', 'Deleted successfully', 2);
        return redirect()->to(base_url()."/profile/professors/seminar");

      }else{
        session()->setTempdata('errorDeleteP', 'Not deleted. Please try again.', 2);
        return redirect()->to(base_url()."/profile/professors/seminar");

      }

    }

    public function view_profile(){


      echo view('templates/user/header', $this->data);
      echo view('Modules\ProfileManagement\Views\allInfoV', $this->data);
      echo view('templates/user/footer');

    }

    public function view_faculty($id){
      $data1['p_seminar'] = $this->fsModel->getSeminar($id);
      $data2['p_research'] =  $this->fpModel->getPublication($id);

      $data = array_merge($data1, $data2);

      echo view('templates/user/header', $this->data);
      echo view('Modules\ProfileManagement\Views\listOfAll', $data);
      echo view('templates/user/footer');
    }


    /////////////////////////printing

    public function print_seminarPDF(){


      $data['p_seminar'] = $this->fsModel->seminar_report();

     $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

     // set document information
     $pdf->SetTitle('Report');

     // die(PDF_HEADER_LOGO);
     $pdf->SetHeaderData('header.png', '130', '', '');
   // die(PDF_HEADER_LOGO);
     $pdf->setPrintHeader(true);
   // set header and footer fonts
     $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
     $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     // (di ata kailangan)
     $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

     // set margins
     $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
     $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

     // set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

     // set image scale factor
     $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

     // set default font subsetting mode
     $pdf->setFontSubsetting(true);

     // Set font
     $pdf->SetFont('dejavusans', '', 10, '', true);

     $style = array(
         'position' => '',
         'align' => 'C',
         'stretch' => false,
         'fitwidth' => true,
         'cellfitalign' => '',
         'border' => true,
         'hpadding' => 'auto',
         'vpadding' => 'auto',
         'fgcolor' => array(0, 0, 0),
         'bgcolor' => false, //array(255,255,255),
         'text' => true,
         'font' => 'helvetica',
         'fontsize' => 8,
         'stretchtext' => 4
     );

     $pdf->AddPage();

     $pdf->setCellPaddings(1, 1, 1, 1);

     // set cell margins
     $pdf->setCellMargins(1, 1, 1, 1);

     $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

     $pdf->writeHTML(view('report/reportFaculty', $data), true, false, true, false, '');
     $pdf->Ln(4);

     // ---------------------------------------------------------

     // close and output PDF document
     $pdf->Output('example_011.pdf', 'I');
     die();

    }

    public function print_per_seminarPDF($id){


     $data['p_seminar'] = $this->fsModel->per_seminar_report($id);
     $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

     // set document information
     $pdf->SetTitle('Report');

     // die(PDF_HEADER_LOGO);
     $pdf->SetHeaderData('header.png', '130', '', '');
   // die(PDF_HEADER_LOGO);
     $pdf->setPrintHeader(true);
   // set header and footer fonts
     $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
     $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     // (di ata kailangan)
     $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

     // set margins
     $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
     $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

     // set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

     // set image scale factor
     $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

     // set default font subsetting mode
     $pdf->setFontSubsetting(true);

     // Set font
     $pdf->SetFont('dejavusans', '', 10, '', true);

     $style = array(
         'position' => '',
         'align' => 'C',
         'stretch' => false,
         'fitwidth' => true,
         'cellfitalign' => '',
         'border' => true,
         'hpadding' => 'auto',
         'vpadding' => 'auto',
         'fgcolor' => array(0, 0, 0),
         'bgcolor' => false, //array(255,255,255),
         'text' => true,
         'font' => 'helvetica',
         'fontsize' => 8,
         'stretchtext' => 4
     );

     $pdf->AddPage();

     $pdf->setCellPaddings(1, 1, 1, 1);

     // set cell margins
     $pdf->setCellMargins(1, 1, 1, 1);

     $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

     $pdf->writeHTML(view('report/reportFaculty', $data), true, false, true, false, '');
     $pdf->Ln(4);

     // ---------------------------------------------------------

     // close and output PDF document
     $pdf->Output('example_011.pdf', 'I');
     die();

    }

    public function print_seminarCSV(){

      $filename = 'seminar_'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $data = $this->fsModel->seminar_reportCSV();

      // file creation
      $file = fopen('php://output', 'w');

      $header = array("First Name","Last Name","Seminar","Sponsor","Venue", "Date Attended");
      fputcsv($file, $header);

        foreach ($data as $key){

          fputcsv($file,$key);
        }

      fclose($file);
      exit;
    }

    public function print_per_seminarCSV($id){

      $filename = 'seminar_'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $data = $this->fsModel->per_seminar_reportCSV($id);

      // file creation
      $file = fopen('php://output', 'w');

      $header = array("First Name","Last Name","Seminar","Sponsor","Venue", "Date Attended");
      fputcsv($file, $header);

        foreach ($data as $key){

          fputcsv($file,$key);
        }

      fclose($file);
      exit;
    }

    public function print_completedPDF($start, $end){

    $data['p_seminar'] = $this->fpModel->completed_reportPDF($start, $end);
    $data['year_start'] = $start;
    $data['year_end'] = $end;


    $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Report');

        // die(PDF_HEADER_LOGO);
        $pdf->SetHeaderData('header.png', '130', '', '');
      // die(PDF_HEADER_LOGO);
        $pdf->setPrintHeader(true);
      // set header and footer fonts
        $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // (di ata kailangan)
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('dejavusans', '', 10, '', true);

        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);

        $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        $pdf->writeHTML(view('report/reportAllCom', $data), true, false, true, false, '');
        $pdf->Ln(4);

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();
    }

    public function print_per_completedPDF($start, $end, $id){

    $data['p_seminar'] = $this->fpModel->per_completed_reportPDF($start, $end, $id);
    // $data['information']
    $data['year_start'] = $start;
    $data['year_end'] = $end;

    $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Report');

        // die(PDF_HEADER_LOGO);
        $pdf->SetHeaderData('header.png', '130', '', '');
      // die(PDF_HEADER_LOGO);
        $pdf->setPrintHeader(true);
      // set header and footer fonts
        $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // (di ata kailangan)
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('dejavusans', '', 10, '', true);

        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);

        $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        $pdf->writeHTML(view('report/reportPerCom', $data), true, false, true, false, '');
        $pdf->Ln(4);

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();
    }

    public function print_publishedPDF($start, $end){

    $data['p_seminar'] = $this->fpModel->published_reportPDF($start, $end);
    $data['year_start'] = $start;
    $data['year_end'] = $end;
    
    $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Report');

        // die(PDF_HEADER_LOGO);
        $pdf->SetHeaderData('header.png', '130', '', '');
      // die(PDF_HEADER_LOGO);
        $pdf->setPrintHeader(true);
      // set header and footer fonts
        $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // (di ata kailangan)
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('dejavusans', '', 10, '', true);

        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);

        $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        $pdf->writeHTML(view('report/reportAllPub', $data), true, false, true, false, '');
        $pdf->Ln(4);

		// ---------------------------------------------------------

		// close and output PDF document
		$pdf->Output('example_011.pdf', 'I');
		die();
    }

    public function print_per_publishedPDF($start, $end, $id){

    $data['p_seminar'] = $this->fpModel->per_published_reportPDF($start, $end, $id);
    $data['year_start'] = $start;
    $data['year_end'] = $end;

    $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Report');

        // die(PDF_HEADER_LOGO);
        $pdf->SetHeaderData('header.png', '130', '', '');
      // die(PDF_HEADER_LOGO);
        $pdf->setPrintHeader(true);
      // set header and footer fonts
        $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // (di ata kailangan)
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('dejavusans', '', 10, '', true);

        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);

        $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        $pdf->writeHTML(view('report/reportPerPub', $data), true, false, true, false, '');
        $pdf->Ln(4);

    // ---------------------------------------------------------

    // close and output PDF document
    $pdf->Output('example_011.pdf', 'I');
    die();
    }

    public function print_completedCSV($start, $end){

      $filename = 'publication'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $data = $this->fpModel->completed_reportCSV($start, $end);

      // file creation
      $file = fopen('php://output', 'w');

      $header = array("Research Title","Abstract","Year Completed");
      fputcsv($file, $header);

        foreach ($data as $key){

          fputcsv($file,$key);
        }

      fclose($file);
      exit;

    }

    public function print_publishedCSV($start, $end){
      
        
      $filename = 'publication'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");
      // get data
      $data = $this->fpModel->published_reportCSV($start, $end);

      // file creation
      $file = fopen('php://output', 'w');
      
      $header = array("Research Title","Abstract", "Refereed Publication", "Volume", "URL", "Year Completed", "Date Published");
      fputcsv($file, $header);
 
        foreach ($data as $key){
          fputcsv($file,$key);
        }

      fclose($file);
      exit;

    }

    public function print_per_completedCSV($start, $end, $id){

      $filename = 'publication'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $data = $this->fpModel->per_completed_reportCSV($start, $end, $id);

      // file creation
      $file = fopen('php://output', 'w');

      $header = array("First Name","Last Name","Research Title","Abstract", "Year Completed");
      fputcsv($file, $header);

        foreach ($data as $key){

          fputcsv($file,$key);
        }

      fclose($file);
      exit;

    }

    public function print_per_publishedCSV($start, $end, $id){

      $filename = 'publication'.date('Ymd').'.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");

      // get data
      $data = $this->fpModel->per_published_reportCSV($start, $end, $id);

      // file creation
      $file = fopen('php://output', 'w');

      $header = array("First Name","Last Name","Research Title", "Abstract",  "Refereed Publication", "Volume", "URL", "Year Completed", "Date Published");
      fputcsv($file, $header);

        foreach ($data as $key){

          fputcsv($file,$key);
        }

      fclose($file);
      exit;

    }



    //////////////////////////////////////////////////////////////////////////////

    public function view_pResearch($id = null){
      $this->data['pResearch'] = $this->fpModel->getResearchDetails($id);

      echo view('templates/user/header', $this->data);
      echo view('Modules\ProfileManagement\Views\professors\pResearchV', $this->data);
      echo view('templates/user/footer');

    }


    public function edit_pResearch($id=null){

    $this->data['validation'] = null;

    $rules = [

      'research_title' => [
        'rules' => 'required',
          'errors' =>[
            'required' => 'Title is required',
          ],
        ],

      'abstract' => [
        'rules' => 'required',
          'errors' =>[
            'required' => 'Abstract is required',
          ],
        ],

      'school_year' => [
            'rules' => 'required|regex_match[^(201[5-9]|202[0-9])[-.](201[5-9]|202[0-9])$]|exact_length[9]',
            'errors' =>[
              'required' => 'School Year is required',
              'regex_match' => 'You entered wrong school year format',
            ],
          ],

    ];


    if($this->request->getMethod() == 'post'){
      if($this->validate($rules)){
        $year = $this->request->getVar('school_year');

        [$year_start, $year_end] = explode( '-', $year );
        if($year_start > $year_end || $year_start == $year_end){

          session()->setTempdata('errorSY', 'Invalid school year. Try again.', 2);
          return redirect()->to(base_url()."/profile/professors/editPresearch/".$id);
        }else {
            $data = [

              'research_title' => $this->request->getVar('research_title', FILTER_SANITIZE_STRING),
              'abstract' => $this->request->getVar('abstract', FILTER_SANITIZE_STRING),
              'school_year' => $this->request->getVar('school_year'),

            ];
        }

        if($this->fpModel->update($id, $data) === true){

          session()->setTempdata('successResearch', 'Research updated successfully', 2);
          return redirect()->to(base_url()."/profile/professors/editPresearch/".$id);


        }else{

          session()->setTempdata('errorResearch', 'Research failed to update. Try again.', 2);
          return redirect()->to(base_url()."/profile/professors/editPresearch/".$id);
        }

      }else{

        $this->data['validation'] = $this->validator;

      }
    }

      $this->data['pResearch'] = $this->fpModel->getResearchDetails($id);

      echo view('templates/user/header', $this->data);
      echo view('Modules\ProfileManagement\Views\professors\editPresearchV', $this->data);
      echo view('templates/user/footer');

    }

    public function tag_as_published($id){

      $rules = [

        'date_published' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Date published is required',
          ],
        ],
        
         'publication' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Publication is required',
          ],
        ],
        
         'volume' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'Volume is required',
          ],
        ],
        
         'url' => [
          'rules' => 'required',
          'errors' =>[
            'required' => 'URL is required',
          ],
        ],

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
                      if($file->move(FCPATH.'public/publication', $file->getName())){

                        $filename = $file->getName();
                        $newdata = [
                            'date_published' => $this->request->getVar('date_published'),
                            'proof_publication' =>$filename,
                            'volume' => $this->request->getVar('volume'),
                            'institute' => $this->request->getVar('url'),
                            'publication' =>  $this->request->getVar('publication'),
                            'privacy' => 1,
                        ];

                          if($this->fpModel->update($id, $newdata) ===  true){
                              $this->session->setTempdata('tama','File uploaded successfully.', 3);
                              return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);
                            }//status
                            else{
                              $this->session->setTempdata('mali','File not uploaded. Try again.', 3);
                              return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);

                            }
                      }//move
                    }//valid


            }else{
              $this->data['validation'] = $this->validator;

            }
        }
        return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);

  }
  public function update_publication($id=null){
  $rules = [

      'date_published' => [
        'rules' => 'required',
        'errors' =>[
          'required' => 'Date published is required',
        ],
      ],


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
                  if($file->move(FCPATH.'public/publication', $file->getName())){

                    $filename = $file->getName();
                    $newdata = [
                        'date_published' => $this->request->getVar('date_published'),
                        'publication' => $filename,
                    ];

                      if($this->fpModel->update($id, $newdata) ===  true){
                          $this->session->setTempdata('tama','Proof of publication updated successfully.', 3);
                          return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);

                        }//status
                        else{
                          $this->session->setTempdata('mali','File not uploaded. Try again.', 3);
                          return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);


                        }
                  }//move
                }//valid
        }else{
          $this->data['validation'] = $this->validator;

        }
    }
    $this->session->setTempdata('mali','No file uploaded. Try again.', 3);
    return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);


}

public function remove_proof($id=null){

          $newdata = [
             'date_published' => null,
             'publication' => null,
             'volume' => null,
             'institute' => null,
             'proof_publication' => null,
          ];

          if($this->fpModel->update($id, $newdata) ===  true){
             $this->session->setTempdata('tama','Proof of publication removed successfully.', 3);
             return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);

           }//status
           else{
             $this->session->setTempdata('mali','Proof of publication is not removed. Try again.', 3);
             return redirect()->to(base_url()."/profile/professors/pResearchDetail/".$id);

           }

         }


  
}/// end class
