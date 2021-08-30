<?php

if(isset($_SESSION['levelID'])) {
  unset($_SESSION['levelID']);
}
if(isset($_SESSION['yearID'])) {
  unset($_SESSION['yearID']);
} ?>


<div class="bg-select py-3 container-fluid row" style="margin: 0px; font-size: 15px;">
  <div class="col-2">
    <div class="col-12 bg-white">
      <?php include("past-papers-filter-checkboxes.php") ?>
    </div>
  </div>

  <div class="col-10 row" style="margin: 0px; padding: 0px;">
    <div class="col-8">
      <div class="col-12 bg-white" style="height: 100%;">
        <div id="Past_Papers_Display">
          <?php include("past-papers-display.php") ?>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="col-12 bg-white" style="height: 100%;">
        <div id="Past_Papers_Selected">
          <div class="py-2">
            <div class="py-1 px-2 border-header">
              <p style="margin: 0px; font-weight: 500;">Selected:</p>
            </div>
          </div>
          <div class="pt-1 pb-2">
            <?php echo "<a style='font-size: 15px; font-weight: 500; margin: 0px; padding: 0px;' class='btn btn-block btn-danger p-1 disabled' href='past-paper-print.php?yearID=$yearID&levelID=$levelID' role='button'>Next</a>"; ?>
          </div>
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
      document.getElementById("Past_Papers_Display").innerHTML = this.responseText;
    }
  };
/* Uses GET array to send through the filter and id through to php page which will display the selected filters on a page */
  xhttp.open("GET", "past-papers-filtered-display.php?filter=" + filter + "&id=" + id, true);
  xhttp.send();
}
</script>

<script>
function send_selected(yearID, levelID) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Past_Papers_Selected").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "past-papers-selected.php?yearID=" + yearID + "&levelID=" + levelID, true);
  xhttp.send();
}
</script>
