<?php
if(isset($_SESSION['levelID'])) {
  unset($_SESSION['levelID']);
}
if(isset($_SESSION['yearID'])) {
  unset($_SESSION['yearID']);
}
if(isset($_SESSION['tagID'])) {
   unset($_SESSION['tagID']);
} ?>

<div id="pagination_id">
  <div class="bg-select py-3 container-fluid row" style="margin: 0px; font-size: 15px;">
    <div class="col-2">
      <div class="col-12 bg-white">
    <?php include("custom-filter-checkboxes.php") ?>
  </div>
</div>
</div>

<div class="col-10 row" style="margin: 0px; padding: 0px;">
  <div class="col-8">
    <div class="col-12 bg-white" style="height: 100%;">
      <div id="Custom_Question">
    <?php include("custom-question-display.php") ?>
  </div>
</div>
</div>

<div class="col-4">
  <div class="col-12 bg-white" style="height: 100%;">
  <div id="Custom_Selected">
    <?php include("custom-selected.php")?>
  </div>
</div>
</div>
</div>
</div>


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
      document.getElementById("Custom_Question").innerHTML = this.responseText;
    }
  };
/* Uses GET array to send through the filter and id through to php page which will display the selected filters on a page */
  xhttp.open("GET", "custom-question.php?filter=" + filter + "&id=" + id, true);
  xhttp.send();
}


function send_selected(question) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Custom_Selected").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "custom-selected.php?questionID=" + question, true);
  xhttp.send();
}

function highlight_selected(question) {
  var element = document.getElementById("div_Qclick " + question);
  element.classList.add("border-selected");
}
</script>
