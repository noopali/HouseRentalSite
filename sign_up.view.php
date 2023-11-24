<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-image: url("login.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      overflow-y: scroll;
    }

    .signup-container {
      width: 300px;
      margin: 100px auto;
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 5px;
      margin-top: 50px;
    }

    h2 {
      text-align: center;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="tel"],
    select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .error-message {
      color: red;
      font-size: 12px;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <div class="signup-container">
    <h2>Sign Up</h2>
    <form id="signup-form" method="POST" action="signupcopy.php" onsubmit="return validateForm()">
      <input type="text" id="firstname" placeholder="First Name" name="firstname">
      <span id="firstname-error" class="error-message"></span>
      <input type="text" id="lastname" placeholder="Last Name" name="lastname">
      <span id="lastname-error" class="error-message"></span>

      <input type="password" id="password" placeholder="Password" name="password">
      <span id="password-error" class="error-message"></span>
      <input type="password" id="repassword" placeholder="Retype Password" name="rpassword">
      <span id="repassword-error" class="error-message"></span>
      <input type="email" id="email" placeholder="Email" name="email">
      <span id="email-error" class="error-message"></span>
      <input type="tel" id="phone" placeholder="Phone Number" name="phone">
      <input type="text" id="address" placeholder="Address" name="address">
      <span id="address-error" class="error-message"></span>

      <span id="phone-error" class="error-message"></span>
      <select id="role" name="select" required>
        <option value="">Select Role</option>
        <option value="landlord">Landlord</option>
        <option value="tenant">Tenant</option>
      </select>
      <span id="role-error" class="error-message"></span>
      <button type="submit" name="signup">Sign Up</button>
      <a href="login.view.php">Account exists? Login</a>
    </form>
  </div>
  <script>
    function validateForm() {
      // Clear previous error messages
      clearErrorMessages();

      // Get form inputs
      var firstname = document.getElementById('firstname').value;
      var lastname = document.getElementById('lastname').value;
      var password = document.getElementById('password').value;
      var repassword = document.getElementById('repassword').value;
      var email = document.getElementById('email').value;
      var phone = document.getElementById('phone').value;
      var role = document.getElementById('role').value;

      // Username validation regex pattern
      var usernamePattern = /^[A-Z][a-zA-Z0-9]*$/;

      // Password validation regex pattern
      var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=])[A-Za-z\d!@#$%^&*()_\-+=]{6,}$/;

      // Email validation regex pattern
      var emailPattern = /^[\w.-]+@[a-zA-Z_-]+?(?:\.[a-zA-Z]{2,6})+$/;

      // Phone number validation regex pattern
      var phonePattern = /^\d{10}$/;


      // Validation checks
      var isValid = true;
      
      if (!usernamePattern.test(firstname)) {
        displayErrorMessage('firstname', 'First name must start with an uppercase letter');
        isValid = false;
      }
      if (!usernamePattern.test(lastname)) {
        displayErrorMessage('lastname', 'Last name must start with an uppercase letter');
        isValid = false;
      }
      if (password.length < 6) {
        displayErrorMessage('password', 'Password must be at least 6 characters long');
        isValid = false;
      }
      if (!passwordPattern.test(password)) {
        displayErrorMessage('password', 'Password must contain at least one uppercase letter, one number, and one special symbol');
        isValid = false;
      }
      if (password !== repassword) {
        displayErrorMessage('repassword', 'Passwords do not match');
        isValid = false;
      }
      if (!emailPattern.test(email)) {
        displayErrorMessage('email', 'Please enter a valid email');
        isValid = false;
      }
      if (!phonePattern.test(phone)) {
        displayErrorMessage('phone', 'Phone number must be 10 digits');
        isValid = false;
      }
      if (role === '') {
        displayErrorMessage('role', 'Please select a role');
        isValid = false;
      }
      return isValid;
    }

    function displayErrorMessage(fieldId, message) {
      var errorElement = document.getElementById(fieldId + '-error');
      errorElement.textContent = message;
    }

    function clearErrorMessages() {
      var errorElements = document.getElementsByClassName('error-message');
      for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].textContent = '';
      }
    }

  </script>
</body>

</html>