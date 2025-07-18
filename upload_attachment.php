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
    $templateId = $_POST['attachTemplateId'];
    $attachmentPath = null;

    if (isset($_FILES['attachmentFile']) && $_FILES['attachmentFile']['error'] === UPLOAD_ERR_OK) {
        $attachmentTmpPath = $_FILES['attachmentFile']['tmp_name'];
        $attachmentName = basename($_FILES['attachmentFile']['name']);
        $attachmentDir = 'uploads/';
        $attachmentPath = $attachmentDir . $attachmentName;

        if (!move_uploaded_file($attachmentTmpPath, $attachmentPath)) {
            $response['success'] = false;
            $response['error'] = "Dosya yükleme hatası.";
            echo json_encode($response);
            exit();
        }

        // Ek dosyayı veritabanına kaydetme
        $sql = "UPDATE mails SET m_kaynak = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $attachmentPath, $templateId);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $conn->error;
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = "Dosya yükleme hatası.";
    }
} else {
    $response['success'] = false;
    $response['error'] = "Invalid request method.";
}

$conn->close();

echo json_encode($response);
?>
