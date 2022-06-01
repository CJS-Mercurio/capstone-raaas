<?php

namespace Modules\Professor\Controllers;
use Modules\Admin\Models\CourseModel;
use Modules\Admin\Models\FacultyModel;
use Modules\Admin\Models\PanelModel;
use App\Libraries\Pdf;

use Modules\Student\Models\ResearchModel;
use Modules\Student\Models\m_excel;
use Modules\Student\Models\StudentSeminarModel;

use Modules\Professor\Models\ProfessorSeminarModel;
use Modules\Professor\Models\PublishedResearchModel;
use Modules\Professor\Models\ProfessorModel;

use TablesIgniter\Src\TablesIgniter;

use App\Controllers\BaseController;

class FacultyDetails extends BaseController{
  public function __construct(){

      $this->data['validation'] = null;

      helper("form");
      $this->session = \Config\Services::session();

      $this->rModel = new ResearchModel();
      $this->psModel = new ProfessorSeminarModel();
      $this->pResearch = new PublishedResearchModel();
      $this->ssModel = new StudentSeminarModel();


      $this->courseModel = new CourseModel();
      $this->data['course'] = $this->courseModel->orderBy('id', 'DESC')->findAll();

      $this->facultyModel = new FacultyModel();
      $this->data['faculty'] = $this->facultyModel->orderBy('id', 'DESC')->findAll();

      $this->panelModel = new PanelModel();
      $this->data['panel'] = $this->panelModel->findAll();

      $this->pModel =  new ProfessorModel();
      $this->data['professor'] = $this->pModel->orderBy('id', 'DESC')->findAll();



  }


	//seminar reports
	  public function prof_seminar(){

  		$data['p_seminar'] = $this->psModel->seminar_report();

  		// // print_r($data['p_seminar']);

  		echo view('Modules\Professor\Views\templates\professor_header');
		  echo view('Modules\Professor\Views\facultyDetails\profSeminarV', $data);
		  echo view('Modules\Professor\Views\templates\professor_footer');
  	}


  	public function prof_published_research(){

  		$data['p_research'] = $this->pResearch->pResearch_report();

  		// print_r($data['p_research']);

  		echo view('Modules\Professor\Views\templates\professor_header');
		  echo view('Modules\Professor\Views\facultyDetails\profPubResearchV', $data);
		  echo view('Modules\Professor\Views\templates\professor_footer');


  	}

    public function search_prof_seminar(){

      if($this->request->getMethod() == 'post'){


          $prof_name = $this->request->getVar('prof_name', FILTER_SANITIZE_STRING);
          $data['p_seminar'] = $this->pModel->search_prof($prof_name);

          // print_r($data['p_seminar']);

      }
      echo view('Modules\Professor\Views\templates\professor_header');
      echo view('Modules\Professor\Views\facultyDetails\searchSeminarV', $data);
      echo view('Modules\Professor\Views\templates\professor_footer');


    }

    public function search_pub_research(){

      if($this->request->getMethod() == 'post'){


          $prof_name = $this->request->getVar('prof_name', FILTER_SANITIZE_STRING);
          $data['p_research'] = $this->pModel->search_pub($prof_name);

          // print_r($data['p_research']);

      }
      
      echo view('Modules\Professor\Views\templates\professor_header');
      echo view('Modules\Professor\Views\facultyDetails\searchPubResearchV', $data);
      echo view('Modules\Professor\Views\templates\professor_footer');


    }

        /////////////////////////////////////////print seminars and pub research/////////////////////
    public function faculty_seminar_pdf(){

      $data = $this->psModel->seminar_report();
    $title = "Faculty Seminars/ Conferences and Trainings Attended";


      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Report');

    // set default header data
    // die(PDF_HEADER_LOGO);
    $pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('helvetica', '', 15);
    // add a page
    $pdf->AddPage();
    $pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);

    // column titles
    $header = array('Professor', 'Seminar Title', 'Sponsor', 'Venue', 'Event date');



    // data loading
    // $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
    // echo "<pre>";
    // print_r($data);
    // die();
    // print colored table
    $pdf->SetFillColor(255, 0, 0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128, 0, 0);
    $pdf->SetLineWidth(0.3);
    $pdf->SetFont('', 'B');
    // Header
    $w = array(35, 35, 45, 35, 30);
    $num_headers = count($header);
    for($i = 0; $i < $num_headers; ++$i) {
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
    }
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = 0;
    if (!empty($data)) {
      $ctr = 0;
      foreach($data as $row) {

          if($row['professor_id'] == $ctr){
            $loop = true;
          }

          if($row['professor_id'] > $ctr){
            $loop = false;
            $ctr = $row['professor_id'];
          }

          if($loop == false){
            $pdf->Cell($w[0], 7, ucwords($row['f_firstname']. " " .$row['f_lastname']), 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[1], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[2], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[3], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[4], 7, '', 'LR', 0, 'C', $fill, '', 1, true);

              $pdf->Ln();
              $fill=!$fill;



            foreach($data as $row) {
              if($row['professor_id'] == $ctr){
              $pdf->Cell($w[0], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[1], 7, $row['seminar_title'], 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[2], 7, $row['sponsor'], 'LR', 0, 'C', $fill, '', 1, false);
              $pdf->Cell($w[3], 7, $row['venue'], 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[4], 7, $row['event_date'], 'LR', 0, 'C', $fill, '', 1, true);

              $pdf->Ln();
              $fill=!$fill;
              }else{
                $loop = true;
              }
            }
            }
      }
    }
    $pdf->Cell(array_sum($w), 0, '', 'T');

    // ---------------------------------------------------------

    // close and output PDF document
    $pdf->Output('example_011.pdf', 'I');
    die();

    }

    public function faculty_pResearch_pdf(){

      $data = $this->pResearch->pResearch_report();
    $title = "List of Faculty Published Research";


      $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Report');

    // set default header data
    // die(PDF_HEADER_LOGO);
    $pdf->SetHeaderData('PUPLogo.png', 20, 'Polytechnic University of The Philippines', "Taguig Branch");

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 15, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('helvetica', '', 15);
    // add a page
    $pdf->AddPage();
    $pdf->Write(0, $title, '', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 10);

    // column titles
    $header = array('Faculty', 'Research Title', 'Publication', 'Volume', 'Institute','Event date');



    // data loading
    // $data = $this->LoadData(base_url().'/public/table_data_demo.txt');
    // echo "<pre>";
    // print_r($data);
    // die();
    // print colored table
    $pdf->SetFillColor(255, 0, 0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128, 0, 0);
    $pdf->SetLineWidth(0.3);
    $pdf->SetFont('', 'B');
    // Header
    $w = array(30, 35, 30, 30, 30, 25);
    $num_headers = count($header);
    for($i = 0; $i < $num_headers; ++$i) {
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
    }
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    // Data
    $fill = 0;
    if (!empty($data)) {
      $ctr = 0;
      foreach($data as $row) {

          if($row['professor_id'] == $ctr){
            $loop = true;
          }

          if($row['professor_id'] > $ctr){
            $loop = false;
            $ctr = $row['professor_id'];
          }

          if($loop == false){
            $pdf->Cell($w[0], 7, ucwords($row['f_firstname']. " " .$row['f_lastname']), 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[1], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[2], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[3], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[4], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
            $pdf->Cell($w[5], 7, '', 'LR', 0, 'C', $fill, '', 1, true);


              $pdf->Ln();
              $fill=!$fill;



            foreach($data as $row) {
              if($row['professor_id'] == $ctr){
              $pdf->Cell($w[0], 7, '', 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[1], 7, $row['research_title'], 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[2], 7, $row['publication'], 'LR', 0, 'C', $fill, '', 1, false);
              $pdf->Cell($w[3], 7, $row['volume'], 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[4], 7, $row['institute'], 'LR', 0, 'C', $fill, '', 1, true);
              $pdf->Cell($w[5], 7, $row['event_date'], 'LR', 0, 'C', $fill, '', 1, true);


              $pdf->Ln();
              $fill=!$fill;
              }else{
                $loop = true;
              }
            }
            }
      }
    }
    $pdf->Cell(array_sum($w), 0, '', 'T');

    // ---------------------------------------------------------

    // close and output PDF document
    $pdf->Output('example_011.pdf', 'I');
    die();

    }

   

    public function faculty_seminar_csv(){


         $filename = 'seminar_'.date('Ymd').'.csv';
       header("Content-Description: File Transfer");
       header("Content-Disposition: attachment; filename=$filename");
       header("Content-Type: application/csv; ");

       // get data
         $data = $this->psModel->seminar_report2();

       // file creation
       $file = fopen('php://output', 'w');

       $header = array("First Name","Last Name","Seminar","Sponsor","Venue", "Eventdate");
       fputcsv($file, $header);

         foreach ($data as $key){

           fputcsv($file,$key);
         }

       fclose($file);
       exit;
    }

    public function faculty_pResearch_csv(){


         $filename = 'pResearch_'.date('Ymd').'.csv';
       header("Content-Description: File Transfer");
       header("Content-Disposition: attachment; filename=$filename");
       header("Content-Type: application/csv; ");

       // get data
         $data = $this->pResearch->pResearch_report2();

       // file creation
       $file = fopen('php://output', 'w');

       $header = array("First Name","Last Name","Research Title","Publication","Volume", "Institute", "Event Date");
       fputcsv($file, $header);

         foreach ($data as $key){

           fputcsv($file,$key);
         }

       fclose($file);
       exit;
    }

}