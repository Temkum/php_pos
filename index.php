<?php

require_once "controllers/DashboardController.php";
require_once 'controllers/CategoriesController.php';
require_once 'controllers/ClientsController.php';
require_once 'controllers/CreateSaleController.php';
require_once 'controllers/ProductsController.php';
require_once 'controllers/ReportsController.php';
require_once 'controllers/SalesController.php';
require_once 'controllers/UsersController.php';

require_once 'models/CategoryModel.php';
require_once 'models/ClientModel.php';
require_once 'models/ProductModel.php';
require_once 'models/ReportModel.php';
require_once 'models/SaleModel.php';
require_once 'models/UserModel.php';

$template = new DashboardController();
$template->baseTemplate();