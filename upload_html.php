<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['htmlFile'])) {
    $file = $_FILES['htmlFile']['tmp_name'];
    $htmlContent = file_get_contents($file);

    if ($htmlContent !== false) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "demo";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        $templateName = basename($_FILES['htmlFile']['name'], ".html");


        $stmt = $conn->prepare("INSERT INTO mails (m_konu, m_icerik) VALUES (?, ?)");
        $stmt->bind_param("sss",$subject, $htmlContent);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $response['error'] = "Dosya içeriği okunamadı.";
    }
} else {
    $response['error'] = "Geçersiz dosya yükleme isteği.";
}

echo json_encode($response);
?>
