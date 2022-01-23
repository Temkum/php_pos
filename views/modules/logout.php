<?php
// Unset all of the session variables
$_SESSION = array();

session_destroy();

header('location: ' . 'login');
exit();