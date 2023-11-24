<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basobas</title>
  <link rel="stylesheet" href="style.css">
</head>
<header>
  <a href="#" class="logo"><img src="logo.png" alt=""></a>
  <ul class="navbar">
    <!-- <li><a href="index.php">Home</a></li> 
    <li><a href="about-us">landlord</a></li>
    <li><a href="reviews">Tenant</a></li> -->
  </ul>
  <div class="header-btn">
    <a href="sign_up.view.php" class="sign-up">Sign Up</a>
    <a href="login.view.php" class="log-in">Log In</a>
  </div>
</header>
<!-----Home Page------>

<body>
  <!---- CSS styles ---->

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
      width: 900px;
      margin: 0 auto;
      margin-bottom: 20px;
      border: 3px solid black;
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
      display: block;
      background: purple;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

 

  </style>
  <?php
  require "crud.php";
  $crud = new Crud();



  ?>
  <!------Here is the body of homepage---->

  <div class="search-section">
    <h1>Basobas: "Room Rental System"</h1>
  </div>

  <div class="rents-container">

    <?php
    $select = ["property.pid", "property.rooms", "property.photo", "property.location", "property.description", "property.price", "landlord.lname", "landlord.lemail", "landlord.lphone", "landlord.lid",];
    $tables = ['property', 'landlord', 'booking'];
    $joinConditions = [
      'property.landlord = landlord.lid',
      'property.pid = booking.property'
    ];
    $conditions = "booking.status = 0 or booking.bid IS NULL group by property.pid";
    $rentals = $crud->leftOuterJoin($select, $tables, $joinConditions, $conditions);
    if ($rentals) {
      while ($row = mysqli_fetch_assoc($rentals)) {
        $pid = $row["pid"];
        $photo = $row["photo"];
        $landlordName = $row["lname"];
        $rooms = $row["rooms"];
        $location = $row["location"];
        $description = $row["description"];
        $email = $row["lemail"];
        $phone = $row["lphone"];
        $lid = $row["lid"];
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
              <p><strong>Price</strong> Rs.
                <?php echo " " . $row["price"]; ?>/month
              </p>
              <p>
                <strong>Description:</strong>
                <?php echo $description; ?>
              </p>
              <p>
                <strong>Owner:</strong>
                <?php echo $landlordName ?>
              </p>
              <p><strong>Location:</strong>
                <?php echo $location ?>
              </p>
            </div>
             
          </div>
          <button class="apply-button" onclick="signupPage()">Apply</button>
      </div>
          <?php
      }
    }
    ?>

    </div>
</body>

</html>

<script>
 function signupPage(){
  window.location.href = "sign_up.view.php";
 }
</script>
</body>
<footer>

  <!----CSS styles for the footer--->

  <style>
    footer {
      background: skyblue;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .footer-section {
      flex: 1;
      margin-right: 20px;
    }

    .footer-section h3 {
      margin-top: 0;
      margin-bottom: 10px;
    }

    .footer-section ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-section ul li {
      margin-bottom: 5px;
    }

    .footer-section ul li a {
      text-decoration: none;
      color: #333;
    }

    .footer-section ul li a:hover {
      text-decoration: underline;
    }

    .footer-section p {
      margin: 0;
      margin-bottom: 10px;
    }
  </style>


  <div class="footer-section">
    <h3>Available Places</h3>
    <ul>
      <li>Place 1</li>
      <li>Place 2</li>
      <li>Place 3</li>
      <!-- Add more available places as needed -->
    </ul>
  </div>

  <div class="footer-section">
    <h3>Available Districts</h3>
    <ul>
      <li><a href="#rent1">District 1</a></li>
      <li><a href="#rent2">District 2</a></li>
      <li><a href="#rent3">District 3</a></li>
      <!-- Add more available districts as needed -->
    </ul>
  </div>

  <div class="footer-section">
    <h3>Terms and Conditions</h3>
    <p>We are not responsible for any problems that may occur between landlords and tenants during the payment process.
    </p>
  </div>
</footer>

</html>