<!-- Runs loop throught the filter and on each loop gets information about a different filter -->
<?php for ($i=0; $i <= 2 ; $i++) {
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
    <input checked class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="all<?php echo "$nameID"; ?>">
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
    <div class="form-check" id="test">
      <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="specific<?php echo "$nameID"; ?>">
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
        var checked = $("#test input[type=checkbox]:checked").length;
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
<!-- Loop will continue until $a <= 1 or when all filters have been looped -->
<?php } ?>

<script>
$(document).ready(function(){
/* The $nameID is used so that by selecting the all checkbox in level for example, it only unchecks the specific filters in level and not all specific filters because the it is all in the same loop */
/* If all is checked uncheck all specific */
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
      var checked = $("#test input[type=checkbox]:checked").length;
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

<script>
/* filter and id are the information sent through in laodDoc()*/
/* filter = what the filter is e.g. year */
/* id = the id of the specific filter e.g. 2012 */
function send_filters(filter, id) {
/* Sets up a http request which allow ajax to send information without reloading the page */
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
/* error catching */
    if (this.readyState == 4 && this.status == 200) {
/* States where the information that ajax recieves should be displayed
(div id="select") */
      document.getElementById("display").innerHTML = this.responseText;
    }
  };
/* Uses GET array to send through the filter and id through to php page which will display the selected filters on a page */
  xhttp.open("GET", "GetDisplay.php?filter=" + filter + "&id=" + id, true);
  xhttp.send();
}
</script>

<div class="form-check" id="test">
  <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="specific<?php echo "$nameID"; ?>">
  <label class="form-check-label">
    <?php echo "$name"; ?>
  </label>
</div>

<?php session_start();


# Connects to the database
$dbconnect = mysqli_connect("localhost", "root", "", "cantamathdb");

# Recieves information sent through by ajax in the GET array
$id = $_GET['id'];
$filter = $_GET['filter'];
# If the checkbox selected was all then it unsets the session of the filter that it is assigned to
if ($id == 'all') {
  unset($_SESSION[$filter]);
} else {
# If the checkbox selected was not all, then check if there the filter is set (any active filters)
  if (isset($_SESSION[$filter])) {
# If there are active filters, check if the the id of the checkbox is already in the filter array
    if (in_array($id,$_SESSION[$filter])) {
# If it is remove it from filter (note: This would be if checkbox is being unchecked)
      if (($key = array_search($id, $_SESSION[$filter])) !== FALSE) {
        unset($_SESSION[$filter][$key]);
      }
# Otherwise add id of checkbox to its filter
    } else {
      array_push($_SESSION[$filter],$id);
    }
# If the filter is unset then set it and add the id of the checkbox to the array
  } else {
  $_SESSION[$filter] = [$id];
  }
# If a filter is empty then unset the array
  if (empty($_SESSION[$filter])) {
    unset($_SESSION[$filter]);
  }
}


include("Display.php") ?>
<?php
# If the checkbox selected was all then it unsets the session of the filter that it is assigned to
# If the checkbox selected was not all, then check if there the filter is set (any active filters)
  if (isset($_SESSION[$array])) {
# If there are active filters, check if the the id of the checkbox is already in the filter array
    if (in_array($id,$_SESSION[$array])) {
# If it is remove it from filter (note: This would be if checkbox is being unchecked)
      if (($key = array_search($id, $_SESSION[$array])) !== FALSE) {
        unset($_SESSION[$array][$key]);
      }
# Otherwise add id of checkbox to its filter
    } else {
      array_push($_SESSION[$array],$id);
    }
# If the filter is unset then set it and add the id of the checkbox to the array
  } else {
  $_SESSION[$array] = [$id];
  }

# If a filter is empty then unset the array
  if (empty($_SESSION[$array])) {
    unset($_SESSION[$array]);
  }





if (isset($_SESSION['levelID'])) {
  $level = implode("','",$_SESSION['levelID']);
  $levelsql = "IN ('".$level."')";
} else {
  $levelsql = "";
}



$question_sql = "$select WHERE question.yearID $yearsql and question.levelID $levelsql and question.questionID $questionIDsql";


$select = "SELECT question.questionID, question.filename, question.answer, question.yearID, year.yearname, question.levelID, level.levelname, question.qnumber FROM question
                INNER JOIN year ON question.yearid = year.yearID
                INNER JOIN level ON question.levelID = level.levelID";
                
?>
