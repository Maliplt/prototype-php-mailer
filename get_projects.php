<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$response = array();

if (isset($_GET['customer_id'])) {
    $customerID = $_GET['customer_id'];
    $sql = "SELECT * FROM projects WHERE CustomerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $projects = array();

    while ($row = $result->fetch_assoc()) {
        $projects[] = $row['ProjectNumber'];
    }

    $response['success'] = true;
    $response['projects'] = implode("\n", $projects);
    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Geçersiz müşteri ID";
}

$conn->close();

echo json_encode($response);
?>
