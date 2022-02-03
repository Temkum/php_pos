<?php

require_once "../controllers/UsersController.php";
require_once "../models/UserModel.php";

class AjaxUsers
{
    // Edit user
    public $user_id;

    public function ajaxEditUser()
    {
        $item = "id";
        $value = $this->user_id;

        $response = UsersController::getUsers($item, $value);

        echo json_encode($response);
    }
}

/* Edit user */
if (isset($_POST["userId"])) {
    $edit = new AjaxUsers();
    $edit->user_id = $_POST["userId"];
    $edit->ajaxEditUser();
}