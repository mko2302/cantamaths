<!-- Headers -->
<div class="px-2 py-1 mb-2 border-header">
  <span class="font-boldish">Results</span>
</div>

<!-- Sllows the content to scroll -->
<div class="page-fill-scroll">
  <div class="row-1">
<!-- Include code to implode Sessions to make them compatible with an SQL query -->
  <?php include("filter-to-in.php");
// SQL queries are different for custom and past papers so it checks what page has been selected
  if($select_page == "custom") {
    include("custom-display-sql.php");
  } elseif ($select_page == "pastpapers") {
    include("past-papers-display-sql.php");
  } ?>
  </div>
</div>
