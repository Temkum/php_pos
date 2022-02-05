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

    /* Activate user */
    public $activate_user;
    public $activate_id;

    public function ActivateUserAjax()
    {
        $table = 'users';
        $item1 = 'status';
        $value1 = $this->activate_user;
        $item2 = 'id';
        $value2 = $this->activate_id;
        
        $response = UserModel::activateUser($table, $item1, $value1, $item2, $value2);
    }

    // check if user already exist
    public $validate_username;

    public function validateUsernameAjax()
    {
        $item = 'username';
        $value = $this->validate_username;
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

/* Activate user object */
if (isset($_POST["activateUser"])) {
    $activate  = new AjaxUsers();
    $activate->activate_user = $_POST["activateUser"];
    $activate->activate_id = $_POST["activateId"];
    $activate->ActivateUserAjax();
}

if (isset($_POST["validateUsername"])) {
    $valUser = new AjaxUsers();
    $valUser->validate_username = $_POST["validateUsername"];
    $valUser->validateUsernameAjax();
}