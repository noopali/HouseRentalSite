<?php
session_start();
require "crud.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['action']=="requestRent"){
    $crud = new Crud();
    $table = $_POST['table'];
    $tid = $_POST['tid'];
    $pid = $_POST['pid'];
    $lid = $_POST['lid'];
    $condition = "property = '{$pid}' and tenant = '{$tid}' and request = 1";
    $column = "request";
    $previousRequest = $crud->selectCondition($table, $column, $condition);
    $requestCount = mysqli_num_rows($previousRequest);
    $row = mysqli_fetch_assoc($previousRequest);
    if ($requestCount > 0) {
        // Request already sent
        $response = array( 'Request already sent');
        echo json_encode($response);
    } else {
        // Send request to tenant
        $itemsArray = [
            "tenant" => $tid,
            "property" => $pid,
            "landlord" => $lid,
            "request" => 1
        ];
        $crud->insert($table, $itemsArray);

        $response = array('message' => 'Request sent to tenant');
        echo json_encode($response);
    }
}
else if($_POST['action']=='cancel'){
    $crud = new Crud();
    $table = 'booking';
    $bid = $_POST['bid'];
    $column = 'request';
    $updatedValue = '0';
    $crud->updateOne($table,$column,$updatedValue,"bid","=",$bid);
    $response = array('message' => 'cancelled sucessfully');
    json_encode($response);

}
} else {
    $response = array( 'message' => 'Error');
}
?>
