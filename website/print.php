<?php
// Getting the page type from URL
$select_page = $_GET['select'];
// Setting Page type as session so can be easily access
$_SESSION['alex!'] = [$select_page];
// Set the default print type as worksheet
$print_type = "worksheet"; ?>

<!-- Fill the remaining space of page using flex-grow -->
<div class="page-fill center-x">
  <div class="flex-row display-region page-resize py-4">
    <div class="col-9 px-clear pr-1 area-fill">
      <div class="card border-clear px-3 py-2">
        <h2>Preview</h2>
        <div class="page-fill-scroll border-general">
          <!-- Area of page that will be replaced with AJAX function -->
          <div id="print-display">
            <table class="table table-bordered">
              <?php $print_type = "worksheet";
// Include page to display preview
              include("print-pdf-sql.php");
              echo $output; ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3 px-clear pl-1 area-fill">
      <div class="col-12 px-clear flex-row">
        <div class="col-12 pb-1 px-clear">
<!-- Set checkboxes as display none and have <p> fill area -->
<!-- Set checkboxes as radio meaning only one can be clicked at a time -->
<!-- Onclick for all checkboxes will summon AJAX function to change the preview -->
          <input checked type="radio" class="area-fill input-print" style="display: none;" onclick="print_display_reload()" id="worksheet" name="print-button">
          <label class="area-fill print-option-style margin-clear" for="worksheet">
            <p class="margin-clear p-2 pl-3 font-boldish">Worksheet</p>
          </label>
        </div>
        <div class="col-12 py-1 px-clear">
          <input type="radio" class="area-fill input-print" style="display: none;" onclick="" id="competition" name="print-button">
          <label class="area-fill print-option-style margin-clear" for="competition">
<!-- Another input inside that the user uses to select the number of teams -->
<!-- oninput checks if the code is valid to be entered in the displayed field  -->
            <label for="teams" class="margin-clear p-2 px-3 pr-4 font-boldish" onclick="team_text(), print_display_reload()">Competition</label>
            <input type="number" min="2" max="10" step="1" oninput="print_display_reload(), validity.valid||(value='');" onchange="" id="teams" name="teams" value="" onclick="team_text(), print_display_reload()">
          </label>
        </div>
        <div class="col-12 py-1 px-clear">
          <input type="radio" class="area-fill input-print" style="display: none;" onclick="print_display_reload()" id="answers" name="print-button">
          <label class="area-fill print-option-style margin-clear" for="answers">
            <p class="margin-clear p-2 pl-3 font-boldish">Answers</p>
          </label>
        </div>
        <button type="button" class="btn btn-danger btn-block p-1 mt-1 font-boldish" onclick="print(<?php echo "'$select_page'"; ?>)" role="button">Print</button>
      </div>
    </div>
  </div>
</div>


<script>
// Function to set the competition checkbox as checked
// This is needed as the user may select the inner input which wouldn't set the checkbox as checked
function team_text() {
  $("#competition").prop("checked", true);
}
// Function to send the print type and print the worksheet
function print(select_page) {
  var print_type_value = document.querySelector('input[name="print-button"]:checked').id;
  if (print_type_value == "competition") {
// If the print type is competition it insures there is a valid team amount
    var teams = document.querySelector('input[name="teams"]').value;
    if (teams > 1 && teams < 11) {
// Then send through the print type and team amount to the printing page
      window.open("print-pdf.php?select=" + select_page + "&print_type=" + print_type_value + "&teams=" + teams);
    } else {
// If there is an invalid number of teams display this message
      alert("Invalid number of teams. Note: Maximum number of teams is 10.");
    }
  } else {
// If the print type is note competition then just send through the printy type
    window.open("print-pdf.php?select=" + select_page + "&print_type=" + print_type_value);
  }
}

// AJAX function to reload preview
function print_display_reload() {
// Get the page type
  var select_page = '<?=$select_page?>';
// Get the checked checkboxes id
  var print_type_value = document.querySelector('input[name="print-button"]:checked').id;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
// Replace element
      document.getElementById("print-display").innerHTML = this.responseText;
    }
  };
  if (print_type_value == "competition") {
// Same as print function above
    var teams = document.querySelector('input[name="teams"]').value;
    if (teams > 1 && teams < 11) {
// Instead of sending to print PDF, send to print-display
      xhttp.open("GET", "print-display.php?select=" + select_page + "&print_type=" + print_type_value + "&teams=" + teams, true);
      xhttp.send();
    } else {
    }
  } else {
  xhttp.open("GET", "print-display.php?select=" + select_page + "&print_type=" + print_type_value, true);
  xhttp.send();
  }
}
</script>
