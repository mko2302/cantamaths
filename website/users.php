<?php
//select all qs from database
$number_sql = "SELECT * FROM user";
$number_qry = mysqli_query($dbconnect, $number_sql);
$number_of_q = mysqli_num_rows($number_qry);

//pagination code adapted from https://github.com/simonjsuh/pagination-in-php/blob/master/index.php

//set number of results displyed per page
$results_per_page = 12;

//find number of pages needed to display all questions
$number_of_pages = ceil($number_of_q/$results_per_page);

//find number page user is on
if (!isset($_GET['upage'])) {
  $qpage = 1;
} else {
  $qpage = $_GET['upage'];
}

$page_first_result = ($qpage - 1) * $results_per_page;

//sql query to get number of users depending on what page user is on
$user_sql = "SELECT * FROM user JOIN access ON user.accessID = access.accessID LIMIT $page_first_result , $results_per_page";

$user_qry = mysqli_query($dbconnect, $user_sql);
 ?>

<!-- bootstrap table -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th>Firstname</th>
      <th>Lastname</td>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>

    <?php
    // error catching if no results
    if(mysqli_num_rows($user_qry) == 0) {
      echo "<p class='display-2 text-center p-5'>No users in Database</p>";
    } else {
      $user_aa = mysqli_fetch_assoc($user_qry);
        do {

            $firstname = $user_aa["firstname"];
            $lastname = $user_aa["lastname"];
            $username = $user_aa["username"];
            $email = $user_aa["email"];
            $access = $user_aa["name"];

            echo "
            <tr>
              <td>$username</td>
              <td>$firstname</td>
              <td>$lastname</td>
              <td>$email</td>
              <td>$access</td>

            </tr>
            ";
          } while ($user_aa = mysqli_fetch_assoc($user_qry));
        } ?>
  </tbody>
</table>

<!-- pagination boostrap adapted from https://www.positronx.io/create-pagination-in-php-with-mysql-and-bootstrap/ -->
<nav aria-label="Page navigation example mt-5">
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
                echo "index.php?page=adminpanel&tab=questiondb&upage=$prev";
              } ?>
              ">Previous</a>
        </li>

        <!-- page number button -->
        <?php for($i = 1; $i <= $number_of_pages; $i++ ): ?>
        <li class="page-item <?php if($qpage == $i) {echo 'active'; } ?>">
            <a class="page-link" href="index.php?page=adminpanel&tab=users&upage=<?= $i; ?>"> <?= $i; ?> </a>
        </li>
        <?php endfor; ?>

        <!-- next button -->
        <li class="page-item <?php if($page >= $number_of_pages) { echo 'disabled'; } ?>">
            <a class="page-link"
              <?php $next = ($qpage + 1) ?>
                href="
              <?php
                if($page >= $number_of_pages){
                  echo '#';
                } else {
                  echo "index.php?page=adminpanel&tab=users&qpage=$next";
                } ?>
                ">Next</a>
        </li>
    </ul>
</nav>
