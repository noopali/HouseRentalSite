<?php
include("sign_up.view.php");
require "crud.php";
$crud = new crud();

$username = $_POST["username"];
$role = $_POST["select"];
$password = $_POST["password"];
$rpassword = $_POST["rpassword"];
$email = $_POST["email"];
$phone = $_POST["phone"];

$table = $role;

if (isset($_POST["signup"])) {
    $errors = array();

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username should be at least 3 characters long.";
    }

    // Validate role
    $validRoles = array("tenant", "landlord","admin");
    if (empty($role)) {
        $errors[] = "Role is required.";
    } elseif (!in_array($role, $validRoles)) {
        $errors[] = "Invalid role selected.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password should be at least 6 characters long.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    } else {
        // Validate phone number
        if (empty($phone)) {
            $errors[] = "Phone number is required.";
        } elseif (!preg_match("/^\d{10}$/", $phone)) {
            $errors[] = "Invalid phone number.";
        }
    }

    // If there are any errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    /*
    if($crud->exists($table,"email",$email))
    {
        echo  "<script>alert('Email already exists');</script>";
    }
    */else {
        $userdetails = [
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "phone" => $phone
        ];
        $emailResult = $crud->selectAll($table, "=", "email", $email); // Parameters: {Tablename, operator, key, value}
        $phoneResult = $crud->selectAll($table, "=", "phone", $phone);
        $ecount = mysqli_num_rows($emailResult);
        $pcount = mysqli_num_rows($phoneResult);

        if ($ecount > 0) {
            echo "<script>alert('Email already exists');</script>";
        } elseif ($pcount > 0) {
            echo "<script>alert('Phone number already exists');</script>";
        } else {
            if ($password == $rpassword) {
                $hashedPassword = password_hash($userdetails["password"], PASSWORD_DEFAULT);
                $userdetails["password"] = $hashedPassword;
                $crud->insert($table, $userdetails);
                // ...

                // If there are any errors, store them in a variable
                $errorMessages = array();
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        $errorMessages[] = $error;
                    }
                }
                /*
                if($crud->exists($table,"email",$email))
                {
                    $errorMessages[] = "Email already exists";
                }
                */

                // If there are any errors, display them
                if (!empty($errorMessages)) {
                    foreach ($errorMessages as $errorMessage) {
                        echo $errorMessage . "<br>";
                    }
                } else {
                    // ... rest of your code ...

                    // Instead of the header() function, you can use JavaScript to redirect the user
                    echo "<script>window.location.href = 'login.view.php';</script>";
                }


            } else {
                echo "<script>alert('Passwords do not match');</script>";
            }
        }
    }
}

/*
function emailExists($email, $crud, $table){
    $columns = $crud->getColumnNames($table); // Get the column names of the table
    foreach($columns as $column){
        $emailResult = $crud->selectAll($table, "=", $column, $email);
        $count = mysqli_num_rows($emailResult);
        if($count > 0){
            return true; // Email exists in the current column
        }
    }
    return false; // Email doesn't exist in any column
}


*/