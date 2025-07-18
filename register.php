<?php
session_start(); //todo güvenlik amacı ile uygulama içerisinde kullanılmayacak ayrı tutulacak
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

// Hata
error_reporting(E_ALL);
ini_set('display_errors', 1);

// conn
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Kullanıcı kayıt işlemi
if (isset($_POST['register'])) {
    // POST verileri
    $uname = $conn->real_escape_string($_POST['uname']);
    $psw = $conn->real_escape_string($_POST['psw']);

    // Şifreyi hashle
    $hashed_password = password_hash($psw, PASSWORD_DEFAULT);

    // SQL sorgusu
    $sql = "INSERT INTO users (username, PasswordHash) VALUES ('$uname', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>Kayıt başarılı!</div>";
    } else {
        echo "<div class='error'>Hata: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <!-- default style eklenecek tema aynı kalacak -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .register-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .register-container input[type="text"],
        .register-container input[type="password"],
        .register-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .register-container button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .register-container button:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Kayıt Ol</h2>
    <form action="register.php" method="post">
        <input type="text" name="uname" placeholder="Kullanıcı Adı" required>
        <input type="password" name="psw" placeholder="Parola" required>
        <button type="submit" name="register">Kullanıcı ekle</button>
    </form>
</div>

</body>
</html>
