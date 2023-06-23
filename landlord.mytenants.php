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

    .rental-table-image {
      max-width: 100px;
      max-height: 100px;
    }

    /* Nav bar css */
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

    .logo>img {
      width: 150px;
      height: 60px;
    }

    .navbar {
      display: flex;
      list-style: none;
    }

    .navbar li {
      position: relative;
    }

    .navbar a {
      font-size: 1rem;
      padding: 0.625rem 20px;
      color: purple;
      font-weight: 500;
      text-decoration: none;
    }

    .navbar a::after {
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
      background: purple;
      color: white;
      border-radius: 0.5rem;
    }

    .header-btn .log-in:hover {
      color: skyblue;
    }

    h1 {
      text-align: center;
      margin-top: 150px;
    }

    /* Confirm box css */
    .confirm-box{
      background:rgba(0,0,0,0.5);
      width:100%;
      height: 100%;
      position: fixed;
      top:0;
      left:0;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .message-box{
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        line-height:1.5;
        padding:20px;
        border-radius: 5px;
        background-color: white ;
        height: 200px;
        width:400px;
        
        
    }
    .yes-button,.no-button{
      display:inline-block;
      height:50px;
      width:80px;

    }
    .button-box{
      display:flex;
      justify-content: space-evenly;
      margin-top:40px;  
    }
    .yes-button{
      background-color: green;
    }
    .no-button{
      background-color: red;
    }
  </style>
</head>
<script src="jquery.js"></script>
<body>
  <header>
    <a href="landlord.view.php" class="logo"><img src="logo.png" alt=""></a>
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
  <h1 class="Requests heading">My Tenants</h1>

  <div class="rental-list">
    <table id="rentalTable">
      <thead>
        <tr>
          <th>Tenant Name</th>
          <th>Phone</th>
          <th>property id</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody id="rentalTableBody">
        <?php
        $propertySelect = $_SESSION['property'];
        $table = "booking";
        $lid = $_SESSION['lid'];
        $selectColumns = ["booking.bid,tenant.tname","tenant.tid", "tenant.tphone", "booking.property","tenant.taddress"];
        $joinCondition = "booking.tenant = tenant.tid";
        $condition = "booking.landlord = '{$lid}' and booking.request = '1' and booking.status = '1 '";
        $select = $crud->selectJoinCondition($table, "tenant", $joinCondition, $condition, $selectColumns);

        if ($select) {
          while ($row = mysqli_fetch_assoc($select)) {
            echo "<tr>";
            echo "<td>" . $row["tname"] . "</td>";
            echo "<td>" . $row["tphone"] . "</td>";
            echo "<td>" . $row["property"] . "</td>";
            echo "<td>" .$row["taddress"]. "</td>";
            $row['tid'];
            $row['bid'];
          }
        } else {
          echo "<script>alert('No accepted tenants!');</script>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>