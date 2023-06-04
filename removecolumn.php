<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invo";

$columnName = $_GET['columnName'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alterQuery = "ALTER TABLE stocks DROP $columnName;";
if ($conn->query($alterQuery) === TRUE) {
    $response = array("status" => "success", "message" => "Column removed successfully.");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error removing column: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>