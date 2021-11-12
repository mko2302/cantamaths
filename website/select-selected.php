<?php
// Gets the type of page (custom or past papers)
if (isset($_GET['select_page'])) {
  $select_page = $_GET['select_page'];
} ?>
<!-- Display header -->
<div class="px-2 py-1 mb-2 border-header">
  <span class="font-boldish">Selected</span>
</div>
<?php if($select_page == "custom") {

  $array = 'Q_ID';
// Get the selected question from AJAX function
  if (isset($_GET['questionID'])) {
    $id = $_GET['questionID'];
// If unselect all questions has been clicked unset all selected question
    if( $id == 'clear' ) {
      if(isset($_SESSION['Q_ID'])) {
        unset($_SESSION['Q_ID']);
      }
    } else {
// Include session code to manage selected questions
      include('session.php');
    }
  }

// If there are selected questions include unselect all button
  if (isset($_SESSION['Q_ID'])) { ?>
    <button type="button" class="btn btn-danger btn-block p-1 mb-2 font-boldish" onclick="send_selected('clear', 'filler', 'filler'), send_filters('filler', 'refresh');">Unselect All</button>
  <?php }
} ?>

<div class="page-fill-scroll">
  <div class="row-1">
<!-- Include the SQL query that relates to the selected page -->
    <?php if($select_page == "custom") {
      include("custom-selected-sql.php");
    } elseif ($select_page == "pastpapers") {
      include("past-papers-selected-sql.php");
    } ?>
  </div>
</div>

<!-- If no question have been selected then display a disabled next button -->
<?php if ($Next_disabled == "true") { ?>
  <a class="btn btn-danger btn-block p-1 mt-2 font-boldish disabled" href="index.php?page=print&select=<?php echo "$select_page"; ?>" role="button">Next</a>
<?php } else { ?>
  <!-- If there are selected questions display a clickable next button -->
  <a class="btn btn-danger btn-block p-1 mt-2 font-boldish" href="index.php?page=print&select=<?php echo "$select_page"; ?>" role="button">Next</a>
<?php } ?>
