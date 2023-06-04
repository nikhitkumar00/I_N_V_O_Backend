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

$sql = "SELECT (SELECT SUM(cost_price * quantity) FROM stocks) - (SELECT SUM(total_amount) FROM bills) AS profit;";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error executing command: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    $count = $row['profit'];
    echo $count;
}

$conn->close();
?>