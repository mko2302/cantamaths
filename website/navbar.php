<!-- link to home -->

<div class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><h1>Cantamaths</h1></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
        if(!isset($_SESSION['admin'])) {
          echo"<li class='nav-item'> <a class='nav-link' href='index.php?page=login'>Login</a> </li>";
        } else {
          echo"<li class='nav-item'> <a class='nav-link' href='index.php?page=adminpanel'>Admin Panel</a> </li>";
          echo"<li class='nav-item'> <a class='nav-link' href='index.php?page=logout'>Logout</a> </li>";
        };
       ?>
      </ul>


  </div>

</div>
