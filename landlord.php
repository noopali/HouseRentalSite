<?php
session_start();
  require "crud.php";
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
    
    // Specify the directory where the uploaded file should be saved
    $upload_dir = "uploads/";

    // Move the uploaded file to the desired location
    move_uploaded_file($file_tmp, $upload_dir.$file_name);
    $photo = $upload_dir.$file_name;
    echo $photo;
    // Process the rest of the form data or save it to a database

    $table = "landlord";
    $email = $_SESSION["email"];
    $landlord = $_SESSION["lid"];
    echo $_SESSION["lid"];
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



    // Example: Displaying the uploaded information
    /*
    echo "Location: " . $location . "<br>";
    echo "Price: " . $price . "<br>";
    echo "Number of Rooms: " . $rooms . "<br>";
    echo "Description: " . $description . "<br>";
    echo "Uploaded File Name: " . $file_name . "<br>";
    */
  }
  else {
    echo "No file uploaded.";
  }
}


?>

