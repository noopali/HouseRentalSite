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
        // Check if the action is "verify"
        if (isset($_POST['action']) && $_POST['action'] === 'verify') {
            $uploadDir = 'uploads/'; // Change this to your desired directory
    
            $idDocumentPath = '';
            $houseDocumentPath = '';
    
            // Handle the uploaded identification document
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
                $uploadFile1 = $uploadDir . basename($_FILES['photo']['name']);
    
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile1)) {
                    $idDocumentPath = $uploadFile1;
                } else {
                    echo 'Failed to upload identification document.';
                }
            }

            // Handle the uploaded house document
            if (isset($_FILES['photo2']) && $_FILES['photo2']['error'] === 0) {
                $uploadFile2 = $uploadDir . basename($_FILES['photo2']['name']);
    
                if (move_uploaded_file($_FILES['photo2']['tmp_name'], $uploadFile2)) {
                    $houseDocumentPath = $uploadFile2;
                } else {
                    echo 'Failed to upload house document.';
                }
            }
        }

        if (!empty($idDocumentPath) || !empty($houseDocumentPath)) {
            $email =  $_SESSION["lemail"];
       $updateData = array(
        "id_document" =>$idDocumentPath ,
        "property_document"=>$houseDocumentPath,
        "request" => 1
    );
$table = "landlord";    
    $key = "lemail";
    $operator = "=";
    $value = $email;
    $crud = new Crud();
    $crud->updateMultiple($table, $updateData, $key, $operator, $value);
        echo "<script>alert('Verification Request sent to admin landlord')</script>";
        echo "<script>window.location.href = 'landlord.view.php';</script>";
        }
}

    else {
    $response = array('message' => 'Error');
    json_encode($response);
}

?>
