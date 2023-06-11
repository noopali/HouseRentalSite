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

.rental-form-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
}

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
  max-width: 500px;
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
  align-items: center;
  justify-content: center;

}
.addrental>button{
  height: 40px;
  width: 100px;
  margin: 30px;
}
  </style>
</head>
<script src ="jquery.js"></script>

<body>
<header>
    <a href="#" class="logo"><img src="logo.png" alt=""></a>
    <ul class="navbar">
      <li><a href="index.php">Home</a></li>
      <li><a href="landlord.requests.php">Rental Requests</a></li>
      <li><a href=".php"></a></li>
        </ul>
    <div class="header-btn">
      <a href="logout.php" class="log-in">Log out</a>
    </div>
  </header>
    <h1>Welcome, <?php echo $_SESSION["lname"];?></h1>
    
    
   </div>
   <div class="addrental">
   <button id="rentalFormButton">Add Rental</button>
   </div>
   

  <div class="rental-form-popup" id="rentalFormPopup">
    <div class="rental-form-container">
      <h2>Add Rental</h2>
      <form id="rentalForm" action="landlord.php" method="post" enctype="multipart/form-data">
        <input type="text" id="locationInput" placeholder="Location" name="location" required>
        <input type="file" id="photoInput" name="photo" required>
        <input type="number" id="priceInput" placeholder="Price" name="price" required>
        <input type="text" id="roomsInput" placeholder="Number of rooms" name="rooms" required>
        <textarea id="descriptionInput" placeholder="Description" name="description" required></textarea>
        <button type="submit" id="rentalFormSubmit" name="submit">Rent Now</button>
        <button type="button" id="closePopupButton" >Close</button>
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

        while ($row = mysqli_fetch_assoc($select)) {
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
          echo "<button>update</button>";
          echo "<a href='delete.php?table={$table}&key=pid&value={$pid}&action=delete'><button>delete</button></a>";
          echo "  </td>";
          echo "</tr>"; 
        }
      ?>
      </tbody>
    </table>
  </div>

  <div class="applicant-section">
    <h2>Tenant Applications</h2>
    <div id="applicantCount">Number of Applicants: <span id="applicantCountValue">0</span></div>
    <ul id="applicantList"></ul>
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

// Add event listener to the rental form button
document.getElementById('rentalFormButton').addEventListener('click', openRentalForm);

// Add event listener to the close popup button
document.getElementById('closePopupButton').addEventListener('click', closeRentalForm);


  </script>
  
</body>
</html>
<!--<button onclick()="delete(// echo $row["pid"];?>,);">deleted</button> -->
<script>
          /*
          function deleteData(pid) {
            $(document).ready(function() {
              $.ajax({
                 url: 'functions.php',
                type: 'POST',
                data: {
                  pid: pid,
                  action: "delete"
                },
                success: function(response) {
                if (response == 1) {
                  alert("Data deleted successfully");
                  document.getElementById(pid).style.display = "none";
                } else if (response == 0) {
                  alert("Data cannot be deleted");
                }
              },
             error: function() {
               alert("Error occurred while processing the request.");
             }
    });
  });
}
*/
        </script>