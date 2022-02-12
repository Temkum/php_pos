<?php
require_once "../controllers/ClientsController.php";
require_once "../models/ClientModel.php";

class AjaxClients
{
    /* edit clients */
    public $client_id;

    public function ajaxEditClient()
    {
        $item = 'id';
        $value = $this->client_id;

        $response = ClientsController::display($item, $value);

        echo json_encode($response);
    }
}

// edit client object
if (isset($_POST['clientId'])) {
    $edit = new AjaxClients();
    $edit->client_id = $_POST['clientId'];
    $edit->ajaxEditClient();
}