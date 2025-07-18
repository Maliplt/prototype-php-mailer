<div class="modal fade" id="editTemplateModal" tabindex="-1" aria-labelledby="editTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTemplateModalLabel">Şablonu Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTemplateForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editTemplateId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="editTemplateId" name="editTemplateId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editTemplateName" class="form-label">Şablon İsmi</label>
                        <input type="text" class="form-control" id="editTemplateName" name="editTemplateName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTemplateSubject" class="form-label">Konu</label>
                        <input type="text" class="form-control" id="editTemplateSubject" name="editTemplateSubject" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTemplateBody" class="form-label">İçerik</label>
                        <textarea class="form-control" id="editTemplateBody" name="editTemplateBody" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
