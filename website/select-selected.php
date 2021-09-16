<?php session_start();
if (isset($_GET['select_page'])) {
  $select_page = $_GET['select_page'];
} ?>
<div class="px-2 py-1 mb-2 border-header">
  <span class="font-boldish">Selected:</span>
</div>
<div class="page-fill-scroll">
  <div class="row-1">
    <?php if($select_page == "custom") {
      include("custom-selected-sql.php");
    } elseif ($select_page == "pastpapers") {
      include("past-papers-selected-sql.php");
    } ?>
  </div>
</div>

<?php if ($Next_disabled == "true") { ?>
  <a class="btn btn-danger btn-block p-1 mt-2 font-boldish disabled" href="index.php?page=print&select=<?php echo "$select_page"; ?>" role="button">Next</a>
<?php } else { ?>
  <a class="btn btn-danger btn-block p-1 mt-2 font-boldish" href="index.php?page=print&select=<?php echo "$select_page"; ?>" role="button">Next</a>
<?php } ?>
