<?php
session_start();
include("login.view.php");
require "crud.php";
$crud = new Crud();
$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"];
$errors = array();

if (isset($_POST["login"])) {

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password should be at least 6 characters long.";
    }

    // Validate role
    $validRoles = array("admin", "landlord", "tenant");
    if (empty($role)) {
        $errors[] = "Role is required.";
    } elseif (!in_array($role, $validRoles)) {
        $errors[] = "Invalid role selected.";
    }

    // If there are any errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('{$error}')</script>";
        }
    } else {
        //$sel = $crud->getColumnNames($role);
        //$roleArray = mysqli_fetch_assoc($sel);
        // print_r($roleArray);
        if ($role == "landlord") {
            $select = $crud->selectAll($role, '=', "lemail", $email);
            $count = mysqli_num_rows($select);
        } else if ($role == "tenant") {
            $select = $crud->selectAll($role, '=', "temail", $email);
            $count = mysqli_num_rows($select);
        } else if ($role == "admin") {
            $select = $crud->selectAll($role, '=', "aemail", $email);
            $count = mysqli_num_rows($select);

        }

        if ($count > 0) {
            $row = mysqli_fetch_assoc($select);
            if ($role == "tenant") {
                $dbEmail = $row["temail"];
                $dbPassword = $row["tpassword"];
            } else if ($role == "landlord") {
                $dbEmail = $row["lemail"];
                $dbPassword = $row["lpassword"];
            } else if ($role == "admin") {
                $dbEmail = $row["aemail"];
                $dbPassword = $row["apassword"];
                $_SESSION["verified"] =$row["verified"];
            }

            if (password_verify($password, $dbPassword)) {

                if ($role == "landlord") {
                    $_SESSION["lemail"] = $row["lemail"];
                    $_SESSION["lastname"] = $row["llastname"];
                    $_SESSION["lname"] = $row["lname"];
                    $_SESSION["lid"] = $row["lid"];
                    $_SESSION["role"] = $role;
                    $_SESSION["verified"] =$row["verified"];
                    $_SESSION["lphone"] = $row["lphone"];
                    $_SESSION["laddress"] = $row["laddress"];
                    

                    header("location:landlord.view.php");

                } elseif ($role == "tenant") {
                    $_SESSION["temail"] = $row["temail"];
                    $_SESSION["tname"] = $row["tname"];
                    $_SESSION["lastname"] = $row["tlastname"];
                    $_SESSION["tid"] = $row["tid"];
                    $_SESSION["role"] = $role;
                    $_SESSION["verified"] =$row["verified"];
                    $_SESSION["tphone"] = $row["tphone"];
                    $_SESSION["taddress"] = $row["taddress"];
                    $_SESSION["request"] = $row["request"];
                    header("location:tenant.view.php");
                } else {
                    echo "<script>alert('Unknown Error');</script>";
                }
            } else if ($role == "admin") {
                $_SESSION["aemail"] = $row["aemail"];
                $_SESSION["aname"] = $row["aname"];
                $_SESSION["aid"] = $row["aid"];
                $_SESSION["role"] = $role;
                if ($password = $dbPassword) {
                    header("location:admin.view.php");
                }
            } else {
                echo "<script>alert('Inorrect Password');</script>";
            }
        } else {
            echo "<script>alert('Email doesnot exist');</script>";
        }

    }

}