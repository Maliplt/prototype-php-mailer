<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Müşteri Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCustomerForm">
                    <input type="hidden" id="editCustomerId" name="id">
                    <div class="mb-3">
                        <label for="editCustomerName" class="form-label">Firma Adı</label>
                        <input type="text" class="form-control" id="editCustomerName" name="f_ad" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerAddress" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="editCustomerAddress" name="f_adres" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerContact" class="form-label">Yetkili</label>
                        <input type="text" class="form-control" id="editCustomerContact" name="f_yetkili" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerWebsite" class="form-label">Website</label>
                        <input type="text" class="form-control" id="editCustomerWebsite" name="f_website">
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerEmail" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="editCustomerEmail" name="f_eposta" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerTel" class="form-label">Telefon</label>
                        <input type="text" class="form-control" id="editCustomerTel" name="f_tel">
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerFaturaAdres" class="form-label">Fatura Adresi</label>
                        <input type="text" class="form-control" id="editCustomerFaturaAdres" name="f_fatura_adres" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerVergid" class="form-label">Vergi Dairesi</label>
                        <input type="text" class="form-control" id="editCustomerVergid" name="f_vergid">
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerVergino" class="form-label">Vergi No</label>
                        <input type="text" class="form-control" id="editCustomerVergino" name="f_vergino">
                    </div>
                    <div class="mb-3">
                        <label for="editCustomerRefererans" class="form-label">Referans</label>
                        <input type="text" class="form-control" id="editCustomerRefererans" name="f_refererans" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>
