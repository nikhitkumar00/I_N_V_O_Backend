<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invo";

$productName = $_GET['productName'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Query = "SELECT * FROM stocks WHERE name = '$productName';";

$result = $conn->query($Query);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $data = array(
            'item_id' => $row['item_id'],
            'quantity' => $row['quantity'],
            'cost_price' => $row['cost_price'],
            'expiry_date' => $row['expiry_date'],
            'mrp' => $row['mrp']
        );

        $response = array("status" => "success", "data" => $data);
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "No data found");
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "Query failed: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
