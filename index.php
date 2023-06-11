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
    <li><a href="index.php">Home</a></li> 
    <li><a href="about-us">About Us</a></li>
    <li><a href="reviews">Reviews</a></li>
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
.search-section {
    background-image: url('background.jpg');
    background-size: cover;
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 20px; /* Add margin-top to create space below the navbar */
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

</style>

 <!------Here is the body of homepage---->

  <div class="search-section">
    <h1>Search by Location</h1>
    <form id="search-form" onsubmit="searchByLocation(event)">
      <input type="text" id="address-input" placeholder="Enter address" required>
      <button type="submit">Go</button>
    </form>
  </div>
  
  <div class="rents-container">
    <div class="rent-card">
      <div class="rent-details">
        <div class="rent-image">
          <img src="uploads\chastity-cortijo-R-w5Q-4Mqm0-unsplash(1).jpg" alt="Rent 1 Image">
        </div>
        <div class="rent-info">
          <h2>Rent 1</h2>
          <p>Price: 10000/month</p>
          <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <button class="apply-button" onclick="showApplyForm(1)">Apply</button>
      <div id="apply-form-1" class="apply-form">
        <h3>Apply for Rent 1</h3>
        <form>
          <input type="text" placeholder="Name" required>
          <input type="email" placeholder="Email" required>
          <input type="tel" placeholder="Phone Number" required>
          <textarea placeholder="Description" required></textarea>
          <button type="submit">Submit</button>
        </form>
      </div>
    </div>
  
    <div class="rent-card">
      <div class="rent-details">
        <div class="rent-image">
          <img src="uploads\francesca-tosolini-hCU4fimRW-c-unsplash.jpg" alt="Rent 2 Image">
        </div>
        <div class="rent-info">
          <h2>Rent 2</h2>
          <p>Price: Rs.15000/month</p>ss
          <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <button class="apply-button" onclick="showApplyForm(2)">Apply</button>
      <div id="apply-form-2" class="apply-form">
        <h3>Apply for Rent 2</h3>
        <form>
          <input type="text" placeholder="Name" required>
          <input type="email" placeholder="Email" required>
          <input type="tel" placeholder="Phone Number" required>
          <textarea placeholder="Description" required></textarea>
          <button type="submit">Submit</button>
        </form>
      </div>
    </div>
    
    <!-- Add more rent cards as needed -->
    
  </div>
</body>
</html>

  <script>
    // JavaScript code
// JavaScript code
function showApplyForm(rentId) {
  var formId = "apply-form-" + rentId;
  var form = document.getElementById(formId);
  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
}

function searchByLocation(event) {
  event.preventDefault();
  
  // Get the address input value
  var addressInput = document.getElementById("address-input");
  var address = addressInput.value;
  
  // Perform search logic
  // ...
  // Add your search logic here, such as making API requests or filtering the rent data based on the address input
  
  // Clear the rent cards container
  var rentsContainer = document.querySelector(".rents-container");
  rentsContainer.innerHTML = "";
  
  // Add the search results or rent cards dynamically
  // ...
  // Add your code to dynamically generate and append the rent cards based on the search results or filtered data
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
    <p>We are not responsible for any problems that may occur between landlords and tenants during the payment process.</p>
  </div>
</footer>

</html>