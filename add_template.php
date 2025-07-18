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
    $templateName = $_POST['templateName'];
    $subject = $_POST['templateSubject'];
    $body = $_POST['templateBody'];
    $templateAttachment = $_FILES['templateAttachment'];
    $source = null;

    if (isset($templateAttachment) && $templateAttachment['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($templateAttachment['name']);
        if (move_uploaded_file($templateAttachment['tmp_name'], $uploadFile)) {
            $source = $uploadFile;
        } else {
            $response['success'] = false;
            $response['error'] = "Dosya yükleme başarısız.";
            echo json_encode($response);
            exit();
        }
    }

    if ($source) {
        $sql = "INSERT INTO mails (m_sablon_ismi, m_konu, m_icerik, m_kaynak) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $templateName, $subject, $body, $source);
    } else {
        $sql = "INSERT INTO mails (m_sablon_ismi, m_konu, m_icerik) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $templateName, $subject, $body);
    }

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

echo json_encode($response);
?>