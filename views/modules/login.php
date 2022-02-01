<div class="bg"></div>

<div class="login-box">
  <div class="login-logo">
    <!-- <img src="views/img/fashion1.png" alt="Logo" width="300" height="100" class="img-fluid"> -->
    <a href="dashboard" class="text-white"><b>Inventory</b> System</a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="post" class="mb-2">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="login_username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="login_pwd">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>

        <?php
$login = new UsersController();
$login->login();
?>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
    </div>
  </div>
</div>