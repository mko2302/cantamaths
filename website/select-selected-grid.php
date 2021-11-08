<div class="col-12 px-clear p-1">
  <input type="checkbox" onclick="send_selected(<?php echo "'$QquestionID'"; ?>, 'filler', 'filler'), send_filters('filler', 'refresh')" style="display:none;">
  <label class="area-fill" style="margin: 0px;">
    <div class="card border-sub border-selected">
      <div class="flex-row area-fill">
        <div class="col-4 px-clear border-sub-r center text-center">
          <?php echo nl2br("$yearname \n");
          echo nl2br("Year $levelname \n"); ?>
        </div>
        <div class="col-8 px-clear">
          <?php echo "<img src='questions/$filename' class='img-fluid'>"; ?>
        </div>
      </div>
    </div>
  </label>
</div>
