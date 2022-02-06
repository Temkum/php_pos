<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory System</title>

  <link rel="icon" href="views/img/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.css">
  <link rel="stylesheet" href="views/plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <!-- <link rel="stylesheet" href="views/plugins/sweetalert/sweetalert2.css"> -->
  <!-- custom -->
  <link rel="stylesheet" href="views/dist/css/custom.css">
  <!-- icheck -->
  <link rel="stylesheet" href="views/plugins/icheck/flat/_all.css">

  <!-- sweet alert script -->
  <script src="views/js/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition sidebar-mini login-page">

  <?php
// check if user is logged in
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'OK') {
        // site wrapper
        echo '<div class="wrapper">';

        include "modules/header.php";

        include "modules/sidebar.php";

        if (isset($_GET['route'])) {
            if ($_GET['route'] == 'dashboard' ||
            $_GET['route'] == 'users' ||
            $_GET['route'] == 'categories' ||
            $_GET['route'] == 'products' ||
            $_GET['route'] == 'clients' ||
            $_GET['route'] == 'sales' ||
            $_GET['route'] == 'create-sale' ||
            $_GET['route'] == 'reports' ||
            $_GET['route'] == 'logout') {
                include 'modules/' . $_GET['route'] . '.php';
            } else {
                include 'modules/404.php';
            }
        } else {
            include "modules/dashboard.php";
        }

        include "modules/footer.php";
        echo "</div>";
    } else {
        include 'modules/login.php';
    }
    ?>

  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>
  <!-- data tables -->
  <script src="views/plugins/datatables/jquery.dataTables.js"></script>
  <script src="views/plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <!-- icheck -->
  <script src="views/plugins/icheck/icheck.min.js"></script>

  <!-- custom js -->
  <script type="text/javascript" src="views/js/user.js"></script>
  <script type="text/javascript" src="views/js/category.js"></script>
  <script type="text/javascript" src="views/js/main.js"></script>
</body>

</html>