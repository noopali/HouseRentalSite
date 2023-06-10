<?php
    
    session_start();
    require "crud.php";
    if($_GET["action"]="delete"){
        
       deleteButton();
       header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
     function deleteButton(){
        $crud = new Crud();
        $table = $_GET["table"];
        $key =  $_GET["key"];
        $value = $_GET["value"];
        return $crud->delete($table,$key,$value);
      
          
    }

    
