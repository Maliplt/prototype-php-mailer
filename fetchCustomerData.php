<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$customerId = $_GET['customer_id'];

$response = [];

// Müşteri bilgilerini al
$sqlCustomer = "SELECT * FROM customers WHERE id = ?";
$stmtCustomer = $conn->prepare($sqlCustomer);
$stmtCustomer->bind_param("i", $customerId);
$stmtCustomer->execute();
$resultCustomer = $stmtCustomer->get_result();
if ($resultCustomer->num_rows > 0) {
    $response['customer'] = $resultCustomer->fetch_assoc();
} else {
    $response['customer'] = null;
}
$stmtCustomer->close();

// Müşteriye bağlı dökümanları al
$sqlDocuments = "SELECT * FROM certificates WHERE c_id = ?";
$stmtDocuments = $conn->prepare($sqlDocuments);
$stmtDocuments->bind_param("i", $customerId);
$stmtDocuments->execute();
$resultDocuments = $stmtDocuments->get_result();
$documents = [];
while ($row = $resultDocuments->fetch_assoc()) {
    $documents[] = $row;
}
$response['documents'] = $documents;
$stmtDocuments->close();

// Müşteriye gönderilmiş mailleri al
$sqlMails = "SELECT * FROM mails WHERE customer_id = ?";
$stmtMails = $conn->prepare($sqlMails);
$stmtMails->bind_param("i", $customerId);
$stmtMails->execute();
$resultMails = $stmtMails->get_result();
$mails = [];
while ($row = $resultMails->fetch_assoc()) {
    $mails[] = $row;
}
$response['mails'] = $mails;
$stmtMails->close();

$conn->close();

echo json_encode($response);
?>