<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invo";

$billId = $_GET['billId'];
$itemId = $_GET['itemId'];
$quantity = $_GET['quantity'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Query = "INSERT INTO bill_items(bill_id,item_id,bill_quantity)VALUES($billId,$itemId,$quantity);";
if ($conn->query($Query) === TRUE) {
    $response = array("status" => "success", "message" => "BillItem added successfully.");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error Adding row: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>