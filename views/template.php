<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php

include "modules/header.php";

include "modules/sidebar.php";

if (isset($_GET['rules'])) {
    if ($_GET['rules'] == 'dashboard' || $_GET['rules'] == 'users' || $_GET['rules'] == 'categories' || $_GET['rules'] == 'products' || $_GET['rules'] == 'clients' || $_GET['rules'] == 'sales' || $_GET['rules'] == 'create-sale' || $_GET['rules'] == 'reports') {
        include 'modules/' . $_GET['rules'] . '.php';
    }
}

// include "modules/dashboard.php";

include "modules/footer.php"
?>

    </div>
    <!-- end wrapper -->

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