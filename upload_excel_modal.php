<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadExcelModalLabel">Excel Dosyasını Yükle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadExcelForm">
                    <div class="mb-3">
                        <label for="excelFile" class="form-label">Excel Dosyası Seçin</label>
                        <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx,.xls" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="uploadExcel()">Yükle</button>
                </form>
                <div id="uploadStatus" style="display:none;" class="mt-3">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                    </div>
                    <div class="mt-2 text-center">
                        <span id="uploadMessage"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
