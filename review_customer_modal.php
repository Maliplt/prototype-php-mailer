<div class="modal fade" id="editReviewCustomerModal" tabindex="-1" aria-labelledby="editReviewCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReviewCustomerModalLabel">Müşteri Önizle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCustomerForm">
                    <input type="hidden" id="editCustomerId" name="id">
                    <div class="mb-3">
                        <label for="editCustomerName" class="form-label">Firma Adı</label>
                        <input type="text" class="form-control" id="editrCustomerName" name="f_ad" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerAddress" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="editrCustomerAddress" name="f_adres" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerContact" class="form-label">Yetkili Kişi</label>
                        <input type="text" class="form-control" id="editrCustomerContact" name="f_yetkili" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerWebsite" class="form-label">Website</label>
                        <input type="text" class="form-control" id="editrCustomerWebsite" name="f_website" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerEmail" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="editrCustomerEmail" name="f_eposta" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerTel" class="form-label">Telefon</label>
                        <input type="text" class="form-control" id="editrCustomerTel" name="f_tel" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerFaturaAdres" class="form-label">Fatura Adresi</label>
                        <input type="text" class="form-control" id="editrCustomerFaturaAdres" name="f_fatura_adres" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerVergid" class="form-label">Vergi Dairesi</label>
                        <input type="text" class="form-control" id="editrCustomerVergid" name="f_vergid" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerVergino" class="form-label">Vergi No</label>
                        <input type="text" class="form-control" id="editrCustomerVergino" name="f_vergino" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerRefererans" class="form-label">Referans</label>
                        <input type="text" class="form-control" id="editrCustomerRefererans" name="f_refererans" disabled>
                    </div>
                </form>
                <!-- New container for certificates -->
                <div id="certificatesContainer" class="mt-4">
                    <h5>Sertifikalar</h5>
                    <div id="certificatesList"></div>
                </div>
                <!-- New container for mails -->
                <div id="mailsContainer" class="mt-4">
                    <h5>Mailler</h5>
                    <div id="mailsList"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.certificate-item, .mail-item {
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}
</style>
