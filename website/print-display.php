<table class="table table-bordered">
  <?php session_start();
  $select_page = $_GET['select'];
  $print_type = $_GET['print_type'];
  if ($print_type == "competition") {
    $teams = $_GET['teams'];
  }
  include("print-pdf-sql.php");
  echo $output;?>
</table>
