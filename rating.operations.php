<?php
var_dump($_POST);
require "crud.php";
session_start();
$crud = new Crud();
if($_SERVER['REQUEST_METHOD'] == "POST"){
  
            $tid = $_SESSION["tid"];
            $lid = $_SESSION["lid"];
            $feedback = $_POST["comment"];
            $table = "rating";
            $stars = $_POST["rate"];
            $item_arr = [
                "lid" => $lid,
                "tid" => $tid,
                "feedback"=>$feedback,
                "stars" => $stars
            ];
echo $lid;
         $crud->insert($table,$item_arr);
            header("location:tenant.mybookings.php");
        }

?>
