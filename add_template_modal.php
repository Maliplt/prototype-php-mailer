<div class="modal fade" id="addTemplateModal" tabindex="-1" aria-labelledby="addTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTemplateModalLabel">Yeni Mail Şablonu Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addTemplateForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="templateName" class="form-label">Şablon İsmi</label>
                        <input type="text" class="form-control" id="templateName" name="templateName" required>
                    </div>
                    <div class="mb-3">
                        <label for="templateSubject" class="form-label">Konu</label>
                        <input type="text" class="form-control" id="templateSubject" name="templateSubject" required>
                    </div>
                    <div class="mb-3">
                        <label for="templateBody" class="form-label">İçerik</label>
                        <textarea class="form-control" id="templateBody" name="templateBody" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="templateAttachment" class="form-label">Ek Dosya</label>
                        <input type="file" class="form-control" id="templateAttachment" name="templateAttachment" accept=".doc,.docx,.xls,.xlsx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>
