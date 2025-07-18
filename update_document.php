<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$id = $_POST['id'];
$c_id = $_POST['c_id'];
$c_no = $_POST['c_no'];
$c_tip = $_POST['c_tip'];
$c_kapsam = $_POST['c_kapsam'];
$c_yayin_tarih = $_POST['c_yayin_tarih'];
$c_gozetim_tarih = $_POST['c_gozetim_tarih'];
$c_bitis_tarih = $_POST['c_bitis_tarih'];
$c_adres = $_POST['c_adres'];
$c_status = $_POST['c_status'];

$sql = "UPDATE certificates SET c_id='$c_id', c_no='$c_no', c_tip='$c_tip', c_kapsam='$c_kapsam', c_yayin_tarih='$c_yayin_tarih', c_gozetim_tarih='$c_gozetim_tarih', c_bitis_tarih='$c_bitis_tarih', c_adres='$c_adres', c_status='$c_status' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
