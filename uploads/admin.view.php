<?php
session_start();
require "crud.php";
$crud = new Crud();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Page</title>
  <style>
    /* CSS styles */
    header{
      text-align: center;
    }
    .landlord-table{
      border: 3px solid;
    }

  </style>
  <script>
    function showTable(tableName) {
      var landlordContainer = document.getElementById("landlordContainer");
      var tenantContainer = document.getElementById("tenantContainer");

      if (tableName === "landlord") {
        landlordContainer.style.display = "block";
        tenantContainer.style.display = "none";
      } else if (tableName === "tenant") {
        landlordContainer.style.display = "none";
        tenantContainer.style.display = "block";
      }
    }
  </script>
</head>
<body>
  <header>
    <h1>Welcome, Admin!</h1>
    <div class="logout"><a href="logout.php"><button>Logout</button></a></div>
  </header>
  <main>
    <h2>Landlord Management</h2>
    <button onclick="showTable('landlord')">Landlord Details</button>
    <div id="landlordContainer" style="display: none;">
      <table id="landlord-table">
        <!-- Table structure and header row -->
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        <?php
        $table = "landlord";
        $select = $crud->selectNoCondition($table);
        while ($row = mysqli_fetch_assoc($select)) {
          $id = $row["lid"];
          $username = $row["username"];
          $Phone = $row["phone"];
          $Email = $row["email"];
        ?>
          <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $Phone ?></td>
            <td><?php echo $Email ?></td>
            <td><a href="delete.php?table=<?php echo $table; ?>&key=lid&value=<?php echo $id; ?>&action=delete"><button>Delete</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <h2>Tenant Management</h2>
    <button onclick="showTable('tenant')">Tenant Details</button>
    <div id="tenantContainer" style="display: none;">
      <table>
        <!-- Table structure and header row -->
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        <?php
        $table = "tenant";
        $select = $crud->selectNoCondition($table);
        while ($row = mysqli_fetch_assoc($select)) {
          $id = $row["id"];
          $username = $row["username"];
          $Phone = $row["phone"];
          $Email = $row["email"];
        ?>
          <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $Phone ?></td>
            <td><?php echo $Email ?></td>
            <td><a href="delete.php?table=<?php echo $table; ?>&key=id&value=<?php echo $id; ?>&action=delete"><button>Delete</button></a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </main>
</body>
</html>
