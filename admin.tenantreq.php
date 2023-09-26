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

/* .rental-form-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
} */

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
  max-width: 400px;
  height: 300px;
}
.rentalformDiv{
  display: flex;
flex-direction: column;
align-items: ;
justify-content: flex-start;
}
.rentalformDiv input{
  display:inline-block;
  
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
  margin-top: 200px;
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

.applicant-section {
  margin-top: 30px;
}

.applicant-section h2 {
  text-align: center;
}

#applicantCount {
  text-align: center;
  margin-bottom: 10px;
}

#applicantList {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.applicant-item {
  border: 1px solid #ddd;
  padding: 10px;
  margin-bottom: 10px;
}

.applicant-item h4 {
  margin: 0;
}

.applicant-item p {
  margin: 5px 0;
}

.applicant-item .applicant-actions {
  text-align: right;
}

.rental-table-image {
  max-width: 100px;
  max-height: 100px;
}
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
.logo>img{
  width: 150px;
  height: 60px;
}
.navbar{
  display: flex;
  list-style: none;
}
.navbar li{
  position: relative;
}
.navbar a{
  font-size: 1rem;
  padding: 0.625rem 20px;
  color: purple;
  font-weight: 500;
  text-decoration: none;
}
.navbar a::after{
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
  background:purple;
  color: white;
  border-radius: 0.5rem;
}
.header-btn .log-in:hover {
   color:skyblue;

}

.delete-btn{
  display: inline-block;
  height: 40px;
  width: 80px;
}


.table {
  margin-top: 100px;
  width: 100%; /* Set the width of the table to fill the container */
  table-layout: fixed; /* Prevent the table from adjusting column width */
}

.zoom-container {
  overflow: hidden;
  max-width: 300px; /* Set the maximum width of the container */
  margin: 0 auto; /* Center the container within the table cell */
}

#doc {
  transition: transform 0.3s;
  display: block; /* Make the image a block element */
  width: 100%; /* Set the image width to fill the container */
  height: auto; /* Maintain the image aspect ratio */

}

.zoomed {
  transform: scale(4.5); /* Set the desired zoom level (1.5 for 150% zoom, etc.) */
  transform-origin: center; /* Set the origin of the zoom (center in this case) */
  z-index: 4000;
}
  </style>
</head>
<script src ="jquery.js"></script>

<body>
<header>
    <a href="#" class="logo"><img src="logo.png" alt=""></a>
    <ul class="navbar">
    <li><a href="admin.tenantreq.php">Tenant Requests</a></li>
      <li><a href="admin.landlordreq.php">Landlord Requests</a></li>
      <li><a href="admin.tenantmgmt.php">Tenant Management</a></li>
      <li><a href="admin.view.php">Landlord Management</a></li>
      <li><a href="admin.property.php">Property Management</a></li>
        </ul>
    <div class="header-btn">
      <a href="logout.php" class="log-in">Log out</a>
    </div>
  </header>
    <h1>Welcome, <?php echo $_SESSION["aname"];?></h1>
    
    
   </div>

  <div class="rental-list">
    <h2>Tenant Requests</h2>
    <table id="rentalTable">
      <thead>
        <tr>
          <th>Id</th>
          <th>Full Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Address</th>
          <th>Document</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="rentalTableBody">
        <?php
         $table = "tenant";
        
         $select = $crud->selectCondition($table,"*","request = 1 and verified = 0");
         
         while ($row = mysqli_fetch_assoc($select)) {
           $id = $row["tid"];
           $document = $row["tdocument"];
           $firstName = $row["tname"];
           $lastName = $row["tlastname"];
           $Phone = $row["tphone"];
           $Email = $row["temail"];
           $Address = $row["taddress"];
           $verified = $row["verified"];

         ?>
           <tr>
              <td><?php echo $id; ?></td>
              <td><?php echo $firstName." ". $lastName ?></td>
              <td><?php echo $Phone ?></td>
              <td><?php echo $Email ?></td>
              <td><?php echo $Address ?></td>
             <td>  <div id="zoomContainer">
    <img id="doc" src="<?php echo $document?>" alt="">
  </div>
  <td>
  <form action="admin.operations.php" method="post">
  <input type="hidden" name="table" value = "tenant">
    <input type="hidden" name="action" value = "verifyTenant">
      <input type="hidden" name="temail" value = "<?php echo $Email?>">
      <button type="submit" >Verify</button>
    </form>
  <td>
    
  </button></a></td>
</td>

             
           </tr>
         <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- <div class="applicant-section">
    <h2>Tenant Applications</h2>
    <div id="applicantCount">Number of Applicants: <span id="applicantCountValue">0</span></div>
    <ul id="applicantList"></ul>
  </div> -->
  <script>
    const zoomContainer = document.getElementById('zoomContainer');
const docImage = document.getElementById('doc');

zoomContainer.addEventListener('mouseover', () => {
  docImage.classList.add('zoomed');
});

zoomContainer.addEventListener('mouseout', () => {
  docImage.classList.remove('zoomed');
});

  </script>
  
</body>
</html>