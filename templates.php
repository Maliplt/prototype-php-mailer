<?php
$sql = "SELECT * FROM mails;";
$result = $conn->query($sql);
?>

<div class="tab-pane fade" id="MailTemplates" role="tabpanel" aria-labelledby="templates-tab">
    <h3>Mail Şablonları</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Şablon İsmi</th>
                    <th>Konu</th>
                    <th>İçerik</th>
                    <th>Kaynak</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr onclick='toggleRadio(this)'>";
                    echo "<td><div class='form-check'>
                              <input class='form-check-input' type='radio' name='templates' id='templateRadio". $row["id"]. "' value='". $row["id"]. "'>
                              <label class='form-check-label' for='templateRadio". $row["id"]. "'></label>
                          </div></td>";
                    echo "<td>". $row["id"]. "</td>";
                    echo "<td>". $row["m_sablon_ismi"]. "</td>";
                    echo "<td>". $row["m_konu"]. "</td>";
                    echo "<td>". $row["m_icerik"]. "</td>";
                    echo "<td>". $row["m_kaynak"]. "</td>";
                    echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary' onclick='openEditModalFromRow(event, this, \"template\")'><i class='fas fa-pen'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-danger' onclick='deleteTemplate(this)'><i class='fas fa-trash'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-info' onclick='openAttachModal(". $row["id"]. ")'><i class='fas fa-paperclip'></i></button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Veri bulunamadı</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <button type='button' class='btn btn-sm btn-outline-success' onclick='openAddTemplateModal()'><i class='fas fa-plus'></i></button>
    <button type='button' class='btn btn-sm btn-outline-primary' onclick='openImportHtmlModal()'><i class='fas fa-file-import'></i></button>
    <button type="button" class="btn btn-primary" id="proceedToReview">İlerle</button>
</div>

<!-- HTML İçe Aktarma Modal -->
<div class="modal fade" id="importHtmlModal" tabindex="-1" aria-labelledby="importHtmlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importHtmlModalLabel">HTML Dosyasını İçe Aktar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="importHtmlForm">
                    <div class="mb-3">
                        <label for="htmlFile" class="form-label">HTML Dosyası Seçin</label>
                        <input type="file" class="form-control" id="htmlFile" name="htmlFile" accept=".html">
                    </div>
                </form>
                <div id="importStatus" style="display: none;">
                    <p id="importMessage"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary" onclick="uploadHtml()">Yükle</button>
            </div>
        </div>
    </div>
</div>

<!-- Attachment Modal -->
<div class="modal fade" id="attachModal" tabindex="-1" aria-labelledby="attachModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attachModalLabel">Ek Dosya Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="attachForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="attachTemplateId" name="attachTemplateId">
                    <div class="mb-3">
                        <label for="attachmentFile" class="form-label">Ek Dosya Seçin</label>
                        <input type="file" class="form-control" id="attachmentFile" name="attachmentFile" accept=".doc,.docx,.xls,.xlsx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="uploadAttachment()">Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>
