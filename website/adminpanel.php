<!-- admin panel goes here -->

<?php
// check to see if logged in.
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}
 ?>

<h2>Admin Panel</h2>

<div class="container">
    <nav class="col-3">
      <p class="display-4">Dashboard</p>
      <a class="nav-link" href="">Home</a>
      <a class="nav-link" href="">Add Questions</a>
      <a class="nav-link" href="">Question Database</a>
      <a class="nav-link" href="users.php"=>Users</a>
      <a class="nav-link" href="logout.php">Log Out</a>
    </nav>

    <div class="col-9">
      <p>Home Page</p>

      <?php
        
      ?>

    </div>

</div>
