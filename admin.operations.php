<?php
session_start();
require "crud.php";
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //checks what is the action
    if ($_POST['action'] == "verifyTenant") {
        $crud = new Crud();
       
        $table = $_POST['table'];
       
        $email = $_POST['temail'];

        $updateData = array(
            "verified" => 1
        );
            
            $key = "temail";
            $operator = "=";
            $value = $email;
            $crud->updateMultiple($table, $updateData, $key, $operator, $value);
       echo " <script>alert('User is verified Sucessfully')</script>";
       echo "<script>window.location.href = 'admin.tenantreq.php';</script>";
        }
   else if ($_POST['action'] == 'verifyLandlord'){
        $crud = new Crud();
        $table = $_POST['table'];
        $email = $_POST['lemail'];

        $updateData = array(
            "verified" => 1
        );
        $key = "lemail";
        $operator = "=";
        $value = $email;
        $crud->updateMultiple($table, $updateData, $key, $operator, $value);
        echo "<script>alert('User is verified successfully')</script>";
        echo "<script>window.location.href = 'admin.landlordreq.php';</script>";
    }

    else {
    $response = array('message' => 'Error');
    json_encode($response);
}
}

?>
