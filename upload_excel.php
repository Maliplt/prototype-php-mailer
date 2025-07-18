<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

require __DIR__ . '/vendor/autoload.php'; // PHP autoload path to include the PhpSpreadsheet library
use PhpOffice\PhpSpreadsheet\IOFactory;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excelFile'])) {
    $file = $_FILES['excelFile']['tmp_name'];
    $spreadsheet = IOFactory::load($file);

    foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
        $sheetName = $worksheet->getTitle();
        $data = $worksheet->toArray();
        $rowCount = count($data);

        for ($row = 1; $row < $rowCount; $row++) {
            $projectNumber = $data[$row][1] ?? '';
            $customerName = $data[$row][2] ?? '';
            $status = $data[$row][3] ?? '';
            $documentNumber = $data[$row][4] ?? '';
            $documentDateCell = $data[$row][5] ?? null;
            $expiryDateCell = $data[$row][6] ?? null;

            if ($documentDateCell && is_numeric($documentDateCell)) {
                $documentDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($documentDateCell)->format('Y-m-d');
            } else {
                $documentDate = null;
            }

            if ($expiryDateCell && is_numeric($expiryDateCell)) {
                $expiryDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($expiryDateCell)->format('Y-m-d');
            } else {
                $expiryDate = null;
            }

            $standard = $data[$row][7] ?? '';
            $level = $data[$row][8] ?? '';
            $scope = $data[$row][9] ?? '';
            $timeToNextAudit = $data[$row][10] ?? '';
            $timeToCertificationExpiry = $data[$row][11] ?? '';
            $interimAudit = $data[$row][12] ?? '';
            $interimAuditStatus = $data[$row][13] ?? '';
            $partner = $data[$row][14] ?? '';

            if (empty($projectNumber) || empty($customerName) || empty($status) || empty($documentNumber) || empty($documentDate) || empty($expiryDate)) {
                continue;
            }

            // Standart ekleme
            $stmt = $conn->prepare("INSERT IGNORE INTO standards (Standard) VALUES (?)");
            $stmt->bind_param("s", $standard);
            $stmt->execute();
            $stmt->close();

            $standardID = $conn->insert_id;

            // Müşteri ekleme
            $stmt = $conn->prepare("INSERT INTO customers (CustomerName, Email, ContactNumber, Address) VALUES (?, '', '', '') ON DUPLICATE KEY UPDATE CustomerID=LAST_INSERT_ID(CustomerID)");
            $stmt->bind_param("s", $customerName);
            $stmt->execute();
            $customerID = $stmt->insert_id;
            $stmt->close();

            // Ara denetim durumu ekleme
            $stmt = $conn->prepare("INSERT IGNORE INTO audit_status (InterimAudit, InterimAuditStatus) VALUES (?, ?)");
            $stmt->bind_param("ss", $interimAudit, $interimAuditStatus);
            $stmt->execute();
            $auditStatusID = $conn->insert_id;
            $stmt->close();

            // Proje ekleme
            $stmt = $conn->prepare("INSERT INTO projects (ProjectNumber, CustomerID, Status, DocumentNumber, DocumentDate, ExpiryDate, StandardID, Level, Scope, TimeToNextAudit, TimeToCertificationExpiry, AuditStatusID, Partner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sissssiisiiis", $projectNumber, $customerID, $status, $documentNumber, $documentDate, $expiryDate, $standardID, $level, $scope, $timeToNextAudit, $timeToCertificationExpiry, $auditStatusID, $partner);
            $stmt->execute();
            $stmt->close();
        }
    }
    $response['success'] = true;
}

$conn->close();
echo json_encode($response);
?>
