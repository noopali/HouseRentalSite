document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    
    // Retrieve form values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var role = document.getElementById("role").value;
    var eerror = document.getElementById("emailerror");
    
    // Perform login validation
    if (username && password && role) {
      // Perform your server-side validation here
      // Example: Check the entered username, password, and role against your database
      if(username.length()<20){
          
      }
      // Simulating successful login
      alert("Login successful as " + role);
      // You can redirect the user to the appropriate page based on their role
    } else {
      alert("Please fill in all fields");
    }
  });
  