<?php $select_page = $_GET['select'];
$_SESSION['alex!'] = [$select_page];
$print_type = "worksheet"; ?>

<div class="page-fill center-x">
  <div class="flex-row display-region py-4">
    <div class="col-8 px-clear pr-1 area-fill">
      <div class="card border-clear px-3 py-2">
        <h2>Preview</h2>
        <div class="page-fill-scroll border-general">
          <table class="table table-bordered">
            <?php include("print-display.php"); ?>
          </table>
        </div>
      </div>
    </div>
    <div class="col-4 px-clear pl-1 area-fill">
      <div class="col-12 px-clear flex-row">
        <div class="col-12 pb-1 px-clear">
          <div class="card border-clear">
          </div>
        </div>
        <div class="col-12 py-1 px-clear">
          <div class="card border-clear">
          </div>
        </div>
        <div class="col-12 py-1 px-clear">
          <div class="card border-clear">
          </div>
        </div>
        <?php if($select_page == "custom") { ?>
          <a class="btn btn-danger btn-block p-1 mt-1 font-boldish" href="custom-print-pdf.php" role="button">Print</a>
        <?php } elseif ($select_page == "pastpapers") { ?>
          <a class="btn btn-danger btn-block p-1 mt-1 font-boldish" href="past-paper-print-pdf.php" role="button">Print</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
