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
    <!-- custom -->
    <link rel="stylesheet" href="views/dist/css/custom.css">
</head>

<body class="hold-transition sidebar-mini login-page">

    <?php
// check if user is logged in
if (isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == 'ok') {

    // site wrapper
    echo '<div class="wrapper">';

    if (isset($_GET['route'])) {
        if ($_GET['route'] == 'dashboard' || $_GET['route'] == 'users' || $_GET['route'] == 'categories' || $_GET['route'] == 'products' || $_GET['route'] == 'clients' || $_GET['route'] == 'sales' || $_GET['route'] == 'create-sale' || $_GET['route'] == 'reports') {
            include 'modules/' . $_GET['route'] . '.php';
        } else {
            include 'modules/404.php';
        }
    }

    include "modules/header.php";

    include "modules/sidebar.php";

// include "modules/dashboard.php";

    include "modules/footer.php";

    echo "</div>";
// end wrapper

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

    <!-- custom js -->
    <script type="text/javascript" src="views/js/template.js"></script>
</body>

</html>