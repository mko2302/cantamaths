<?php $select_page = $_GET['select']; ?>

<div class="page-fill center-x">
  <div class="flex-row area-fill page-resize px-4 px-xl-5 py-4">
    <div class="col-2 px-clear pr-2 area-fill">
      <div class="card border-clear px-3 py-2">
        <?php include("filter-checkboxes.php") ?>
      </div>
    </div>
    <div class="flex-row col-10 px-clear area-fill">
      <div class="col-8 px-clear px-2 area-fill">
        <div class="card border-clear px-3 py-2" id="display">
          <?php include("select-display.php"); ?>
        </div>
      </div>
      <div class="col-4 px-clear pl-2 area-fill">
        <div class="card border-clear" id="selected">
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
</script>
