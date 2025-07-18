<div class="tab-pane fade show active" id="Customers" role="tabpanel" aria-labelledby="customers-tab">
    <h3>Müşteriler</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="checkAllCustomers" onclick="checkAll(this, 'customers')">
                        </div>
                    </th>
                    <th>ID</th>
                    <th>Firma Adı</th>
                    <th>Adres</th>
                    <th>Yetkili</th>
                    <th>Website</th>
                    <th>E-posta</th>
                    <th>Telefon</th>
                    <th style="display:none;"></th>
                    <th style="display:none;"></th>
                    <th style="display:none;"></th>
                    <th style="display:none;"></th>
                    <th>İşlemler</th>
                    <button type='button' class='btn btn-sm btn-outline-success' onclick='openAddCustomerModal()'>Müşteri Ekle    <i class='fas fa-plus'></i></button>
                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filtrele   <i class='bi bi-filter'></i></button>
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" type="button">Tarihe Göre (up)</button></li>
                            <li><button class="dropdown-item" type="button">Tarihe Göre (down) </button></li>
                            <li><button class="dropdown-item" type="button">Sertifikaya Göre (up)</button></li>
                            <li><button class="dropdown-item" type="button">Sertifikaya Göre (down)</button></li>
                        </ul>
                        </div>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM customers";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><div class='form-check form-switch'>
                          <input class='form-check-input' type='checkbox' role='switch' name='customers[]' value='". $row["id"]. "'>
                        </div></td>";
                    echo "<td>". $row["id"]. "</td>";
                    echo "<td>". $row["f_ad"]. "</td>";
                    echo "<td>". $row["f_adres"]. "</td>";
                    echo "<td>". $row["f_yetkili"]. "</td>";
                    echo "<td>". $row["f_website"]. "</td>";
                    echo "<td>". $row["f_eposta"]. "</td>";
                    echo "<td>". $row["f_tel"]. "</td>";
                    echo "<td  style=\"display:none;\">".$row["f_fatura_adres"]. "</td>";
                    echo "<td  style=\"display:none;\">".$row["f_vergid"]. "</td>";
                    echo "<td  style=\"display:none;\">".$row["f_vergino"]. "</td>";
                    echo "<td  style=\"display:none;\">".$row["f_refererans"]. "</td>";
                    echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary' onclick='openEditModalFromRow(event, this, \"customer\")'><i class='fas fa-pen'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-success' onclick='openReviewCustomerModal(this)'><i class='fas fa-eye'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-danger' onclick='deleteCustomer(this)'><i class='fas fa-trash'></i></button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Veri bulunamadı</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary" id="proceedToTemplates">İlerle</button>
</div>
