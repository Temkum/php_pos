  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
              <a href="views/index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
          </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class=""><?= $_SESSION['name']; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">

            <!-- user body -->
            <div class="media">
              <?php
                    if ($_SESSION['photo'] != '') {
                        echo ' <img src="'. $_SESSION["photo"].'
                    " alt="'.$_SESSION["name"].'" class="img-size-50 mr-3 img-circle">';
                    } else {
                        echo '<img src="views/img/avatar.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">';
                    }
                ?>
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?= $_SESSION['username']; ?>
                </h3>
                <p class="text-sm"><?= $_SESSION['role']; ?>
                </p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <!-- logout-->
          <a href="logout" class="dropdown-item btn-default text-center">Logout
          </a>
    </ul>
  </nav>
  <!-- /.navbar -->