<div class="px-2 py-1 mb-2 border-header">
  <span class="font-boldish">Results</span>
</div>

<div class="page-fill-scroll">
  <div class="row-1">
  <?php include("filter-to-in.php");
  if($select_page == "custom") {
    include("custom-display-sql.php");
  } elseif ($select_page == "pastpapers") {
    include("past-papers-display-sql.php");
  } ?>
  </div>
</div>
