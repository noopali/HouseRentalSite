<?php
include("sign_up.view.php");
require "crud.php";
$crud = new crud();

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$role = $_POST["select"];
$password = $_POST["password"];
$rpassword = $_POST["rpassword"];
$email = $_POST["email"];
$phone = $_POST["phone"];


$table = $role;

if (isset($_POST["signup"])) {
    $errors = array();
    // Validate username
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    } elseif (strlen($firstname) < 3) {
        $errors[] = "First name should be at least 3 characters long.";
    }
    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    } elseif (strlen($lastname) < 3) {
        $errors[] = "Last name should be at least 3 characters long.";
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
        if($role=="admin"){
            $userdetails = [
                "aname" => $firstname,
                "apassword" => $password,
                "aemail" => $email,
                "aphone" => $phone
            ];

        }
        else if($role == "tenant"){
            $userdetails = [
                "tname" => $firstname,
                "tlastname"=>$lastname,
                "tpassword" => $password,
                "temail" => $email,
                "tphone" => $phone
            ];

        }
        else if($role == "landlord"){
            $userdetails = [
                "lname" => $firstname,
                "llastname"=>$lastname,
                "lpassword" => $password,
                "lemail" => $email,
                "lphone" => $phone
            ];
        }
        else{
            echo "<script>alert('error')</script>";
        }
        $emailKey = array_keys($userdetails,$email);
        $phoneKey = array_keys($userdetails,$phone);
        $passwordKey = array_keys($userdetails,$password);
        // $firstNameKey =  array_keys($userdetails,$firstname);
        // $lastNameKey =  array_keys($userdetails,$firstname);

        $emailResult = $crud->selectAll($table, "=",$emailKey[0], $email); // Parameters: {Tablename, operator, key, value}
        $phoneResult = $crud->selectAll($table, "=",$phoneKey[0], $phone);
        $ecount = mysqli_num_rows($emailResult);
        $pcount = mysqli_num_rows($phoneResult);

        if ($ecount > 0) {
            echo "<script>alert('Email already exists');</script>";
        } elseif ($pcount > 0) {
            echo "<script>alert('Phone number already exists');</script>";
        } else {
            if ($password == $rpassword) {
                $hashedPassword = password_hash($userdetails[$passwordKey[0]], PASSWORD_DEFAULT);
                $userdetails[$passwordKey[0]] = $hashedPassword;
                $crud->insert($table, $userdetails);
                // ...

                // If there are any errors, store them in a variable
                $errorMessages = array();
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        $errorMessages[] = $error;
                    }
                }

                // If there are any errors, display them
                if (!empty($errorMessages)) {
                    foreach ($errorMessages as $errorMessage) {
                        echo $errorMessage . "<br>";
                    }
                } else {
                   

                    echo "<script>window.location.href = 'login.view.php';</script>";
                }


            } else {
                echo "<script>alert('Passwords do not match');</script>";
            }
        }
    }
}