<?php
$server="localhost";
$user="root";
$pass="";
$database="busbooking";

$conn = mysqli_connect($server,$user,$pass,$database);

if($conn)
{
    ?>
    
    <script>
        alert('connection sucessful');

    </script>

    <?php
}
    else{
        ?>

        <script>
        alert("unsucessful Connection");
        </script>
<?php
    }

?>

    