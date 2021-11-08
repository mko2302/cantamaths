<div class="navbar navbar-expand-lg">

  <!-- link to home -->
  <a class="navbar-brand" style="color: #FFFFFF;" href="index.php"><h1>Cantamath</h1></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
<?php
// if user is an admin add admin panel button
      if (isset($_SESSION['admin'])) {
        echo "<li class='nav-item'>
                <a class='home-nav nav-link' href='index.php?page=adminpanel'>Admin Panel</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='index.php?page=profile'>Profile</a>
              </li>
              <li class='nav-item'>
              <li class='nav-item'>
                <a class='nav-link' href='index.php?page=logout'>Logout</a>
              </li>";
      } elseif (isset($_SESSION['user'])) { // If user logs in add items to navbar
        echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?page=profile'>Profile</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='index.php?page=logout'>Logout</a>
        </li>";
      } else { // Otherwise display login button
        echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?page=login'>Login</a>
        </li>";
      } ?>
    </ul>
  </div>
</div>
