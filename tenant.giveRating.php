<?php 

session_start();
$_SESSION['tid'] = $_POST["tid"];
$_SESSION['lid'] = $_POST["lid"];

?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="border" >
        <legend><h3>Rate the Landlord:</h3> </legend>
<div class="rating">
<form action = "rating.operations.php" method = "post">
  <div class="stars">
        <input type="radio" name="rate" id="five" value = "5">
        <label for="five"></label>
        <input type="radio" name="rate" id="four" value = "4">
        <label for="four"></label>
        <input type="radio" name="rate" id="three" value = "3">
        <label for="three"></label>
        <input type="radio" name="rate" id="two" value = "2">
        <label for="two"></label>
        <input type="radio" name="rate" id="one" value = "1">
        <label for="one"></label>
</div>

<div class="comment-section">
  <h3>Leave a review:</h3>
  
    <div>
      <label for="comment">Comment:</label>
      <textarea id="comment" name="comment" placeholder="Write your comment here" cols="20" rows="5"></textarea>
    </div>
    <div>
      <input type="submit" value="Submit" name ="action" value = "submitRating">
    </div>
  </form>
 
  
 
</div>
</div>
</body>
<style>
    body{
        background-image: url("login.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    }
    .border{
        width: 500px;
        height: 320px;
        border: 3px solid black;
        padding:6px;
        background-color: #9370db;

    }
    
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.box {
  border: 1px solid #ddd;
  padding: 20px;
  max-width: 400px;
  width: 100%;
}
.stars{

           text-align: center;
           margin-right: 200px;

       }

.stars input{
            display: none;
        }
       
        .stars label{
            float: right;
            font-size: 30px;
            
        }
        .stars label:before{
            content: '★';
        }
        .stars input:checked ~label{
            color: gold;
        }   
.rating {
  margin-bottom: 20px;
}

.rating h3,
.comment-section h3 {
  font-size: 18px;
  margin-bottom: 10px;
}



.comment-section form div {
  margin-bottom: 10px;
}

.comment-section label {
  display: inline-block;
  width: 80px;
}

.comment-section input[type="text"],
.comment-section textarea {
  width: 90%;
  padding: 5px;
}
.comment-section input[type="submit"] {
  padding: 10px 20px;
  background-color: #ffcc00;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin: 30 200px;
  bottom: 2px;
}

.comment-section input[type="submit"]:hover {
  background-color: #ffa500;
}

.comment-section input[type="submit"]:focus {
  outline: none;
}

</style>
</html>