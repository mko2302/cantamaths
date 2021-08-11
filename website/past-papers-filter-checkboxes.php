<button type="button" class="btn" onclick="send_filters('beans', 'clear')" id="Clear_Filters">Clear All Filters</button>
<br>


<!-- Runs loop throught the filter and on each loop gets information about a different filter -->
<?php $a = 0;
do {
  if ($a == 0) {
    $filter = "level";
    $nameID = "levelID";
    $filtername = "levelname";
  } if ($a == 1) {
    $filter = "year";
    $nameID = "yearID";
    $filtername = "yearname";
  }


# Selects from all information from the table of the current filter being looped
  $filter_sql = "SELECT * FROM $filter ORDER BY $filtername desc";
  $filter_qry = mysqli_query($dbconnect, $filter_sql);
  $filter_aa = mysqli_fetch_assoc($filter_qry);


  echo $filter; ?>

<!-- Displays checkbox for selection all filters -->
  <div class="All_Checkbox">
    <div class="form-check">
      <input checked class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="<?php echo "$nameID"; ?>_All">
      <label class="form-check-label">
        <?php echo "All"; ?>
      </label>
    </div>
  </div>

<!-- Loops through until all information from table is selected -->
  <?php do {


# Gets the name of the a row from the filter table e.g. 2012 or if it was the level table e.g. year 10
    $name = $filter_aa[$filtername];
    $filterID = $filter_aa[$nameID]; ?>


<!-- the information is then put into a checkbox in same format as above -->
    <div class="Specific_Checkbox">
      <div class="<?php echo "$nameID"; ?>_Specific_Checkbox">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="<?php echo "$nameID"."_"."$filterID"; ?>">
          <label class="form-check-label">
            <?php echo "$name"; ?>
          </label>
        </div>
      </div>
    </div>
<!-- loops until no more information to be gathered from the table -->
  <?php } while ($filter_aa = mysqli_fetch_assoc($filter_qry)); ?>


  <script>
  $(document).ready(function(){
    $("#<?php echo "$nameID"; ?>_All").click(function(){
      $("#<?php echo "$nameID"; ?>_All").prop("checked", true);
      $(".<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox").prop("checked", false);
    });

    $(".<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox").click(function(){
      var checked = $(".<?php echo "$nameID"; ?>_Specific_Checkbox :checkbox:checked").length;
      if (checked == 0) {
        $("#<?php echo "$nameID"; ?>_All").prop("checked", true);
      } else {
        $("#<?php echo "$nameID"; ?>_All").prop("checked", false);
      }
    });
  });
  </script>


<!-- Adds one to $a which then will change the filter that the loop gets information for -->
  <?php $a += 1;
# Loop will continue until $a <= 1 or when all filters have been looped
} while ($a <= 1); ?>

<script>
$(document).ready(function(){
  $("#Clear_Filters").click(function() {
    $(".All_Checkbox :checkbox").prop("checked", true);
    $(".Specific_Checkbox :checkbox").prop("checked", false);
  });
});
</script>