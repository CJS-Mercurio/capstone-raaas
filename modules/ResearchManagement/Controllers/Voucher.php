<?php namespace Modules\ResearchManagement\Controllers;

use App\Libraries\Pdf;
// use App\Models\AuthorsResearchModel;
use Modules\Student\Models\AuthorsResearchModel;
use Modules\Student\Models\ResearchModel;
use App\Controllers\BaseController;

class Voucher extends BaseController {

  public function index($id){
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $model = new AuthorsResearchModel();
    $data['information'] = $model->getResearch($id);
    // echo "<pre>";
    // print_r($data['information']);
    // die();

    // set document information
    // (di ata kailangan)
    $pdf->SetTitle('Voucher');

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

    $pdf->writeHTML(view('report/voucher', $data), true, false, true, false, '');
    $style['position'] = 'C';
    $pdf->write1DBarcode($data['information'][0]['slugs'], 'C39', '', '', '', 15, 0.4, $style, 'N');
    $pdf->Ln(4);
    // Center position


    // $pdf->write1DBarcode('Bernadette', 'C39', '', '', '', 18, .4, $style, 'N');
    // Set some content to print
    // Print text using writeHTMLCell()


    $pdf->Output('voucher.pdf', 'I');

    die();

  }

  public function scan(){

    $model = new ResearchModel();
    $data= $model->getBySlug($_GET["slug"]);
    if (empty($data)) {
      $data['info'] = false;
    }
    else {
      $data['info'] = true;

    }
    return json_encode($data);
    // return true;
  }
}
