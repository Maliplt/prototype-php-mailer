<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Gönderim Öncesi Onay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Seçilen Müşteriler</h6>
                <ul id="selectedCustomers"></ul>
                <h6>Seçilen Mail Şablonları</h6>
                <ul id="selectedTemplates"></ul>
            </div>
            <div class="modal-footer">
                <form id="sendEmailsForm" method="post">
                    <input type="hidden" name="send" value="1">
                    <input type="hidden" name="customers" id="hiddenCustomers">
                    <input type="hidden" name="templates" id="hiddenTemplates">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-primary" id="sendEmailsButton">Gönder</button>
                </form>
            </div>
        </div>
    </div>
</div>
