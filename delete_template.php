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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $templateID = $data['MailTemplateID'];

    $sql = "DELETE FROM mails WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $templateID);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Invalid request method.";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
