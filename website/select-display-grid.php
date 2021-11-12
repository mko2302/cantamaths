<!-- Display questions/past papers on two columns -->
<div class="col-6 px-clear p-1">
<!-- Set the area as a checkbox with display none -->
<!-- Onclick() event summons AJAX code to send the variables to Selected -->
  <input type="checkbox" class="area-fill" style="display:none;" onclick="send_selected(<?php include("icon-id.php"); ?>), highlight_selected(<?php include("icon-id.php"); ?>)" id="<?php include("icon-id.php"); ?>">
  <label class="area-fill hover-pointer" style="margin: 0px;" for="<?php include("icon-id.php"); ?>">
    <?php if ($select_page == "custom") {
      if (isset($_SESSION['Q_ID'])) {
        if (in_array($QquestionID,$_SESSION['Q_ID'])) {
// If the question is in the selected question the have the selected border around it
          include("icon-selected.php");
        } else {
// If the question is not in the selected question do not have selected border around it
          include("icon-unselected.php");
        }
      } else {
// If there are no Selected questions do not have selected border around question
        include("icon-unselected.php");
      }
    } else {
      if(isset($_SESSION['selected-yearID']) && isset($_SESSION['selected-levelID'])) {
        if (in_array($yearID,$_SESSION['selected-yearID']) && in_array($levelID, $_SESSION['selected-levelID'])) {
// If the past paper has been selected have the selected border
          include("icon-selected.php");
        } else {
// If the past paper has not been selected do not have the selected border
          include("icon-unselected.php");
        }
      } else {
// If no past papers have been selected do not have the selected border
        include("icon-unselected.php");
      }
    } ?>
<!-- Display the date of publication and year level on the left side of question/past paper -->
      <div class="flex-row area-fill">
        <div class="col-4 px-clear border-sub-r center text-center">
          <?php echo nl2br("$yearname \n");
          echo nl2br("Year $levelname \n");
?>
        </div>
<!-- Display question image or "past paper" on the right side -->
        <div class="col-8 px-clear">
          <?php if ($select_page == "custom") {
            echo "<img src='questions/$filename' class='img-fluid'>";
          } else { ?>
            <h2 class="text-center py-3">Past Paper</h2>
          <?php } ?>
        </div>
      </div>
    </div>
  </label>
</div>
