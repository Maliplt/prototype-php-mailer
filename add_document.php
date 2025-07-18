<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$c_id = $_POST['c_id'];
$c_no = $_POST['c_no'];
$c_tip = $_POST['c_tip'];
$c_kapsam = $_POST['c_kapsam'];
$c_yayin_tarih = $_POST['c_yayin_tarih'];
$c_gozetim_tarih = $_POST['c_gozetim_tarih'];
$c_bitis_tarih = $_POST['c_bitis_tarih'];
$c_adres = $_POST['c_adres'];
$c_status = $_POST['c_status'];

$sql = "INSERT INTO certificates (c_id, c_no, c_tip, c_kapsam, c_yayin_tarihi, c_gozetim_tarihi, c_bitis_tarihi, c_adres, c_durum) 
        VALUES ('$c_id', '$c_no', '$c_tip', '$c_kapsam', '$c_yayin_tarih', '$c_gozetim_tarih', '$c_bitis_tarih', '$c_adres', '$c_status')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
