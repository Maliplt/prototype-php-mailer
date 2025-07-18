<div class="tab-pane fade" id="Documents" role="tabpanel" aria-labelledby="documents-tab">
    <h3>Belgeler</h3>
    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
        Belge Ekle
    </button>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Firma ID</th>
                    <th>Belge No</th>
                    <th>Tip</th>
                    <th>Kapsam</th>
                    <th>Yayın Tarihi</th>
                    <th>Gözetim Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Adres</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM certificates";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row["id"]. "</td>";
                    echo "<td>". $row["c_id"]. "</td>";
                    echo "<td>". $row["c_no"]. "</td>";
                    echo "<td>". $row["c_tip"]. "</td>";
                    echo "<td>". $row["c_kapsam"]. "</td>";
                    echo "<td>". $row["c_yayin_tarihi"]. "</td>";
                    echo "<td>". $row["c_gozetim_tarihi"]. "</td>";
                    echo "<td>". $row["c_bitis_tarihi"]. "</td>";
                    echo "<td>". $row["c_adres"]. "</td>";
                    echo "<td>". $row["c_durum"]. "</td>";
                    echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary' onclick='openEditDocumentModal(this)'><i class='fas fa-pen'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-danger' onclick='deleteDocument(this)'><i class='fas fa-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>Veri bulunamadı</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
