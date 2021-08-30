<style>
body {
  background-color: #FAFAFC;
}
</style>

<?php
$yearID = $_GET['yearID'];
$levelID = $_GET['levelID'];

?>
<div class="container py-3 col-6">
  <div class="row">
    <div class="col-8 py-2" style="background-color: #FFFFFF;">
      <h2>Preview</h2>
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <div id="Preview"></div>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-4">
      <button id="worksheet_button" type="button" class="btn btn-light btn-block" style="color: #EB0A00; font-size: 20px;" onclick="preview(worksheet_button, 0, <?php echo "'$yearID'"; ?>, <?php echo "'$levelID'"; ?>)">Worksheet</button>

      <?php
      echo "<a style='font-size: 15px; font-weight: 500; margin: 0px; padding: 0px;' class='btn btn-block btn-danger p-1' href='print.php?yearID=$yearID&levelID=$levelID' role='button'>Next</a>";
      ?>
    </div>
  </div>
</div>


<script>
function preview(id, amount, yearID, levelID) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Preview").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "print-ajax.php?yearID=" + yearID + "&levelID=" + levelID, true);
  xhttp.send();
}
</script>
