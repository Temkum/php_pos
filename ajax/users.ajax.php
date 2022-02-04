<?php
require_once "../controllers/UsersController.php";
require_once "../models/UserModel.php";

class AjaxUsers
{
    // Edit user
    public $userId;

    public function ajaxEditUser()
    {
        $item = "id";
        $value = $this->userId;

        $response = UsersController::getUsers($item, $value);

        echo json_encode($response);
    }
}

/* Edit user */
if (isset($_POST["userId"])) {
    $edit = new AjaxUsers();
    $edit->userId = $_POST["userId"];
    $edit->ajaxEditUser();
}