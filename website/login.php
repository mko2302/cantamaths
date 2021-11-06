<?php
if (isset($_SESSION['admin'])) {
  header("Location: index.php?page=adminpanel");
}
 ?>
<div class="container center">
  <div class="login-container">
    <p class="display-4 p-2">Login</p>
    <form class="" action="verify.php" method="post">

      <div class="row mx-2 login-field">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
      </div>

      <div class="row mx-2 login-field">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
      </div>

      <div class="row mx-2">
          <?php include("status.php") ?>
      </div>


      <div class="form-group m-2">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>

    </form>
  </div>

</div>
