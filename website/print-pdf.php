<?php ob_start();
function fetch_data() {
  session_start();
// Get the values sent through the page load
  $select_page = $_GET['select'];
  $print_type = $_GET['print_type'];
  if ($print_type == "competition") {
// if print type was competition then get the amount of teams as well
    $teams = $_GET['teams'];
  }
// Include the SQL and loops that get the layout of the document and the content
  include("print-pdf-sql.php");
  return $output;
}

// TCPDF coded to get exporting to PDF working
require_once('TCPDF-main/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Cantamath Worksheet");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('helvetica', '', 12);
$obj_pdf->AddPage();
$content = '';
// Setting the table
$content .= '
<table border="1" cellspacing="0" cellpadding="1">
';
$content .= fetch_data();
$content .= '</table>';
// Write HTML to write all the information from the print-pdf-sql
$obj_pdf->writeHTML($content);
ob_end_clean();
$obj_pdf->Output('sample.pdf', 'I');
