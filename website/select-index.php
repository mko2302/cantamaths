<?php
// retrieving the selected page from option select
$select_page = $_GET['select'];
$_SESSION['alex!'] = [$select_page];

// Unsetting all filters on page refresh
if(isset($_SESSION['levelID'])) {
  unset($_SESSION['levelID']);
}
if(isset($_SESSION['yearID'])) {
  unset($_SESSION['yearID']);
}
if(isset($_SESSION['tagID'])) {
   unset($_SESSION['tagID']);
} ?>
<!-- Page-fill, fills remaining space using flex-grow -->
<div class="page-fill center-x">
  <div class="flex-row area-fill page-resize px-4 px-xl-5 py-4">
    <div class="col-2 px-clear pr-2 area-fill">
      <div class="card border-clear px-3 py-2">
        <?php include("filter-checkboxes.php") ?>
      </div>
    </div>
    <!-- col-10 so pages can be evenly sized -->
    <div class="flex-row col-10 px-clear area-fill">
      <div class="col-8 px-clear px-2 area-fill">
        <div class="card border-clear px-3 py-2" id="display">
          <!-- Area that will be replaced by AJAX -->
          <?php include("select-display.php"); ?>
        </div>
      </div>
      <div class="col-4 px-clear pl-2 area-fill">
        <div class="card border-clear px-3 py-2" id="selected">
          <!-- Area that will be replaced by AJAX -->
          <?php include("select-selected.php"); ?>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
function send_filters(filter, id) {
  var select_page = '<?=$select_page?>';
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
  xhttp.open("GET", "select-filtered-display.php?filter=" + filter + "&id=" + id + "&select_page=" + select_page, true);
  xhttp.send();
}

// The same as function above except sending different variable
function send_selected(question, year, level) {
  var select_page = '<?=$select_page?>';
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("selected").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "select-selected-ajax.php?questionID=" + question + "&yearID=" + year + "&levelID=" + level + "&select_page=" + select_page, true);
  xhttp.send();
}
// Upon clicking a question/past paper it will toggle the border
function highlight_selected(question, year, level) {
  var select_page = '<?=$select_page?>';
  if (select_page == 'custom') {
    var element = document.getElementById("div_Qclick" + "-" + question + "-" + year + "-" + level);
    element.classList.toggle("border-selected");
  }
  if (select_page == 'pastpapers') {
    $("div[name*='icon']").removeClass("border-selected");

    var element = document.getElementById("div_Qclick" + "-" + question + "-" + year + "-" + level);
    element.classList.add("border-selected");
  }
}
</script>
