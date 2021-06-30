<!-- Runs loop throught the filter and on each loop gets information about a different filter -->
<?php $a = 0;
do {
  if ($a == 0) {
    $filter = "tag";
    $nameID = "tagID";
    $filtername = "tagname";
  } if ($a == 1) {
    $filter = "level";
    $nameID = "levelID";
    $filtername = "levelname";
  } if ($a == 2) {
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
  <div class="form-check">
<!-- LoadDoc information is sent through to the ajax Javascript for filtering --> <!-- $nameID in id is to differentiate from other filters -->
    <input checked class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo "'all'"; ?>)" id="all<?php echo "$nameID"; ?>">
    <label class="form-check-label">
      <?php echo "All"; ?>
    </label>
  </div>


<!-- Loops through until all information from table is selected -->
  <?php do {

# Gets the name of the a row from the filter table e.g. 2012 or if it was the level table e.g. year 10
    $name = $filter_aa[$filtername];
    $filterID = $filter_aa[$nameID]; ?>


<!-- the information is then put into a checkbox in same format as above -->
    <div class="form-check" id="test">
      <input class="form-check-input" type="checkbox" onclick="send_filters(<?php echo "'$nameID'"; ?>, <?php echo $filterID; ?>)" id="specific<?php echo "$nameID"; ?>">
      <label class="form-check-label">
        <?php echo "$name"; ?>
      </label>
    </div>
<!-- loops until no more information to be gathered from the table -->
  <?php } while ($filter_aa = mysqli_fetch_assoc($filter_qry)); ?>


<!-- This Javascript is used to insure the checked status of all checkbox are working with the filters -->
  <script>
  $(document).ready(function(){
/* The $nameID is used so that by selecting the all checkbox in level for example, it only unchecks the specific filters in level and not all specific filters because the it is all in the same loop */
/* If all is checked uncheck all specific */
    $('input[id="all<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == true){
        $('input[id="specific<?php echo "$nameID"; ?>"]').prop("checked", false);
      }
    });
/* If a specfic is checked uncheck all */
    $('input[id="specific<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == true){
        $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", false);
      }
    });
/* If all specfics are being unchecked check all */
    $('input[id="specific<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == false){
/* Check for all specifics */
        var checked = $("#test input[type=checkbox]:checked").length;
        if (checked == 0) {
          $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", true);
        }
      }
    });
/* Can't uncheck all if it is the only thing checked */
    $('input[id="all<?php echo "$nameID"; ?>"]').click(function(){
      if($(this).prop("checked") == false){
        $('input[id="all<?php echo "$nameID"; ?>"]').prop("checked", true);
      }
    });
  });
  </script>


<!-- Adds one to $a which then will change the filter that the loop gets information for -->
  <?php $a += 1;
# Loop will continue until $a <= 1 or when all filters have been looped
} while ($a <= 2); ?>
