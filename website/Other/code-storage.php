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
