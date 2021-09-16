<?php

 function fetch_data()
 {
   session_start();

   $Q_ID = implode("','",$_SESSION['Q_ID']);
   $Q_ID_SQL = "IN ('".$Q_ID."')";

      $output = '';
      $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");
      $selected_sql = "SELECT filename, answer FROM question WHERE questionID $Q_ID_SQL";
      $selected_qry = mysqli_query($dbconnect, $selected_sql);
      while($selected_aa = mysqli_fetch_assoc($selected_qry))
      {
        $filename = $selected_aa['filename'];
        $image = '<img src="questions/"$filename"" class="img-fluid" style="height: 135px;">';

        $output .= '
          <tr>
            <td><img src="questions/'.$filename.'" class="img-fluid" style="height: 135px;"></td>
          </tr>';
      }
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
      $obj_pdf->SetAutoPageBreak(TRUE, 10);
      $obj_pdf->SetFont('helvetica', '', 12);
      $obj_pdf->AddPage();
      $content = '';
      $content .= '
      <h3 align="center"></h3><br /><br />
      <table border="1" cellspacing="0" cellpadding="5">
           <tr>

                <th></th>

           </tr>
      ';
      $content .= fetch_data();
      $content .= '</table>';
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('sample.pdf', 'I');
 
 ?>
