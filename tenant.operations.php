<?php
session_start();
require "crud.php";
// Check if the request method is POST
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['action']=="requestRent"){
    $crud = new Crud();
    $table = $_POST['table'];
    $tid = $_POST['tid'];
    $pid = $_POST['pid'];
    $lid = $_POST['lid'];
    $fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
// Convert to SQL date format (YYYY-MM-DD)
$fromDateSQL = date("Y-m-d", strtotime($fromDate));
$toDateSQL = date("Y-m-d", strtotime($toDate));

    $condition = "property = '{$pid}' and tenant = '{$tid}' and request = 1";
    $column = "request";
    $previousRequest = $crud->selectCondition($table, $column, $condition);
    $requestCount = mysqli_num_rows($previousRequest);
    $row = mysqli_fetch_assoc($previousRequest);
    if ($requestCount > 0) {
        // Request already sent
        
        echo "<script>alert('Request already sent')</script>";
        echo "<script>window.location.href = 'tenant.view.php';</script>";
    } else {
        // Send request to tenant
        $itemsArray = [
            "tenant" => $tid,
            "property" => $pid,
            "landlord" => $lid,
            "request" => 1,
            "start" => $fromDateSQL,
            "end" =>$toDateSQL

        ];
        $crud->insert($table, $itemsArray);

        echo "<script>alert('request Sucessfull')</script>";
        echo "<script>window.location.href = 'tenant.view.php';</script>";
    }
}
else if($_POST['action']=='cancel'){
    $crud = new Crud();
    $table = 'booking';
    $bid = $_POST['bid'];
    $column = 'request';
    $updatedValue = '0';
    $crud->delete($table,"bid",$bid);
   
    echo "<script>alert('cancelled Sucessfull')</script>";
    echo "<script>window.location.href = 'tenant.view.php';</script>";

}
else if($_POST['action']=='verify'){
    $crud = new Crud();

    $table = "tenant";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/"; // Directory where you want to store uploaded files
        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

        // Check if the file is an image
        $allowedTypes = array('image/jpeg', 'image/png', 'image/jpg');
        if (!in_array($_FILES['photo']['type'], $allowedTypes)) {
            echo "Error: Only JPEG, PNG, and JPG formats are supported.";
            
            exit;
        }

        // Move the uploaded file to the specified directory
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            echo "Error uploading file.";
            exit;
        }

        // Now you have the file stored on the server, and you can save the file path in the database.
        $photoPath = $uploadFile;
       $email =  $_SESSION["temail"];
       $updateData = array(
        "tdocument" => $uploadFile,
        "request" => 1
    );

    $key = "temail";
    $operator = "=";
    $value = $email;

    $crud->updateMultiple($table, $updateData, $key, $operator, $value);
        echo "<script>alert('Verification Request sent to admin')</script>";
        echo "<script>window.location.href = 'tenant.view.php';</script>";

    } else {
        echo "<script>alert('Error: No file uploaded.')</script>";
        exit;
    }
    

}
} else {
    echo "<script>alert('error ')</script>";
}
?>
