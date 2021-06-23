<?php session_start();

# Checks if filters are set and if so clears the sessions they are in
# Level filters
if(isset($_SESSION['levelID'])) {
  unset($_SESSION['levelID']);
}

# Year filters
if(isset($_SESSION['yearID'])) {
  unset($_SESSION['yearID']);
}

# Tag filters
if(isset($_SESSION['tagID'])) {
   unset($_SESSION['tagID']);
} ?>


<div class="container-fluid row">
    <div class="col-2">
      <?php include("filter.php") ?>
    </div>


    <div class="col-8" id="display">
      <?php include("Display.php") ?>
    </div>


    <div class="col-2" id="selected">

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
      document.getElementById("display").innerHTML = this.responseText;
    }
  };
/* Uses GET array to send through the filter and id through to php page which will display the selected filters on a page */
  xhttp.open("GET", "GetDisplay.php?filter=" + filter + "&id=" + id, true);
  xhttp.send();
}
</script>


<script>
function send_selected(question) {
  alert(question)
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("selected").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "selected.php?", true);
  xhttp.send();
}
</script>
