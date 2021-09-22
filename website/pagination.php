<?php
$results_per_page = 6;

//find number of pages needed to display all questions
$number_of_pages = ceil($number_of_q/$results_per_page);

//find number page user is on
if (!isset($_GET['qpage'])) {
  $qpage = 1;
} else {
  $qpage = $_GET['qpage'];
}

$page_first_result = ($qpage - 1) * $results_per_page;
?>


<!-- pagination boostrap adapted from https://www.positronx.io/create-pagination-in-php-with-mysql-and-bootstrap/ -->
<nav aria-label="Page navigation mt-5">
    <ul class="pagination justify-content-center">
        <!-- previous button -->
        <li class="page-item <?php if($qpage <= 1){ echo 'disabled'; } ?>">
          <?php $prev = ($qpage - 1) ?>
            <a class="page-link"
                href="
            <?php
              if($qpage <= 1){
                echo '#';
              } else {
                echo "index.php?page=adminpanel&tab=questiondb&qpage=$prev";
              } ?>
              ">Previous</a>
        </li>

        <!-- page number button -->
        <?php for($i = 1; $i <= $number_of_pages; $i++ ): ?>
        <li class="page-item <?php if($qpage == $i) {echo 'active'; } ?>">
            <a class="page-link" onclick="pagination(<?php echo "'$nameID'"; ?>)" href="index.php?page=adminpanel&tab=questiondb&qpage=<?= $i; ?>"> <?= $i; ?> </a>
        </li>
        <?php endfor; ?>

        <!-- next button -->
        <li class="page-item <?php if($qpage >= $number_of_pages) { echo 'disabled'; } ?>">
            <a class="page-link"
              <?php $next = ($qpage + 1) ?>
                href="
              <?php
                if($page >= $number_of_pages){
                  echo '#';
                } else {
                  echo "index.php?page=adminpanel&tab=questiondb&qpage=$next";
                } ?>
                ">Next</a>
        </li>
    </ul>
</nav>



<script>
function pagination(page) {
  alert()
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pagination_id").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "custom-question-display.php?page=" + page, true);
  xhttp.send();
}
</script>
