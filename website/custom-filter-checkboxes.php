<div class="py-2">
  <div class="py-1 text-center border-header">
    <p style="margin: 0px; font-weight: 500;">Filters</p>
  </div>
  

<div class="pt-1">
  <button type="button" style="font-weight: 500; font-size: 15px; margin: 0px; padding: 0px;" class="btn btn-danger btn-block p-1" onclick="send_filters('beans', 'clear')" id="Clear_Filters">Clear All Filters</button>
</div>


<!-- Runs loop throught the filter and on each loop gets information about a different filter -->
<?php $a = 0;
do {
  if ($a == 0) {
    $filter = "tag";
    $nameID = "tagID";
    $filtername = "tagname";
    $header = "Tags";
    echo "<div class='pt-2'>";
  } if ($a == 1) {
    $filter = "level";
    $nameID = "levelID";
    $filtername = "levelname";
    $header = "Level";
    echo "<div class='pt-2'>";
  } if ($a == 2) {
    $filter = "year";
    $nameID = "yearID";
    $filtername = "yearname";
    $header = "Year";
    echo "<div class='py-2'>";
  }


# Selects from all information from the table of the current filter being looped
    $filter_sql = "SELECT * FROM $filter ORDER BY $filtername desc";
    $filter_qry = mysqli_query($dbconnect, $filter_sql);
    $filter_aa = mysqli_fetch_assoc($filter_qry);

    echo "<div class='p-1 border-sub' style='line-height: 1.2;'>";
      echo "<div class='py-1'>";
        echo "<p style='margin: 0px; font-weight: 500;'>$header</p>"; ?>
      </div>

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
    </div>
  </div>


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
} while ($a <= 2); ?>


<script>
$(document).ready(function(){
  $("#Clear_Filters").click(function() {
    $(".All_Checkbox :checkbox").prop("checked", true);
    $(".Specific_Checkbox :checkbox").prop("checked", false);
  });
});
</script>
