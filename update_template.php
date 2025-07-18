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
    $templateID = $_POST['templateID'];
    $templateName = $_POST['templateName'];
    $subject = $_POST['templateSubject'];
    $body = $_POST['templateBody'];
    $source = $_POST['templateSource'];

    $sql = "UPDATE mails SET m_konu = ?, m_icerik = ?, m_kaynak = ?, m_sablon_ismi = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $subject, $body, $source, $templateName, $templateID);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = "Geçersiz istek.";
}

$conn->close();

echo json_encode($response);
?>
