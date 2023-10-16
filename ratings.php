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
      height: 400px;
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
      width: 1200px;
      margin-left: 55px;
      margin-right: 55px;
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
      margin-bottom: 10px;
    }

    .rent-card .apply-button:hover {
      background: red;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 10px;
    }
  </style>
  <div class="search-section">

    <h1>Rating And Reviews of
      <?php echo $_SESSION['tname'] ?>

    </h1>
  </div>
  <div class="rents-container">
    <?php
    $lid = $_POST["lid"];
     $select = ["tenant.tname","rating.stars","rating.feedback","landlord.lname"];
    $table = ["rating","tenant","landlord"];
    $joinConditions = ["rating.tid = tenant.tid","rating.lid = landlord.lid"];
    $conditions = ["landlord.lid = {$lid}"];
    
    $ratingTable = $crud->multiJoinQuery($table, $joinConditions, $conditions,$select);
  

    $row = mysqli_fetch_assoc($ratingTable);

    while ($row = mysqli_fetch_assoc($ratingTable)) {
      ?>
      <div class="rent-card">
        <div class="rent-image">
          <img src="<?php echo $photo; ?>" alt="Tenant Photo">
        </div>
        <div class="rent-info">
          <p><strong>From</strong> Rs.
            <?php echo " " . $row["tname"]; ?>
          </p>
          <p>
            <strong>Comment:</strong>
            <?php echo $row["feedback"]; ?>
          </p>

            <strong>stars:</strong>
            <?php echo $row["stars"] ?>
          </p>
          <?php $lid ?>
        </div>
      </div>

      <?php
    }

    ?>


</body>

</html>