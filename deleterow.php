<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invo";

$rowId = $_GET['rowId'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alterQuery = "DELETE FROM stocks WHERE item_id = $rowId";
if ($conn->query($alterQuery) === TRUE) {
    $response = array("status" => "success", "message" => "Row removed successfully.");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error removing row: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>