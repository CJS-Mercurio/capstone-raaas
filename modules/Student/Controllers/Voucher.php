<?php namespace Modules\Student\Controllers;

use App\Libraries\Pdf;
// use App\Models\AuthorsResearchModel;
use Modules\Student\Models\AuthorsResearchModel;
use App\Controllers\BaseController;

class Voucher extends BaseController {

  public function index($id){
    $model = new AuthorsResearchModel();
    $data['information'] = $model->getResearch($id);
    // echo "<pre>";
    // print_r($data['information']);
    // die();
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

    // set document information
    // (di ata kailangan)
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Title');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // die(PDF_HEADER_LOGO);
    // $pdf->SetHeaderData(PDF_HEADER_LOGO, 50, 'Polytechnic University of the Philippines', 'Bernadette', array(0,0,0), array(0,0,0));
    // $pdf->setFooterData(array(0,64,0), array(0,64,128));

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
        'stretch' => true,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => true,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false, //array(255,255,255),
        'text' => false,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );

    $pdf->AddPage();

    $pdf->setCellPaddings(1, 1, 1, 1);

    // set cell margins
    $pdf->setCellMargins(1, 1, 1, 1);

    $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

    $pdf->MultiCell(90  , '', view('report/voucher', $data), 0, 'L', 0, 0, '', '', true, 0, true);
    $pdf->MultiCell(80, '', $pdf->write1DBarcode( $id, 'C39', 110, '', '', 18, .4, $style, 'N'), 0, 'R', 0, 1, '', '', true);

    $pdf->Ln(4);
    // $pdf->write1DBarcode('Bernadette', 'C39', '', '', '', 18, .4, $style, 'N');
    // Set some content to print
    // Print text using writeHTMLCell()

    
    $pdf->Output('voucher.pdf', 'I');

    die();

  }
}
