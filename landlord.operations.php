<?php
session_start();
require "crud.php";
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] == "approve") {
        $crud = new Crud();
        $table = $_POST['table'];
        $bid = $_POST['bid'];
        $column = "status";
        $updatedValue = "1";
        $response = array("Tenant request accepted!");
        $crud->updateOne($table,$column,$updatedValue,"bid","=",$bid);
    }
} else {
    $response = array('status' => 0, 'message' => 'Error');
}
?>