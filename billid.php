<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "invo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT MAX(bill_id) AS newbillid FROM bill_items";
$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(array(
        "status" => "error",
        "message" => "Error finding bill_id: " . $conn->error
    ));
} else {
    $row = $result->fetch_assoc();
    $billid = $row['newbillid'];
    echo json_encode(array(
        "status" => "success",
        "billId" => $billid + 1
    ));
}

$conn->close();
?>
