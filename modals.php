<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>

<!-- belge ekleme -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Belge Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDocumentForm">
                    <div class="mb-3">
                        <label for="c_id" class="form-label">Firma</label>
                        <select class="form-select" id="c_id" name="c_id" required>
                            <option selected disabled>Firma Seçin</option>
                            <?php
                            $sql = "SELECT id, f_ad FROM customers";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='". $row['id'] ."'>". $row['f_ad'] ."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="c_no" class="form-label">Belge No</label>
                        <input type="number" class="form-control" id="c_no" name="c_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_tip" class="form-label">Tip</label>
                        <input type="text" class="form-control" id="c_tip" name="c_tip" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_kapsam" class="form-label">Kapsam</label>
                        <input type="text" class="form-control" id="c_kapsam" name="c_kapsam" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_yayin_tarih" class="form-label">Yayın Tarihi</label>
                        <input type="date" class="form-control" id="c_yayin_tarih" name="c_yayin_tarih" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_gozetim_tarih" class="form-label">Gözetim Tarihi</label>
                        <input type="date" class="form-control" id="c_gozetim_tarih" name="c_gozetim_tarih" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_bitis_tarih" class="form-label">Bitiş Tarihi</label>
                        <input type="date" class="form-control" id="c_bitis_tarih" name="c_bitis_tarih" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_adres" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="c_adres" name="c_adres" required>
                    </div>
                    <div class="mb-3">
                        <label for="c_status" class="form-label">Durum</label>
                        <select class="form-select" id="c_status" name="c_status" required>
                            <option value="0">Beklemede</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tamamlandı</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- belge düzenleme -->
<div class="modal fade" id="editDocumentModal" tabindex="-1" aria-labelledby="editDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDocumentModalLabel">Belgeyi Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDocumentForm">
                    <input type="hidden" id="edit_doc_id" name="id">
                    <div class="mb-3">
                        <label for="edit_c_id" class="form-label">Firma</label>
                        <select class="form-select" id="edit_c_id" name="c_id" required>
                            <option selected disabled>Firma Seçin</option>
                            <?php
                            $sql = "SELECT id, f_ad FROM customers";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='". $row['id'] ."'>". $row['f_ad'] ."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_no" class="form-label">Belge No</label>
                        <input type="number" class="form-control" id="edit_c_no" name="c_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_tip" class="form-label">Tip</label>
                        <input type="text" class="form-control" id="edit_c_tip" name="c_tip" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_kapsam" class="form-label">Kapsam</label>
                        <input type="text" class="form-control" id="edit_c_kapsam" name="c_kapsam" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_yayin_tarih" class="form-label">Yayın Tarihi</label>
                        <input type="date" class="form-control" id="edit_c_yayin_tarih" name="c_yayin_tarih" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_gozetim_tarih" class="form-label">Gözetim Tarihi</label>
                        <input type="date" class="form-control" id="edit_c_gozetim_tarih" name="c_gozetim_tarih" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_bitis_tarih" class="form-label">Bitiş Tarihi</label>
                        <input type="date" class="form-control" id="edit_c_bitis_tarih" name="c_bitis_tarih" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_adres" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="edit_c_adres" name="c_adres" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_c_status" class="form-label">Durum</label>
                        <select class="form-select" id="edit_c_status" name="c_status" required>
                            <option value="0">Beklemede</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tamamlandı</option>
                            <option value="3">İptal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>
