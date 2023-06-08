<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->e) {
    die("Connection failed: " . $conn->e);
}

$sql = "SELECT * FROM bills ORDER BY bill_id DESC";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header("Content-Type: application/json");

echo json_encode($data);
?>
