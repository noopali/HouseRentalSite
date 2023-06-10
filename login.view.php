<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="login.css">
  <script>
    function validateLoginForm() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var role = document.getElementById("role").value;
      var emailError = document.getElementById("emailError");
      var passwordError = document.getElementById("passwordError");
      var roleError = document.getElementById("roleError");
      
      // Clear previous error messages
      emailError.textContent = "";
      passwordError.textContent = "";
      roleError.textContent = "";
      
      // Validate email
      if (email.trim() === "") {
        emailError.textContent = "Email is required";
        return false;
      }
      
      // Validate password
      if (password.trim() === "") {
        passwordError.textContent = "Password is required";
        return false;
      }
      
      // Validate role
      if (role === "") {
        roleError.textContent = "Role is required";
        return false;
      }
      
      // Form is valid
      return true;
    }
  </script>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form id="login-form" action="login.php" method="POST" onsubmit="return validateLoginForm()">
      <input type="text" id="email" placeholder="Email" required name="email">
      <p class="error" id="emailError"></p>
      <input type="password" id="password" placeholder="Password" required name="password">
      <p class="error" id="passwordError"></p>
      <select id="role" required name="role">
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="landlord">Landlord</option>
        <option value="tenant">Tenant</option>
      </select>
      <p class="error" id="roleError"></p>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</body>
</html>
    