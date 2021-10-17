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

<div class="row">
  <div class="col-5">
    <h1>Question Database</h1>
  </div>
  <div class="col-4">
    <!-- check status to see if there was an error -->
    <?php include("status.php"); ?>

  </div>
</div>

<div class="row">
  <!-- div with filters -->
  <div class="col-2">
    <?php include("custom-filter-database.php") ?>
  </div>
  <!-- question table -->
  <div class="col-10">
    <div class="admin-scroll" id="Custom_Database">
      <?php include("display-question-db.php") ?>
    </div>
  </div>
</div>

<script type="text/javascript">
//jquery paeinaition function to display right question page
function fetch_data(page){
   $.ajax({
      url: "custom-database.php",
      method: "POST",
      data: {
         page: page
      },
      success: function(data){
         $("#Custom_Database").html(data);
      }
   });
}

//if user clicks on paginaiton, change page
$(document).on("click", ".page-item", function(){
         var page = $(this).attr("value");
         fetch_data(page);
      })

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
      document.getElementById("Custom_Database").innerHTML = this.responseText;
    }
  };
/* Uses GET array to send through the filter and id through to php page which will display the selected filters on a page */
  xhttp.open("GET", "custom-database.php?filter=" + filter + "&id=" + id, true);
  xhttp.send();
}

</script>
