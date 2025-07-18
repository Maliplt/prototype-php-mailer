<?php
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
    die("Connection failed: " . $conn->connect_error);
}

?>

<div class="tab-pane fade" id="History" role="tabpanel" aria-labelledby="history-tab">
    <h3>Kayıtlar</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Müşteri</th>
                    <th>Sertifika</th>
                    <th>Şablon</th>
                    <th>Gönderim Tarihi</th>
                    <th>Konu</th>
                    <th>İçerik</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT mails.id, customers.f_ad, certificates.c_no, mails.m_sablon_ismi, mails.gonderim_tarihi, mails.m_konu, mails.m_icerik
                    FROM mails
                    JOIN customers ON mails.customer_id = customers.id
                    JOIN certificates ON mails.template_id = certificates.id
                    ORDER BY mails.gonderim_tarihi DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row["id"]. "</td>";
                    echo "<td>". $row["f_ad"]. "</td>";
                    echo "<td>". $row["c_no"]. "</td>";
                    echo "<td>". $row["m_sablon_ismi"]. "</td>";
                    echo "<td>". $row["gonderim_tarihi"]. "</td>";
                    echo "<td>". $row["m_konu"]. "</td>";
                    echo "<td>". $row["m_icerik"]. "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Kayıt bulunamadı</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>

<script src="script.js"></script>
</body>
</html>
