<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js" defer></script>
    <script src="script.js" defer></script>
    <title>Hoş Geldin</title>
</head>
<body>
    <div class="container mt-5">
        <div class="content p-4 border rounded bg-white shadow">
            <h1>Hoş Geldin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Bu sayfayı yalnızca oturum açmış kullanıcılar görebilir.</p>

            <form action="mail.php" method="post" class="d-inline">
                <button type="submit" class="btn btn-primary">İlerle</button>
            </form>

            <form action="logout.php" method="post" class="d-inline">
                <button type="submit" class="btn btn-danger">Çıkış Yap</button>
            </form>
        </div>
    </div>
</body>
</html>
