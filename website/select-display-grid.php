<div class="col-6 px-clear p-1">
  <input type="checkbox" class="area-fill" style="display:none;" onclick="send_selected(<?php include("icon-id.php"); ?>), highlight_selected(<?php include("icon-id.php"); ?>)" id="<?php include("icon-id.php"); ?>">
  <label class="area-fill" style="margin: 0px;" for="<?php include("icon-id.php"); ?>">
    <?php if ($select_page == "custom") {
      if (isset($_SESSION['Q_ID'])) {
        if (in_array($QquestionID,$_SESSION['Q_ID'])) {
          include("icon-selected.php");
        } else {
          include("icon-unselected.php");
        }
      } else {
        include("icon-unselected.php");
      }
    } else {
      if(isset($_SESSION['selected-yearID']) && isset($_SESSION['selected-levelID'])) {
        if (in_array($yearID,$_SESSION['selected-yearID']) && in_array($levelID, $_SESSION['selected-levelID'])) {
          include("icon-selected.php");
        } else {
          include("icon-unselected.php");
        }
      } else {
        include("icon-unselected.php");
      }
    } ?>
      <div class="flex-row area-fill">
        <div class="col-4 px-clear border-sub-r center text-center">
          <?php echo nl2br("$yearname \n");
          echo nl2br("Year $levelname \n"); ?>
        </div>
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
