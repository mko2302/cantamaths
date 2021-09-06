<div class="navbar navbar-expand-lg">
  <a class="navbar-brand" style="color: #FFFFFF;" href="index.php">Cantamath</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
<!-- If user is an admin add admin panel button -->
      <?php if (isset($_SESSION['admin'])) {
        echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?page=adminpanel'>Admin Panel</a></li>
        </li>";
      }

// If user logs in add items to navbar
      if (isset($_SESSION['user'])) {
        echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?page=profile'>Profile</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='index.php?page=logout'>Logout</a>
        </li>";
// Otherwise display login button
      } else {
        echo "<li class='nav-item'>
          <a class='nav-link' href='index.php?page=login'>Login</a>
        </li>";
      } ?>
    </ul>
  </div>
</div>
