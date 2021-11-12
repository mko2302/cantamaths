<!doctype html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
<title>Save state of checkbox on refresh using JavaScript</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/custom.css" rel="stylesheet" />
<style type="text/css">
</style>
</head>
<body>

<ul class="list-group">
      <li class="list-group-item"><input id="all" type="checkbox" class="save-cb-state" name="mycheckbox" value="yes"> Must I save my state?</li>
      <li class="list-group-item"><input type="checkbox" name="anothercheckbox" value="1"> Try and save this</li>
      <li class="list-group-item"><input type="checkbox" class="save-cb-state" name="mycheckbox2" value="yes"> This can be saved as well.</li>
    </ul>


<script src="http://code.jquery.com/jquery.js"></script>
<!-- This JavaScript file is required to load the XpressDox interview as well as the code required to run it -->

<script>
// Avoid scoping issues by encapsulating code inside anonymous function
(function() {
  // variable to store our current state
  var cbstate;

  // bind to the onload event
  window.addEventListener('load', function() {
    // Get the current state from localstorage
    // State is stored as a JSON string
    cbstate = JSON.parse(localStorage['CBState'] || '{}');

    // Loop through state array and restore checked
    // state for matching elements
    for(var i in cbstate) {
      var el = document.querySelector('input[name="' + i + '"]');
      if (el) el.checked = true;
    }

    // Get all checkboxes that you want to monitor state for
    var cb = document.getElementsByClassName('save-cb-state');

    // Loop through results and ...
    for(var i = 0; i < cb.length; i++) {

      //bind click event handler
      cb[i].addEventListener('click', function(evt) {
        // If checkboxe is checked then save to state
        if (this.checked) {
          cbstate[this.name] = true;
        }

    // Else remove from state
        else if (cbstate[this.name]) {
          delete cbstate[this.name];
        }

    // Persist state
        localStorage.CBState = JSON.stringify(cbstate);
      });
    }
  });
})();
</script>
</body>
</html>

<script>
// Avoid scoping issues by encapsulating code inside anonymous function
(function() {
  // variable to store our current state
  var cbstate;

  // bind to the onload event
  window.addEventListener('load', function() {
    // Get the current state from localstorage
    // State is stored as a JSON string
    cbstate = JSON.parse(localStorage['CBState'] || '{}');

    // Loop through state array and restore checked
    // state for matching elements
    for(var i in cbstate) {
      var el = document.querySelector('input[name="' + i + '"]');
      if (el) el.checked = true;
    }

    // Get all checkboxes that you want to monitor state for
    var cb = document.getElementsByClassName('form-check-input');

    // Loop through results and ...
    for(var i = 0; i < cb.length; i++) {

      //bind click event handler
      cb[i].addEventListener('change', function(evt) {
        // If checkboxe is checked then save to state
        if (this.checked) {
          cbstate[this.name] = true;
        }

    // Else remove from state
        else if (cbstate[this.name]) {
          delete cbstate[this.name];
        }

    // Persist state
        localStorage.CBState = JSON.stringify(cbstate);
      });
    }
  });
})();
</script>




<!-- filter checkbox -->
<button type="button" class="btn" onclick="send_filters('beans', 'clear')" id="Clear_Filters">Clear All Filters</button>
<br>


<!-- Runs loop throught the filter and on each loop gets information about a different filter -->
<?php $a = 0;
do {
  if ($a == 0) {
    $filter = "tag";
    $nameID = "tagID";
    $filtername = "tagname";
  } if ($a == 1) {
    $filter = "level";
    $nameID = "levelID";
    $filtername = "levelname";
  } if ($a == 2) {
    $filter = "year";
    $nameID = "yearID";
    $filtername = "yearname";
  }


# Selects from all information from the table of the current filter being looped
  $filter_sql = "SELECT * FROM $filter ORDER BY $filtername desc";
  $filter_qry = mysqli_query($dbconnect, $filter_sql);
  $filter_aa = mysqli_fetch_assoc($filter_qry);


   echo $filter; ?>

<!-- Displays checkbox for selection all filters -->
  <div class="form-check">
<!-- LoadDoc information is sent through to the ajax Javascript for filtering --> <!-- $nameID in id is to differentiate from other filters -->
    <input class="form-check-input" name="all<?php echo "$nameID"; ?>" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="all<?php echo "$nameID"; ?>">
    <label class="form-check-label">
      <?php echo "All"; ?>
    </label>
  </div>

<!-- Loops through until all information from table is selected -->
  <?php do {


# Gets the name of the a row from the filter table e.g. 2012 or if it was the level table e.g. year 10
    $name = $filter_aa[$filtername];
    $filterID = $filter_aa[$nameID]; ?>


<!-- the information is then put into a checkbox in same format as above -->
    <div class="form-check" id="specific">
      <input class="form-check-input" name="specific<?php echo "$nameID $filterID"; ?>" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="specific<?php echo "$nameID"; ?>">
      <label class="form-check-label">
        <?php echo "$name"; ?>
      </label>
    </div>
<!-- loops until no more information to be gathered from the table -->
  <?php } while ($filter_aa = mysqli_fetch_assoc($filter_qry)); ?>


<!-- This Javascript is used to insure the checked status of all checkbox are working with the filters -->
  <script>
  $(document).ready(function(){
/* The $nameID is used so that by selecting the all checkbox in level for example, it only unchecks the specific filters in level and not all specific filters because the it is all in the same loop */
/* If all is checked uncheck all specific */

    $("#Clear_Filters").click(function() {
      $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", true);
      $('input[id="specific<?php echo "$nameID"; ?>"]').prop("checked", false);
      window.localStorage.clear();

    });

    $('input[id="all<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == true){
        $('input[id="specific<?php echo "$nameID"; ?>"]').prop("checked", false);
      }
    });
/* If a specfic is checked uncheck all */
    $('input[id="specific<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == true){
        $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", false);
      }
    });
/* If all specfics are being unchecked check all */
    $('input[id="specific<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == false){
/* Check for all specifics */
        var checked = $("#specific input[type=checkbox]:checked").length;
        if (checked == 0) {
          $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", true);
        }
      }
    });
/* Can't uncheck all if it is the only thing checked */
    $('input[id="all<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == false){
        $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", true);
      }
    });
  });
  </script>


<!-- Adds one to $a which then will change the filter that the loop gets information for -->
  <?php $a += 1;
# Loop will continue until $a <= 1 or when all filters have been looped
} while ($a <= 2); ?>



<!-- Attempt at epic checkboxes -->

<script>
$(document).ready(function(){
  var checkboxValues = JSON.parse(localStorage.getItem('checkboxValues')) || {};

  $("#<?php echo "$nameID"; ?>_All").click(function(){
    $("#<?php echo "$nameID"; ?>_All").prop("checked", true);
    $(".<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox").prop("checked", false);
    $("#<?php echo "$nameID"; ?>_All").each(function(){
    checkboxValues[this.id] = this.checked;
    });

    localStorage.setItem("checkboxValues", JSON.stringify(checkboxValues));
  });

  $(".<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox").click(function(){
    var checked = $(".<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox:checked").length;
    if (checked == 0) {
      $("#<?php echo "$nameID"; ?>_All").prop("checked", true);
    } else {
      $("#<?php echo "$nameID"; ?>_All").prop("checked", false);
    }
  });
});
</script>


<!-- Adds one to $a which then will change the filter that the loop gets information for -->
<?php $a += 1;
# Loop will continue until $a <= 1 or when all filters have been looped
} while ($a <= 2); ?>

<script>
$(document).ready(function(){
$("#Clear_Filters").click(function() {
  $(".All_Checkbox :checkbox").prop("checked", true);
  $(".Specific_Checkbox :checkbox").prop("checked", false);
  localStorage.clear();
});

$.each(checkboxValues, function(key, value) {
  $("#" + key).prop('checked', value);
});
});
</script>









<?php
function fetch_data() {
  $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");

  $yearID = $_GET['yearID'];
  $levelID = $_GET['levelID'];

  $output = '';
  $selected_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
  $selected_qry = mysqli_query($dbconnect, $selected_sql);
  $selected_aa = mysqli_fetch_assoc($selected_qry);

  do {
    $filename = $selected_aa["filename"];
    $image = "<img src='questions/$filename' class='img-fluid' style='height: 95px;'>";

    $output .= '
      <tr>
        <td> </td>
        <td>'.$image.'</td>
      </tr>';
  } while ($selected_aa = mysqli_fetch_assoc($selected_qry));
  return $output;
}

if (isset($_POST["create_pdf"])) {
  require_once("TCPDF-main/tcpdf.php");
  $obj_pdf = new TCPDF('p', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $obj_pdf->SetAutoPageBreak(TRUE, 10);

  $content = '';

  $content .= '<table class="table table-bordered">
    <tr>
      <th></th>
      <th></th>
    </tr';
  $content .= fetch_data();

  $content .= '</table>';

  $obj_pdf->writeHTMl($content);

  $obj_pdf->Output("", "I");
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <br /><br />
    <div class="container" style="width:700px;">
      <div class="table-responsive">
        <table class="table table-bordered">
          <?php
          echo fetch_data();
           ?>
        </table>
        <br />
        <form method="post">
          <input type="submit" name="create_pdf" class="btn btn-danger" value"Create Pdf" />
        </form>
      </div>
    </div>
  </body>
</html>

<td><img src="questions/'.$filename.'" class="img-fluid" style="height: 135px;"></td>



if ($a == 2) {
  $a = 0;
} if ($a == 0) {
  echo "<div class='border-sub col-6 mb-1 mr-1'>";
} if ($a == 1) {
  echo "<div class='border-sub col-6 mb-1'>";
} ?>









<?php
 function fetch_data()
 {

   $yearID = $_GET['yearID'];
   $levelID = $_GET['levelID'];

      $output = '';
      $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");
      $selected_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
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
 if(isset($_POST["create_pdf"]))
 {
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
 }
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>TESTING</title>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:700px;">
                <h3 align="center"></h3><br />
                <div class="table-responsive">
                     <table class="table table-bordered">
                          <tr>
                               <th></th>
                               <th></th>
                          </tr>
                     <?php
                     echo fetch_data();
                     ?>
                     </table>
                     <br />
                     <form method="post">
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />
                     </form>
                </div>
           </div>
      </body>
 </html>









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
  if(isset($_POST["create_pdf"]))
  {
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
  }
  ?>
  <!DOCTYPE html>
  <html>
       <head>
            <title>TESTING</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
       </head>
       <body>
            <br /><br />
            <div class="container" style="width:700px;">
                 <h3 align="center"></h3><br />
                 <div class="table-responsive">
                      <table class="table table-bordered">
                           <tr>
                                <th></th>
                                <th></th>
                           </tr>
                      <?php
                      echo fetch_data();
                      ?>
                      </table>
                      <br />
                      <form method="post">
                           <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />
                      </form>
                 </div>
            </div>
       </body>
  </html>







  <div class="jumbotron">
    <h1 class="display-4">Hello User</h1>
    <p class="lead">This is an early protoype of our cantamaths website that will allow you to use almost all of our planned technical features. However as you can probably tell there is still some visual work to go into it. Thanks :).</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="index.php?page=fifty-fifty" role="button">Get Started</a>
  </div>




  <ol class="breadcrumb bg-breadcrumbs" style="margin: 0px;">
    <li class="breadcrumb-item"><a class="breadcrumb-highlight" href="index.php">Home</a></li>
    <li class="breadcrumb-item breadcrumb-highlight">Custom/Past Paper</li>
    <li class="breadcrumb-item breadcrumb-disabled" >Select</li>
    <li class="breadcrumb-item breadcrumb-disabled">Print</li>
  </ol>

  <ol class="breadcrumb bg-breadcrumbs" style="margin: 0px;">
    <li class="breadcrumb-item"><a class="breadcrumb-highlight" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="breadcrumb-highlight" href="index.php?page=fifty-fifty">Custom/Past Paper</a></li>
    <li class="breadcrumb-item breadcrumb-highlight" >Select</li>
    <li class="breadcrumb-item breadcrumb-disabled">Print</li>
  </ol>



  <div class="row text-center h-100">
    <div class="border col-6">
      <a class="col-6" href="index.php?page=custom">Custom</a>
    </div>
    <div class="border col-6">
      <a class="col-6" href="index.php?page=past-papers">Past Papers</a>
    </div>
  </div>


  <div class="center-group px-3 py-4" style="height: 400px;">
    <div class="thing area-fill" style="max-width: 1100px;">
      <div class="col-6 pr-1 pr-sm-3 pr-lg-4">
        <div class="card">
        </div>
      </div>
      <div class="col-6 pl-1 pl-sm-3 pl-lg-4">
        <div class="card">
        </div>
      </div>
    </div>
  </div>

  <div class="page-fill px-3 py-4">
    <div class="flex-row area-fill">
      <div class="col-6 pr-2 pr-sm-3 pr-lg-4">
        <a class="btn btn-light border-general area-fill center-group" href="index.php?page=past-papers" role="button"><span class="option-center-text p-2">Past Papers</span></a>
      </div>
      <div class="col-6 pl-2 pl-sm-3 pl-lg-4">
        <a class="btn btn-light border-general area-fill center-group" href="index.php?page=select-index" role="button"><span class="option-center-text p-2">Custom</span></a>
      </div>
    </div>
  </div>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style media="screen">
  html,
  body,
  .full-screen {
    height: 100%;
  }
  body {
    margin: 0;
  }
  .full-screen {
    display: flex;
    overflow: hidden;
    flex-direction: column;
  }
  .full-screen > * {
    flex: 0 0 auto;
    overflow: hidden;
  }
  .full-screen > .header,
  .full-screen > .footer {
    height: 50px;
    background: #555;
    color: white;
  }
  .full-screen > .main {
    flex: 1 1 auto;
    display: flex;
    overflow: hidden;
  }
  .full-screen > .main > * {
    flex: 0 0 auto;
    overflow: auto;
  }
  .full-screen > .main > .left,
  .full-screen > .main > .right {
    width: 200px;
    background: #eee;
  }
  .full-screen > .main > .middle {
    flex: 1 1 auto;
  }
</style>
<title></title>
</head>
<body>
<div class="full-screen">
  <div class="header">Header</div>
  <div class="main">
    <div class="left">Menu-stuff here. No way this will fit.
      <ul>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
        <li>Menu Entry</li>
      </ul>
    </div>
    <div class="middle">Large stuff here</div>
    <div class="right">Another sidebar</div>
  </div>
  <div class="footer">Footer  </div>
</div>
</body>
</html>














<?php include("filter-to-in.php");

if (isset($_SESSION['tagID'])) {
  unset($_SESSION['questionID']);
  $_SESSION['questionID'] = [];


  $tag = implode("','",$_SESSION['tagID']);
  $tagsql = "IN ('".$tag."')";

  $tag_sql = "SELECT DISTINCT questionID FROM questiontag WHERE tagID $tagsql";
  $tag_qry = mysqli_query($dbconnect, $tag_sql);
  if (mysqli_num_rows($tag_qry)==0) {
  } else {
      $tag_aa = mysqli_fetch_assoc($tag_qry);
    }
  do {
    $SquestionID = $tag_aa['questionID'];
    if (in_array($SquestionID,$_SESSION['questionID'])) {
    } else {
      array_push($_SESSION['questionID'],$SquestionID);
    }
  } while ($tag_aa = mysqli_fetch_assoc($tag_qry));

  $questionID = implode("','",$_SESSION['questionID']);
  $questionIDsql = "IN ('".$questionID."')";
} else {
  $questionIDsql = "";
} ?>


<div class="py-2">
  <div class="py-1 px-2 border-header">
    <p style="margin: 0px; font-weight: 500;">Results to of</p>
  </div>
</div>


<?php $select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";

$order = "ORDER BY question.yearID DESC, question.levelID ASC, question.qnumber ASC";

# Selects all from table question where each column is the same as the filters
# If the variable set above is blank then it will select all from that column otherwise only selects those that where in the array
$question_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql and question.questionID $questionIDsql $order";
$question_qry = mysqli_query($dbconnect, $question_sql);
if (mysqli_num_rows($question_qry)==0) {
} else {
  $question_aa = mysqli_fetch_assoc($question_qry);



  echo "<div class='container-fluid row pt-1' style='margin: 0px; padding: 0px;'>";
# Runs through and displays all questions that condcide with the selected filters
    $a = 0;
    do {
      $qnumber = $question_aa['qnumber'];
      $yearname = $question_aa['yearname'];
      $levelname = $question_aa['levelname'];
      $filename = $question_aa['filename'];
      $QquestionID = $question_aa['questionID'];

      $_SESSION["Tags'".$QquestionID."'"] = [];

      $questionID_sql = "SELECT DISTINCT tagname FROM questiontag INNER JOIN tag ON questiontag.tagID = tag.tagID WHERE questionID = $QquestionID";
      $questionID_qry = mysqli_query($dbconnect, $questionID_sql);
      $questionID_aa = mysqli_fetch_assoc($questionID_qry);

      if (!$questionID_aa) {
      } else {
        do {
          $tagname = $questionID_aa['tagname'];
          array_push($_SESSION["Tags'".$QquestionID."'"],$tagname);
        } while ($questionID_aa = mysqli_fetch_assoc($questionID_qry));
      } ?>



      <div id="div_Qclick <?php echo "$QquestionID"; ?>" class='col-6 border-sub mb-2' style="padding: 0px;">
        <input type="checkbox" style='display:none;' id="Qclick <?php echo "$QquestionID"; ?>" onclick="send_selected(<?php echo "'$QquestionID'"; ?>), highlight_selected(<?php echo "'$QquestionID'"; ?>)">
        <label class="container-fluid" style="margin: 0px;" for='Qclick <?php echo "$QquestionID"; ?>'>
          <div class='row'>
            <?php echo "<div style='padding: 0px; line-height: 1.4; top: 50%;' class='col-4 text-center'>";
              echo nl2br("Question $qnumber \n");
              echo nl2br("$yearname \n");
              echo nl2br("Year $levelname \n");
              echo "Tags";
            echo "</div>";

            echo "<div class='col-8' style='padding: 0px;'>";
# displays the image with the filename
              echo "<img src='questions/$filename' class='img-fluid'>";
            echo "</div>";
          echo "</div>";
        echo "</label>";
      echo "</div>";
# Repeats until all questions have been displayed
    } while ($question_aa = mysqli_fetch_assoc($question_qry));
  echo "</div>";
} ?>




<?php
 function fetch_data()
 {

   $yearID = $_GET['yearID'];
   $levelID = $_GET['levelID'];

      $output = '';
      $dbconnect = mysqli_connect("localhost", "root", "", "cantamathsdb");
      $selected_sql = "SELECT filename, answer FROM question WHERE yearID = $yearID and levelID = $levelID";
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


           </tr>
      ';
      $content .= fetch_data();
      $content .= '</table>';
      $obj_pdf->writeHTML($content);
      $obj_pdf->Output('sample.pdf', 'I');

 ?>



 <table class="table table-bordered">
   <?php if ($select_page == "custom") {
     include("print-display-custom-sql.php");
   } elseif ($select_page == "pastpapers") {
     include("print-display-past-papers-sql.php");
   }


   $question_qry = mysqli_query($dbconnect, $question_sql);
   $question_aa = mysqli_fetch_assoc($question_qry);

   do {
     $filename = $question_aa['filename']; ?>

     <tr>
       <td style="width: 10%;"></td>
       <?php echo "<td><img src='questions/$filename' class='img-fluid'></td>" ?>
     </tr>

   <?php } while ($question_aa = mysqli_fetch_assoc($question_qry)); ?>
 </table>
