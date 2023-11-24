<?php
session_start();
require "crud.php";
$crud = new Crud();
$_SESSION["lemail"];
$lastname = $_SESSION["lastname"];
$firstname = $_SESSION["lname"];
$lid = $_SESSION["lid"];
$role = $_SESSION["role"];
$verified = $_SESSION["verified"];
$phone = $_SESSION["lphone"];
$email = $_SESSION["lemail"];
$address = $_SESSION["laddress"];
$select = $crud->selectAll("property","=","landlord",$lid);
$count = mysqli_num_rows($select);




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="profile-card">
  <img src="pp.jpg" alt="Profile Picture" class="profile-picture">
    <h2 class="profile-name">
      <?php echo "$firstname $lastname" ?>
    </h2>
    <ul class="profile-details">
      <li><strong>Role:</strong>
        <?php echo " " . $role ?>
      </li>
      <li><strong>Email:</strong>
        <?php echo " " . $email ?>
      </li>
      <li><strong>Phone Number:</strong>
        <?php echo" " . $phone ?>
      </li>
      
      <li><strong>No of Rentals:</strong>
        <?php echo $count ?>
      </li>
      <li><strong>Address:</strong>
        <?php echo $address ?>
      </li>
      <form action="landlord.review.php" method = "POST">
          <input type="hidden" name="action" value ="showRatings">
        <input type="hidden" name="lid" value="<?php echo $lid?>">
        <button class="apply-button" type = "submit" >show reviews</button>
        <br>
        </form>
    </ul>
    
    <div class="back-button">
      <a href="landlord.view.php">Back to Home</a>
    </div>
  </div>
  </div>

</body>

<!--CSS--->



<style>
  * {
    text color: white;
    font-family:sans-serif;
  }

  /**css comment on table */
  body {
    background-image: url("login.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #CBC3E3;
  }

  .profile-card {
    width: 500px;
    height: 500px;
    border: 3px solid;
    background-color: #905FD0;
    color: white;
    padding: 20px;
    border-radius: 8px;
    position: relative;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }


  .profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 0 auto;
    display: block;
  }

  .profile-name {
    text-align: center;
    margin-top: 10px;
  }

  .profile-description {
    text-align: center;
    color: white;
    margin-top: 5px;
  }

  .profile-details {
    margin-top: 15px;
    list-style-type: none;
    padding: 0;
    text-align: center;
  }

  .profile-details li {
    margin-bottom: 8px;
  }

  .profile-details strong {
    font-weight: bold;
  }

  .profile-details a {
    color: white;
    text-decoration: none;
  }

  .back-button {
    position: absolute;
    color: white;
    bottom: 30px;
    border: 3px solid;
    height: 30px;
    display: inline-block;
    margin: auto;

  }

  .back-button a {
    color: white;
    text-decoration: none;
    height: 20px;
    background-color: purple;
    transition: background-color 0.3s;
    padding: 5px;
  }

  .back-button a:hover {
    background-color: orange;
  }
</style>

</html>