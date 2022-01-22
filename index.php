<?php

require_once "controllers/DashboardController.php";
require_once 'controllers/CategoriesController.php';
require_once 'controllers/ClientsController.php';
require_once 'controllers/CreateSaleController.php';
require_once 'controllers/ProductsController.php';
require_once 'controllers/ReportsController.php';
require_once 'controllers/SalesController.php';
require_once 'controllers/UsersController.php';

$template = new DashboardController();
$template->ctrTemplate();