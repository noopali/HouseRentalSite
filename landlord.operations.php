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

        $crud->updateOne($table, $column, $updatedValue, "property", "=", $pid);
    }
    // Check if the action is "verify"
    if ($_POST['action'] === 'verify') {
        $uploadDir = 'uploads/'; 

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
                echo " alert('Failed to upload house document.')";
               
            }
        }
    }

    if (!empty($idDocumentPath) || !empty($houseDocumentPath)) {
        $email = $_SESSION["lemail"];
        $updateData = array(
            "id_document" => $idDocumentPath,
            "property_document" => $houseDocumentPath,
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

   if($_POST['action'] === 'addRent'){ 
$crud = new Crud();
if(isset($_POST['submit'])){
  $location = $_POST['location'];
  $price = $_POST['price'];
  $rooms = $_POST['rooms'];
  $description = $_POST['description'];
  if(isset($_FILES['photo'])){
    $file_name = $_FILES['photo']['name'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];

    // Specify the allowed photo formats
    $allowed_formats = array("image/jpeg", "image/png", "image/gif");

    // Check if the uploaded file type is allowed
    if (in_array($file_type, $allowed_formats)) {
      // Specify the directory where the uploaded file should be saved
      $upload_dir = "uploads/";

      // Move the uploaded file to the desired location
      move_uploaded_file($file_tmp, $upload_dir.$file_name);
      $photo = $upload_dir.$file_name;

      // Process the rest of the form data or save it to a database
      $table = "landlord";
      $email = $_SESSION["email"];
      $landlord = $_SESSION["lid"];
      $table = "property";
      $item = [
        "photo"=>$photo,	
        "location"=>$location,
        "description"=>$description,
        "price"=>$price,
        "landlord"=>$landlord,
        "rooms"=>$rooms
      ];
      $crud->insert($table,$item);
      header("location:landlord.view.php");
    } else {
      
      echo "<script>alert('Invalid file format. Only JPEG, PNG, and GIF images are allowed.')</script>";
      echo "<script>window.location.href = 'landlord.view.php';</script>";
    }
  } else {
    echo "<script>alert('No file uploaded.')</script>";
    echo "<script>window.location.href = 'landlord.view.php';</script>";
    
  }
}

} else {
    $response = array('message' => 'Error');
    json_encode($response);
}

?>
