<?php
session_start();
require "crud.php";
$crud = new Crud();
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
      <li><a href="tenant.mybookings.php">My Bookings</a></li>
      <li><a href="tenant.profile.php">My Profile</a></li>
    </ul>
    <div class="header-btn">
      <a href="logout.php" class="log-in">Log out</a>
    </div>
  </header>
  <style>
    /* CSS styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .search-section {
      background-image: url('home1.jpg');
      background-size: cover;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: space-evenly;
      flex-direction: column;

    }

    .rents-container {
      margin: 50px;
    }

    .rent-card {
      background: #D7A1F9;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px;
      width: 900px;
      margin: 0 auto;
      margin-bottom: 20px;
      border: 3px solid black;
      display: flex;
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
      width: 100px;
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
    .search-section h1{
      color: white;
    }
   .stars{
    color: yellow;
    height:30px;
    width:30px;
   }
   h1{
    margin-top: 70px;
   }
  </style>
  <div class="search-section">
<?php
$lid = $_POST["lid"];
$select = ["tenant.tname","rating.stars","rating.feedback","landlord.lname"];
$table = ["rating","tenant","landlord"];
$joinConditions = ["rating.tid = tenant.tid","rating.lid = landlord.lid"];
$conditions = ["landlord.lid = {$lid}"];
$ratingTable = $crud->multiJoinQuery($table, $joinConditions, $conditions,$select);
// $row = mysqli_fetch_assoc($ratingTable);
?>
    <h1>Rating And Reviews
      
  
    </h1>
    <h2>Average Rating:
    <?php
        $sql = $crud->selectCondition("rating","avg(stars) as avg_rating","lid = $lid");
       $row =  mysqli_fetch_assoc($sql);
        echo $row["avg_rating"]."/5";
      ?>
    </h2>
  </div>
  <div class="rents-container">
    <?php

    while ($row = mysqli_fetch_assoc($ratingTable)) {
      ?>
      <div class="rent-card">
        <div class="rent-image">
          <img src="New folder/5907.jpg" alt="Tenant Photo">
        </div>
        <div class="rent-info">
           <h2><?php echo " " . $row["tname"]; ?></h2> 
         
          <p>
            <strong>Comment:</strong>
            <?php echo $row["feedback"]; ?>
          </p>

            <strong>Stars:</strong>
            <?php $stars = $row["stars"];
          
            switch($stars){
              case 0:{
                echo "<p>Zero Star Rating</p>";
                break;
              }
              case 1:{
                echo "<p><img class = 'stars' src= 'stars.png'></p>";
                break;
              }
              case 2:{
                echo "<p>
                       <img class = 'stars' src= 'stars.png'>
                       <img class = 'stars' src= 'stars.png'>
                      </p>";
                       break;
              }
              case 3:{
                echo "<p>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'star-solid.svg'></p>";
                break;
              }
              case 4:{
                echo "<p>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                </p>";
                break;
              }
              case 5:{
                echo "<p>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>
                <img class = 'stars' src= 'stars.png'>

                </p>";
                break;
                
              }
            }  
            ?>
            
          </p>
          <?php $lid ?>
        </div>
      </div>

      <?php
    }

    ?>


</body>

</html>