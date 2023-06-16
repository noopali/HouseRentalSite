<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basobas</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="jquery.js"></script>
</head>

<body>
  <header>
    <a href="#" class="logo"><img src="logo.png" alt=""></a>
    <ul class="navbar">
    <li><a href="tenant.view.php">Home</a></li>
      <li><a href="tenant.myrequests.php">My Requests</a></li>
      <li><a href="about-us">My Bookings</a></li>
      <li><a href="reviews">My Profile</a></li>
    </ul>
    <div class="header-btn">
      <a href="logout.php" class="log-in">Log out</a>
    </div>
  </header>
  <style>
    /* CSS styles */
    .search-section {
      background-image: url('background.jpg');
      background-size: cover;
      height: 400px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 20px;
      /* Add margin-top to create space below the navbar */
    }

    .search-section h1 {
      color: #fff;
      font-size: 40px;
      text-align: center;
      margin-bottom: 20px;
    }

    .search-section form {
      display: flex;
      align-items: center;
    }

    .search-section input[type="text"] {
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      margin-right: 10px;
    }

    .search-section button {
      padding: 10px 20px;
      font-size: 16px;
      color: #fff;
      background-color: purple;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .search-section button:hover {
      background-color: blue;
    }

    /* CSS styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .search-section {
      background-image: url('home1.jpg');
      background-size: cover;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-section h1 {
      color: #fff;
      font-size: 40px;
      text-align: center;
    }

    .rents-container {
      margin: 50px;
    }

    .rent-card {
      background: #D7A1F9;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px;
    }

    .rent-card .rent-details {
      display: flex;
      align-items: center;
    }

    .rent-card .rent-image {
      flex: 0 0 200px;
      margin-right: 20px;
    }

    .rent-card .rent-image img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border-radius: 5px;
    }

    .rent-card .rent-info {
      flex: 1;
    }

    .rent-card h2 {
      margin-top: 0;
      margin-bottom: 10px;
    }

    .rent-card p {
      margin: 0;
      margin-bottom: 10px;
    }

    .rent-card .apply-button {
      background: purple;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .rent-card .apply-form {
      display: none;
      margin-top: 10px;
    }

    .rent-card .apply-form h3 {
      margin-top: 0;
    }

    .rent-card .apply-form input,
    .rent-card .apply-form textarea {
      width: 100%;
      margin-bottom: 10px;
      padding: 5px;
    }

    /* Confirm box css */
    .confirm-box {
      background: rgba(0, 0, 0, 0.5);
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .message-box {
      text-align: center;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      padding: 20px;
      border-radius: 5px;
      background-color: white;
      height: 200px;
      width: 400px;


    }

    .yes-button,
    .no-button {
      display: inline-block;
      height: 50px;
      width: 80px;

    }

    .button-box {
      display: flex;
      justify-content: space-evenly;
      margin-top: 40px;
    }

    .yes-button {
      background-color: green;
    }

    .no-button {
      background-color: red;
    }
  </style>
  <div class="search-section">
    <h1>Welcome <?php echo $_SESSION['tname']?></h1>
    <h1>Search by Location</h1>
    <form id="search-form" onsubmit="searchByLocation(event)">
      <input type="text" id="address-input" placeholder="Enter address" required>
      <button type="submit">Go</button>
    </form>
  </div>

  <div class="rents-container">
    <?php
    require "crud.php";
    $crud = new Crud();
    $select = ["property.pid","property.rooms", "property.photo", "property.location", "property.description", "property.price", "landlord.lname", "landlord.lemail", "landlord.lphone", "landlord.lid"]; 
    $tables = ['property', 'landlord', 'booking'];
    $joinConditions = [
      'property.landlord = landlord.lid',
      'property.pid = booking.property'
    ];
    $conditions = "booking.status = 0 or booking.bid IS NULL group by property.pid";
    $rentals = $crud->leftOuterJoin($select,$tables,$joinConditions,$conditions);
    // $table = "property";
    // $selectColumns = ["property.rooms", "property.pid", "property.photo", "property.location", "property.description", "property.price", "landlord.lname", "landlord.lemail", "landlord.lphone","landlord.lid"];
    // $joinTable = "landlord";
    // $joinCondition = "property.landlord = landlord.lid";
    // $rentals = $crud->selectJoin($table, $joinTable, $joinCondition, $selectColumns);
    if($rentals){
    while ($row = mysqli_fetch_assoc($rentals)) {
      $pid = $row["pid"];
      $photo = $row["photo"];
      $landlordName = $row["lname"];
      $rooms = $row["rooms"];
      $location = $row["location"];
      $description = $row["description"];
      $email = $row["lemail"];
      $phone = $row["lphone"];
      $tid = $_SESSION["tid"];
      $lid = $row["lid"];

      ?>
      <?php

      ?>
      <div class="rent-card">
        <div class="rent-details">
          <div class="rent-image">
            <img src="<?php echo $photo; ?>" alt="Rent Image">
          </div>
          <div class="rent-info">
            <h2>Rent
              <?php echo $pid; ?>
            </h2>
            <p>Price: Rs.
              <?php echo " " . $row["price"]; ?>/month
            </p>
            <p>Description:
              <?php echo $description; ?>
            </p>
            <p>Owner:
              <?php echo $landlordName ?>
            </p>
            <p>Location:
              <?php echo $location ?>
            </p>
            <?php $lid ?>
          </div>
        </div>
        <?php $table = "booking";
        $tid = $_SESSION['tid'];

        ?>
        <button class="apply-button"
          onclick="showConfirm('<?php echo $pid; ?>','<?php echo $tid; ?>','<?php echo $lid; ?>','<?php echo $table; ?>')">Apply</button>


        <div id="apply-form" class="apply-form">
        </div>
      </div>
    <?php }} 
    else{
      echo "<script>alert('No Rooms available for rents!')</script>";
    }?>
  </div>

  </div>
  <script>

    function showConfirm(pid, tid, lid, table) {

      var message = "Request for Rent?";
      var confirmBox = document.createElement("div");
      confirmBox.classList.add('confirm-box');

      var messageBox = document.createElement("div");
      messageBox.classList.add('message-box');
      messageBox.textContent = message;
      confirmBox.appendChild(messageBox);
      document.body.appendChild(confirmBox);

      var buttonBox = document.createElement("div");
      buttonBox.classList.add("button-box");
      messageBox.appendChild(buttonBox);

      var yesLink = document.createElement("a");
      var yesButton = document.createElement("button");
      yesButton.classList.add("yes-button");
      yesButton.textContent = "Yes";
      buttonBox.appendChild(yesButton);

      var noLink = document.createElement("a");
      var noButton = document.createElement("button");
      noButton.classList.add("no-button");
      noButton.textContent = "No";
      buttonBox.appendChild(noButton);

      yesButton.addEventListener('click', function () {
        confirmBox.style.display = "none";

        let ajax = () => {


          let req = new XMLHttpRequest();
          req.open('post', 'tenant.operations.php', true);
          req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          req.send("pid=" + pid + "&tid=" + tid + "&table=" + table + "&lid=" + lid + "&table=" + table + "&action=requestRent");
          req.onload = function () {
            alert(this.responseText);
          }

        }

        ajax();

      });

      noButton.addEventListener('click', function () {
        confirmBox.style.display = "none";
      })
    }


  </script>
</body>

</html>