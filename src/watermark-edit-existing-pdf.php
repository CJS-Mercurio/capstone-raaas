<?php
//This page contains edit the existing file by using fpdi.
require(dirname(__DIR__ ) . '/vendor/WatermarkPDF/WatermarkPDF.php');

# ==========================

if (isset($_POST['dl'])) {
    $file = $_POST['file'];
    $pdfFile = dirname(__DIR__ ) . '/public/researches/' . $file;

}

if (isset($_POST['dlf'])) {

    $file = $_POST['full'];
    $pdfFile = dirname(__DIR__ ) . '/public/fullpaper/' . $file;

}

if(file_exists($pdfFile)){
  $watermarkText = "        R A A S";
  $pdf = new WatermarkPDF($pdfFile, $watermarkText);
  //$pdf = new FPDI();
  $pdf->AddPage();
  $pdf->SetFont('Arial', '', 12);

}else{

  echo "<script type='text/javascript'>
      alert('No file found in database!');
      history.go(-2);

      </script>";
die();
}



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
// $pdf->Output("sampleUpdated.pdf", 'D'); //Download the file. open dialogue window in browser to save, not open with PDF browser viewer
// $pdf->Output($pdfFile, 'F'); //save to a local file with the name given by filename (may include a path)
// $pdf->Output($pdfFile, 'I'); //I for "inline" to send the PDF to the browser
// $pdf->Output("", 'S'); //return the document as a string. filename is ignored.
?>
