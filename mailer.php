<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['send']) || empty($_POST['customers']) || empty($_POST['templates'])) {
    echo "Lütfen en az bir müşteri ve en az bir şablon seçin.";
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';
require 'template.php'; // Template fonksiyonları

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$templateID = $_POST['templates'];
$sql = "SELECT * FROM mails WHERE id = $templateID";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $template = $result->fetch_assoc();
} else {
    echo "Seçilen şablon bulunamadı.";
    exit();
}

$successful = true;
$customerIDs = explode(',', $_POST['customers']);
$sentMails = [];

foreach ($customerIDs as $customerID) {
    $sql = "SELECT * FROM customers WHERE id='$customerID'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
        $customerData = $result->fetch_assoc();
        $to = $customerData['f_eposta'];

        $mailContent = replaceTemplateKeys($template['m_icerik'], $customerData); //müşteri verileri

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'demo'; //e-posta 
            $mail->Password = 'demo'; //parola
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('demo', 'demo');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $template['m_konu'];
            $mail->Body    = $mailContent; // doldurulmuş içerik
            $mail->AltBody = strip_tags($mailContent);

            // Attachment ekleme
            if (!empty($template['m_kaynak'])) {
                $mail->addAttachment($template['m_kaynak']);
            }

            $mail->send();
            $sentMails[] = [
                'customer_id' => $customerID,
                'template_id' => $templateID,
                'm_sablon_ismi' => $template['m_sablon_ismi'],
                'm_konu' => $template['m_konu'],
                'm_icerik' => $mailContent,
                'm_kaynak' => $template['m_kaynak'],
                'gonderim_tarihi' => date('Y-m-d H:i:s')
            ];
            echo 'E-posta başarıyla gönderildi: ' . $to . '<br>';
        } catch (Exception $e) {
            $successful = false;
            echo "E-posta gönderimi başarısız: {$mail->ErrorInfo}<br>";
        }
    } else {
        $successful = false;
        echo "Müşteri bulunamadı: $customerID<br>";
    }
}

//mailleri veritabanına kaydetme
if (!empty($sentMails)) {
    $stmt = $conn->prepare("INSERT INTO mails (customer_id, template_id, m_sablon_ismi, m_konu, m_icerik, m_kaynak, gonderim_tarihi) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($sentMails as $sentMail) {
        $stmt->bind_param(
            "iisssss",
            $sentMail['customer_id'],
            $sentMail['template_id'],
            $sentMail['m_sablon_ismi'],
            $sentMail['m_konu'],
            $sentMail['m_icerik'],
            $sentMail['m_kaynak'],
            $sentMail['gonderim_tarihi']
        );
        $stmt->execute();
    }
    $stmt->close();
}

if ($successful) {
    echo "Tüm e-postalar başarıyla gönderildi.";
} else {
    echo "Bazı e-postalar gönderilemedi.";
}

$conn->close();
?>
