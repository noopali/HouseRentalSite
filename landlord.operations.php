<?php
session_start();
require "crud.php";
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //checks what is the action
    if ($_POST['action'] == "approve") {
        $crud = new Crud();
       
        $table = $_POST['table'];
       
        $pid = $_POST['pid'];
        $column = "status";
            $updatedValue = "1";
            
        $crud->updateOne($table,$column,$updatedValue,"property","=",$pid);
        }
    }


    else {
    $response = array('message' => 'Error');
    json_encode($response);
}

?>
