<?php
session_start();
require "crud.php";
$crud = new Crud();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Landlord Page</title>
  <link rel="stylesheet" href="">
  <style>
    .rental-list img {
  max-width: 100px;
  max-height: 100px;
}

#rentalTable {
  width: 100%;
  border-collapse: collapse;
}

#rentalTable th {
  background-color: yellow;
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

#rentalTable td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.rental-form-popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

/* .rental-form-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
} */

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.header {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
}

.rental-form-popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
  overflow: auto;
}

.rental-form-container {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  max-width: 400px;
  height: 300px;
}
.rentalformDiv{
  display: flex;
flex-direction: column;
align-items: ;
justify-content: flex-start;
}
.rentalformDiv input{
  display:inline-block;
  
}
.rental-list {
  margin-top: 30px;
}

.rental-list h2 {
  text-align: center;
}

#rentalTable {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

#rentalTable th,
#rentalTable td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: left;
}

#rentalTable th {
  background-color: #f2f2f2;
}

.applicant-section {
  margin-top: 30px;
}

.applicant-section h2 {
  text-align: center;
}

#applicantCount {
  text-align: center;
  margin-bottom: 10px;
}

#applicantList {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.applicant-item {
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom: 10px;
}

.applicant-item h4 {
  margin: 0;
}

.applicant-item p {
  margin: 5px 0;
}

.applicant-item .applicant-actions {
  text-align: right;
}

.rental-table-image {
  max-width: 100px;
  max-height: 100px;
}
header {
position: fixed;
width: 100%;
top: 0;
right: 0;
z-index: 1000;
display: flex;
align-items: center;
justify-content: space-between;
background: skyblue;
padding: 0.3125rem 10px; 
height: 80px; 
}
.logo>img{
  width: 150px;
  height: 60px;
}
.navbar{
  display: flex;
  list-style: none;
}
.navbar li{
  position: relative;
}
.navbar a{
  font-size: 1rem;
  padding: 0.625rem 20px;
  color: purple;
  font-weight: 500;
  text-decoration: none;
}
.navbar a::after{
  content: '';
  width: 0;
  height: 3px;
  background: purple;
  position: absolute;
  bottom: -4px;
  left: 0;
  transition: 0.5s;
}
.navbar a:hover::after {
  width: 100%;
}
.header-btn a {
  padding: 10px 20px;
  color: purple;
  font-weight: 500;
  text-decoration: none;
}
.header-btn .log-in {
  background:purple;
  color: white;
  border-radius: 0.5rem;
}
.header-btn .log-in:hover {
   color:skyblue;

}



.addrental{
  display: flex;
  align-items: normal;
  justify-content: center;

}
.addrental>button{
  height: 40px;
  width: 100px;
  margin: 30px;
}
.delete-btn{
  display: inline-block;
  height: 40px;
  width: 80px;
}
.verify-form{
    display: none;
    
  }
  #verify-button{
    display: inline-block;
    margin: 0px auto;
  }
  .verify-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .verify-alert {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
  }

  .verify-alert h2 {
    margin-top: 0;
  }

  .verify-alert input[type="file"] {
    margin-bottom: 10px;
  }

  .verify-alert button {
    margin-top: 10px;
  }
  #verify-btn{
    margin-top: 100px;
    
  }
  .welcome{
    margin-top: 100px;
    text-align: center;
  }

  .error {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}
  </style>
</head>
<script src ="jquery.js"></script>

<body>
<header>

    <a href="#" class="logo"><img src="logo.png" alt=""></a> 
    <ul class="navbar">
      <li><a href="landlord.view.php">Home</a></li>
      <li><a href="landlord.requests.php">Rental Requests</a></li>
      <li><a href="landlord.mytenants.php">My Tenants</a></li>
      <li><a href="landlord.profile.php">My Profile</a></li>
        </ul>
    <div class="header-btn">
      <a href="logout.php" class="log-in">Log out</a>
    </div>
  </header>
    <h1 class="welcome">Welcome, <?php echo $_SESSION["lname"]; ?></h1>
  
    <?php
    $email = $_SESSION['lemail'];
    $verified = $_SESSION["verified"];
    $select = $crud->selectAll("landlord","=","lemail",$email);
   $landlord = mysqli_fetch_assoc($select);
   $verified = $landlord["verified"];
   $request = $landlord["request"];
   $message = $landlord["message"];


    ?>
   </div>
     <?php
     if($verified == 1 && $message == 0) {
      echo "<script>alert('You are a verified user!');</script>";
      $updateData = array(
        "message" => 1
    );
    $table = "landlord";
    $key = "lemail";
    $operator = "=";
    $value = $email;

    $crud->updateMultiple($table, $updateData, $key, $operator, $value);

    }

      if($verified==0 && $request == 0){
       
        echo "<script>alert('Verify Your Identity to add your rentals');</script>";
        echo "<button id='verify-btn' onclick ='showVerifyForm();'> Verify Your Identity</button>";
      }
      else if ($verified==0 && $request == 1){
        echo "<script>alert('Your Verification is pending')</script>";
      }
  if($verified == 1){
 
  echo "<div class='addrental'>
  <button id='rentalFormButton' onclick ='openRentalForm();'>Add Rental</button>
  </div>";
  }
   ?>
     <div class="verify-overlay" style="display: none;">
    <div class="verify-alert">
      <h2>Verify yourself</h2>
      <form id="rentalForm" name = "verifyForm" method="post" enctype="multipart/form-data" action = "landlord.operations.php">
        <input type="hidden" name="action" value="verify">
        Enter Your Identification Document <input type="file" id="photoInput" name="photo" accept="image/jpeg, image/png, image/jpg">
        <br>
        Enter your house document <input type="file" name="photo2" id="" accept="image/jpeg, image/png, image/jpg" >
        <br>
        <button type="submit" id="rentalFormSubmit" name="submit" style="margin: auto;" onclick = " return ValidateVerifyForm()">Submit</button>
        <br>    
        <button type="button" id="closePopupButton" onclick = "hideVerifyForm();">Close</button>
      </form>
    </div>
  </div>

  <div class="rental-form-popup" id="rentalFormPopup">
    <div class="rental-form-container">
      <form id="rentalForm" action="landlord.operations.php" method="post" enctype="multipart/form-data">
      <h2 style="text-align:center">Add Rental</h2>
      <div class="rentalformDiv">
        <input type="hidden" name="action" value = "addRent">
        <input type="text" id="locationInput" placeholder="Location" name="location">
        <input type="file" id="roomPhoto" name="roomPhoto" accept=" image/jpeg, image/png, image/jpg ">
        <input type="number" id="priceInput" placeholder="Price" name="price" >
        <input type="text" id="roomsInput" placeholder="Number of rooms" name="rooms" >
        <textarea id="descriptionInput" placeholder="Description" name="description"></textarea>
        <button type="submit" id="rentalFormSubmit" name="submit" onclick="return validateForm()">Rent Now</button>

        <button type="button" id="closePopupButton" onclick="return closeRentalForm()" >Close</button>
        </div>
      </form>
    </div>
  </div>

  <div class="rental-list">
    <h2>My Rentals</h2>
    <table id="rentalTable">
      <thead>
        <tr>
          <th>Image</th>
          <th>Price</th>
          <th>Location</th>
          <th>Number of Rooms</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="rentalTableBody">
        <?php
        $table = "property";
        $column = "pid,photo,price,location,rooms";
        $condition = "=";
        $key = "landlord";
        $value = $_SESSION["lid"];
        $select = $crud->select($table, $column, $condition, $key, $value);//select column from table where key = value
        $_SESSION['property'] = $select;
        while ($row = mysqli_fetch_array($select)) {
          $imgsource = $row["photo"];
          $price = $row["price"];
          $rooms = $row["rooms"];
          $location = $row["location"];
          $pid = $row["pid"];
          echo "<tr>";
          echo "<td><img src='{$imgsource}' alt=''></td>";
          echo "<td>{$price}</td>";
          echo "<td>{$location}</td>";
          echo "<td>{$rooms}</td>";
          echo "<td>";
          echo "<a href='delete.php?table={$table}&key=pid&value={$pid}&action=delete' ><button class = 'delete-btn'>delete</button></a>";
          echo "</td>";
          echo "</tr>"; 
        }
      ?>
      </tbody>
    </table>
  </div>
  <script>
  // Function to open the rental form
function openRentalForm() {
  rentalFormPopup.style.display = 'block';
}

// Function to close the rental form
function closeRentalForm() {
  rentalFormPopup.style.display = 'none';
  rentalForm.reset();
  rentalForm.dataset.mode = 'add';
  rentalForm.dataset.rentalId = '';
  document.getElementById('rentalFormSubmit').textContent = 'Rent Now';
}

// // Add event listener to the rental form button
// document.getElementById('rentalFormButton').addEventListener('click', openRentalForm());

// // Add event listener to the close popup button
// document.getElementById('closePopupButton').addEventListener('click', closeRentalForm());
  </script>
  
</body>
</html>
<!--<button onclick()="delete(// echo $row["pid"];?>,);">deleted</button> -->
<script>
    const verifyButton = document.getElementById("verify-btn");

// Get the verification form element
const verifyForm = document.querySelector(".verify-overlay");

// Get the close button element inside the verification form
const closeButton = document.getElementById("closePopupButton");

// Function to show the verification form
function showVerifyForm() {
  verifyForm.style.display = "flex"; 
}

// Function to hide the verification form
function hideVerifyForm() {
  verifyForm.style.display = "none";
}

// Add event listener to the verify button
verifyButton.addEventListener("click", showVerifyForm());

// Add event listener to the close button inside the verification form
closeButton.addEventListener("click", hideVerifyForm());


//verify form validation

function ValidateVerifyForm() {
  var photoInput = document.getElementsByName("photo")[0];
  var photo2Input = document.getElementsByName("photo2")[0];

  var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

  if (photoInput.value === "" || photo2Input.value === "") {
    alert("Please select a file for both documents.");
    return false;
  }

  if (!allowedExtensions.exec(photoInput.value) || !allowedExtensions.exec(photo2Input.value)) {
    alert("Please select valid image files (JPEG, PNG, JPG) for both documents.");
    return false;
  }
  return true;
}
function validateForm() {
    // Get form inputs
    var locationInput = document.getElementById("locationInput");
    var priceInput = document.getElementById("priceInput");
    var roomsInput = document.getElementById("roomsInput");
    var descriptionInput = document.getElementById("descriptionInput");
    var roomPhotoInput = document.getElementById("roomPhoto");
    alert(roomPhotoInput.value);

    // Get the values entered by the user
    var location = locationInput.value.trim();
    var price = parseFloat(priceInput.value);
    var rooms = parseInt(roomsInput.value);
    var description = descriptionInput.value.trim();


    // Validate location (must not be empty)
    if (location === "") {
      alert("Please enter a location.");
      locationInput.focus();
      return false; // Prevent form submission
    }
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    
var selectedFiles = photoInput.value;
if (roomPhotoInput.value === "") {
  alert("Please select a photo of room.");
  return false;
}
if (!allowedExtensions.exec(roomPhotoInput.value)) {
  alert("Please select valid image files (JPEG, PNG, JPG).");
  return false;
}
    // Validate price (must be a positive number)
    if (isNaN(price) || price <= 0) {
      alert("Please enter a valid price greater than 0.");
      priceInput.focus();
      return false; // Prevent form submission
    }

    // Validate rooms (must be a positive integer)
    if (isNaN(rooms) || rooms <= 0 || rooms % 1 !== 0) {
      alert("Please enter a valid number of rooms greater than 0.");
      roomsInput.focus();
      return false; // Prevent form submission
    }

    // Validate description (must not be empty)
    if (description === "") {
      alert("Please enter a description.");
      descriptionInput.focus();
      return false; // Prevent form submission
    }

    // Define a regular expression for allowed image file extensions
    var allowedExtensions = /\.(jpg|jpeg|png)$/i;

    // Check if the file extension is valid
    var fileName = selectedFiles[0].name;
    if (!allowedExtensions.test(fileName)) {
      alert("Please select valid image files (JPEG, PNG, JPG).");
      return false; // Prevent form submission
    }

    // If all validations pass, allow form submission
    return true;
  }

        </script>

