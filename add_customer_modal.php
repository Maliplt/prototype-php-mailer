<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Müşteri Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm">
                    <div class="mb-3">
                        <label for="addCustomerName" class="form-label">Firma Adı</label>
                        <input type="text" class="form-control" id="addCustomerName" name="f_ad">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerAddress" class="form-label">Adres</label>
                        <input type="text" class="form-control" id="addCustomerAddress" name="f_adres">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerContact" class="form-label">Yetkili</label>
                        <input type="text" class="form-control" id="addCustomerContact" name="f_yetkili">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerWebsite" class="form-label">Website</label>
                        <input type="text" class="form-control" id="addCustomerWebsite" name="f_website">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerEmail" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="addCustomerEmail" name="f_eposta">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerTel" class="form-label">Telefon</label>
                        <input type="text" class="form-control" id="addCustomerTel" name="f_tel">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerFaturaAdres" class="form-label">Fatura Adresi</label>
                        <input type="text" class="form-control" id="addCustomerFaturaAdres" name="f_fatura_adres">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerVergid" class="form-label">Vergi Dairesi</label>
                        <input type="text" class="form-control" id="addCustomerVergid" name="f_vergid">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerVergino" class="form-label">Vergi No</label>
                        <input type="text" class="form-control" id="addCustomerVergino" name="f_vergino">
                    </div>
                    <div class="mb-3">
                        <label for="addCustomerRefererans" class="form-label">Referans</label>
                        <input type="text" class="form-control" id="addCustomerRefererans" name="f_refererans">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary" onclick="addCustomer()">Kaydet</button>
            </div>
        </div>
    </div>
</div>
