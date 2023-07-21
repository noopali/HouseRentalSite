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
        justify-content: center;
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
      .verify{
        margin-top: 40px;
      }
  /* css for verification form */
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

    </style>
    <div class="search-section">
      <h1>Welcome <?php echo $_SESSION['tname']?></h1>
      </div>
      <div class="verify">
        <?php
        $email = $_SESSION['temail'];
          $verified = $_SESSION["verified"];
          $select = $crud->selectAll("tenant","=","temail",$email);
         $tenant = mysqli_fetch_assoc($select);
        //   $firstName = $tenant["tname"];
        //   $lastName = $tenant["tlastname"];
        //  $temail =  $tenant["temail"];
        //   $tphone = $tenant["tphone"];
        //   $taddress = $tenant["taddress"];
        
          $trequest = $tenant["request"];
          // echo "<script>alert('{$trequest}');</script>";
        if($verified==0){
          if($trequest == 0){
            echo "<script>alert('Verify Your Identity to rent the rooms');</script>";
            echo "<button id='verify-btn'> Verify Your Identity</button>";
          }
          else{
            echo "<script>alert('Your Verification is pending')</script>";
          }
          
          
        }
          ?>
        
      </div> 
    < <div class="verify-overlay" style="display: none;">
    <div class="verify-alert">
      <h2>Verify yourself</h2>
      <form id="rentalForm"  method="post" enctype="multipart/form-data" action = "tenant.operations.php">
        
        <input type="hidden" name="action" value="verify">
        Enter Your Identification Document <input type="file" id="photoInput" name="photo" accept="image/jpeg, image/png, image/jpg" required>
        <button type="submit" id="rentalFormSubmit" name="submit">Submit</button>
        <button type="button" id="closePopupButton">Close</button>
      </form>
    </div>
  </div>
    <div class="rents-container">
      <?php
      
      $select = ["property.pid","property.rooms", "property.photo", "property.location", "property.description", "property.price", "landlord.lname", "landlord.lemail", "landlord.lphone", "landlord.lid",]; 
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
  </div>
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
          // $verified = $_SESSION["verified"];
          
        if ($verified == 1) {
          echo "<button class='apply-button' onclick='showApplyForm(" . $pid . ")'>Apply</button>";
        }
        
        
          ?>

          <!-- <button class="apply-button" onclick="showApplyForm(<?php echo $pid; ?>)">Apply</button> -->

  <div class="apply-form" id="applyForm-<?php echo $pid; ?>">
    <h3>Apply for Rental</h3>
    <form onsubmit="return validateForm(<?php echo $pid; ?>)" action = "tenant.operations.php" method="post">
      <!-- Hidden parameters -->
      <input type="hidden" name="action" value="requestRent">
      <input type="hidden" name="pid" value="<?php echo $pid; ?>">
      <input type="hidden" name="tid" value="<?php echo $tid; ?>">
      <input type="hidden" name="lid" value="<?php echo $lid; ?>">
      <input type="hidden" name="table" value="<?php echo $table?>">

      <!-- Date inputs -->
      From: <input type="date" name="fromDate" id="fromDate-<?php echo $pid; ?>" required><br>
      To: <input type="date" name="toDate" id="toDate-<?php echo $pid; ?>" required><br>

      <!-- Submit button -->
      <input type="submit" value="Submit">
    </form>
  </div>
  </div>
        </div>
        
      <?php 
          }
      } 
      else{
        echo "<script>alert('No Rooms available for rents!')</script>";
      }?>
      
    </div>
      
    </div>
    <script>
      function showApplyForm(pid) {
      var applyForm = document.getElementById("applyForm-" + pid);
      applyForm.style.display = "block";
    }

    function validateForm(pid) {
      var fromDate = new Date(document.getElementById("fromDate-" + pid).value);
      var toDate = new Date(document.getElementById("toDate-" + pid).value);
      var currentDate = new Date();

      // Validate "from" and "to" inputs
      if (fromDate > toDate) {
        alert("Error: 'From' date should not be greater than 'To' date.");
        return false;
      }

      if (fromDate < currentDate) {
        alert("Error: 'From' date should be equal to or greater than the current date.");
        return false;
      }
      if (toDate< currentDate){
        alert("Error: 'To' date should not be greater than the current date.")
      }
      if (toDate < fromDate) {
        alert("Error: 'To' date should be greater than or equal to 'From' date.");
        return false;
      }
      var oneMonthLater = new Date(fromDate);
    oneMonthLater.setMonth(oneMonthLater.getMonth() + 1);
    if (toDate < oneMonthLater) {
      alert("Error: 'To' date should be at least one month after the 'From' date.");
      return false;
    } 

      var applyForm = document.getElementById("applyForm-" + pid);
      applyForm.style.display = "none";

      return true;}


      const verifyButton = document.getElementById("verify-btn");

// Get the verification form element
const verifyForm = document.querySelector(".verify-overlay");

// Get the close button element inside the verification form
const closeButton = document.getElementById("closePopupButton");

// Function to show the verification form
function showVerifyForm() {
  verifyForm.style.display = "flex"; // Corrected: Change display to "flex" to show the form overlay
}

// Function to hide the verification form
function hideVerifyForm() {
  verifyForm.style.display = "none";
}

// Add event listener to the verify button
verifyButton.addEventListener("click", showVerifyForm);

// Add event listener to the close button inside the verification form
closeButton.addEventListener("click", hideVerifyForm);
    </script>
  </body>

  </html>