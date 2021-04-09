<?php
session_start();
if (isset($_SESSION['admin'])) {
  header("Location: index.php?page=adminpanel");
}
 ?>

<div class="container">
  <p class="display-4 p-2">Login</p>
  <form class="m-2" action="verify.php" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
    </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
