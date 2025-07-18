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

include 'header.php';
include 'navbar.php';
?>

<div class="container mt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="customers-tab" data-bs-toggle="tab" href="#Customers" role="tab" aria-controls="Customers" aria-selected="true">Müşteriler</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="documents-tab" data-bs-toggle="tab" href="#Documents" role="tab" aria-controls="Documents" aria-selected="false">Sertifikalar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#History" role="tab" aria-controls="History" aria-selected="false">Kayıtlar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="templates-tab" data-bs-toggle="tab" href="#MailTemplates" role="tab" aria-controls="MailTemplates" aria-selected="false">Mail Şablonları</a>
        </li>


    </ul>
    <div class="tab-content border p-4 rounded-3 shadow-sm" id="myTabContent">
        <?php include 'customers.php'; ?>
        <?php include 'templates.php'; ?>
        <?php include 'documents.php'; ?>
        <?php include 'history.php'; ?>


    </div>
</div>

<div class="container mt-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
        <i class="fas fa-file-upload"></i> Excel Yükle
    </button>
</div>

<?php
include 'review_modal.php';
include 'spinner_modal.php';
include 'edit_customer_modal.php';
include 'edit_template_modal.php';
include 'add_customer_modal.php';
include 'add_template_modal.php';
include 'upload_excel_modal.php';
include 'modals.php'; 
include 'review_customer_modal.php'; 
?>

<script src="script.js"></script>
</body>
</html>
