<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST['sbmt'])) {
    $uname = $conn->real_escape_string($_POST['uname']);
    $psw = $conn->real_escape_string($_POST['psw']);

    $sql = "SELECT * FROM users WHERE username='$uname'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($psw, $row['PasswordHash'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $uname;
                header("Location: logged.php");
                exit();
            } else {
                echo "Geçersiz kullanıcı adı veya parola";
            }
        } else {
            echo "Geçersiz kullanıcı adı veya parola";
        }
    } else {
        echo "Sorgu hatası: " . $conn->error;
    }
} else {
    echo "İzinsiz giriş";
}

$conn->close();
?>
