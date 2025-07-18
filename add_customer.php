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
    $f_ad = $_POST['f_ad'];
    $f_adres = $_POST['f_adres'];
    $f_yetkili = $_POST['f_yetkili'];
    $f_website = $_POST['f_website'];
    $f_eposta = $_POST['f_eposta'];
    $f_tel = $_POST['f_tel'];
    $f_fatura_adres = $_POST['f_fatura_adres'];
    $f_vergid = $_POST['f_vergid'];
    $f_vergino = $_POST['f_vergino'];
    $f_refererans = $_POST['f_refererans'];

    $sql = "INSERT INTO customers (f_ad, f_adres, f_yetkili, f_website, f_eposta, f_tel, f_fatura_adres, f_vergid, f_vergino, f_refererans) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $f_ad, $f_adres, $f_yetkili, $f_website, $f_eposta, $f_tel, $f_fatura_adres, $f_vergid, $f_vergino, $f_refererans);

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
