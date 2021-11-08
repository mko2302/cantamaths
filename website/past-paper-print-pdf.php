<?php

 function fetch_data()
 {
   session_start();
   $teams = 5;

   $yearID = implode($_SESSION['selected-yearID']);
   $levelID = implode($_SESSION['selected-levelID']);

      $output = '';
      $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");
      $selected_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
      $selected_qry = mysqli_query($dbconnect, $selected_sql);
      $selected_aa = mysqli_fetch_assoc($selected_qry);
      do {
        for ($i=1, $letter="A"; $i < $teams; $i++, ++$letter) {
        $filename = $selected_aa['filename'];
        $image = '<img src="questions/"$filename"" class="img-fluid" style="height: 135px;">';
        $output .= '
          <tr>
            <td><p>'.$letter.'</p></td>
            <td><img src="questions/'.$filename.'" class="img-fluid" style="height: 135px;"></td>
            <td><p>answer</p></td>
          </tr>';
        }
      } while ($selected_aa = mysqli_fetch_assoc($selected_qry));
      return $output;
 }

      require_once('TCPDF-main/tcpdf.php');
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $obj_pdf->SetDefaultMonospacedFont('helvetica');
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
      $obj_pdf->setPrintHeader(false);
      $obj_pdf->setPrintFooter(false);
      $obj_pdf->SetAutoPageBreak(TRUE, 20);
      $obj_pdf->SetFont('helvetica', '', 12);
      $obj_pdf->AddPage();
      $content = '';
      $content .= '

      <table border="1" cellspacing="0" cellpadding="5">
           <tr>
                <th width="12.5%"></th>
                <th width="28%"></th>
                <th width="59.5%"></th>
           </tr>
      ';
      $content .= fetch_data();
      $content .= '</table>';
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('sample.pdf', 'I');

 ?>
