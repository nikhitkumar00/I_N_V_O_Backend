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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jsonData = json_decode(file_get_contents("php://input"), true);

    $sql = "INSERT INTO stocks (";
    $sql .= implode(", ", array_keys($jsonData));
    $sql .= ") VALUES ('";
    $sql .= implode("', '", array_values($jsonData));
    $sql .= "')";

    if ($conn->query($sql) === true) {
        $response = array("message" => "Data added successfully.");
        echo json_encode($response);
    } else {
        $response = array("error" => "Error: " . $sql . "<br>" . $conn->error);
        echo json_encode($response);
    }
}

$conn->close();

?>
