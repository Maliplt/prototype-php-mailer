document.addEventListener('DOMContentLoaded', function() {
    const darkModeEnabled = localStorage.getItem('darkModeEnabled') === 'true';
    if (darkModeEnabled) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        document.getElementById('darkModeToggle').classList.remove('btn-outline-dark');
        document.getElementById('darkModeToggle').classList.add('btn-light');
        document.getElementById('darkModeIcon').classList.remove('fa-moon');
        document.getElementById('darkModeIcon').classList.add('fa-sun');
    }

    openTab(null, 'Customers');

    document.getElementById('customers-tab').addEventListener('click', function() {
        openTab(null, 'Customers');
    });

    document.getElementById('templates-tab').addEventListener('click', function() {
        openTab(null, 'MailTemplates');
    });

    document.getElementById('documents-tab').addEventListener('click', function() {
        openTab(null, 'Documents');
    });

    //!yeni eklendi bug var
    document.getElementById('history-tab').addEventListener('click', function() {
        openTab(null, 'History');
    });

    document.getElementById('proceedToTemplates').addEventListener('click', function() {
        var selectedCustomers = document.querySelectorAll('input[name="customers[]"]:checked');
        if (selectedCustomers.length > 0) {
            document.getElementById('templates-tab').classList.remove('disabled');
            document.getElementById('templates-tab').click();
        } else {
            if (!document.querySelector('.alert-warning')) {
                var alert = document.createElement('div');
                alert.className = 'alert alert-warning';
                alert.role = 'alert';
                alert.innerText = 'Lütfen en az bir müşteri seçin.';
                document.querySelector('.container').prepend(alert);
                setTimeout(function() {
                    alert.remove();
                }, 3000);
            }
        }
    });

    document.getElementById('proceedToReview').addEventListener('click', function() {
        var selectedCustomers = Array.from(document.querySelectorAll('input[name="customers[]"]:checked')).map(c => c.closest('tr').querySelector('td:nth-child(3)').innerText);
        var selectedTemplate = document.querySelector('input[name="templates"]:checked').closest('tr').querySelector('td:nth-child(3)').innerText;

        if (selectedCustomers.length > 0 && selectedTemplate) {
            document.getElementById('hiddenCustomers').value = selectedCustomers.join(',');
            document.getElementById('hiddenTemplates').value = selectedTemplate;

            var selectedCustomersList = document.getElementById('selectedCustomers');
            selectedCustomersList.innerHTML = '';
            selectedCustomers.forEach(customer => {
                var li = document.createElement('li');
                li.textContent = customer;
                selectedCustomersList.appendChild(li);
            });

            var selectedTemplateList = document.getElementById('selectedTemplates');
            selectedTemplateList.innerHTML = '';
            var li = document.createElement('li');
            li.textContent = selectedTemplate;
            selectedTemplateList.appendChild(li);

            var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
            reviewModal.show();
        } else {
            if (!document.querySelector('.alert-warning')) {
                var alert = document.createElement('div');
                alert.className = 'alert alert-warning';
                alert.role = 'alert';
                alert.innerText = 'Lütfen müşteri ve şablon seçin.';
                document.querySelector('.container').prepend(alert);
                setTimeout(function() {
                    alert.remove();
                }, 3000);
            }
        }
    });

    var rows = document.querySelectorAll("table tr:not(:first-child)");
    rows.forEach(function(row) {
        row.addEventListener("click", function(event) {
            if (event.target.type !== "checkbox" && event.target.tagName.toLowerCase() !== 'button' && !event.target.classList.contains('btn')) {
                selectRow(row);
            }
        });
    });

    var checkboxes = document.querySelectorAll("table tr:not(:first-child) input[type='checkbox']");
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    var radios = document.querySelectorAll("input[type='radio'][name='templates']");
    radios.forEach(function(radio) {
        radio.addEventListener('click', function(event) {
            if (radio.checked) {
                radios.forEach(function(r) {
                    r.checked = false;
                });
                radio.checked = true;
            }
        });
    });

    document.querySelectorAll('.modal .btn-close, .modal .btn-secondary').forEach(function(button) {
        button.addEventListener('click', function() {
            var modal = bootstrap.Modal.getInstance(button.closest('.modal'));
            modal.hide();
        });
    });

    var sendEmailsButton = document.getElementById('sendEmailsButton');
    sendEmailsButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (!sendEmailsButton.disabled) {
            sendEmailsButton.disabled = true;
            sendEmails();
            setTimeout(function() {
                sendEmailsButton.disabled = false;
            }, 5000); 
        }
    });

    // Add Document Form Submission
    const addDocumentForm = document.getElementById('addDocumentForm');
    if (addDocumentForm) {
        addDocumentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('add_document.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Belge başarıyla eklendi.');
                    location.reload();
                } else {
                    alert('Ekleme sırasında bir hata oluştu: ' + data.error);
                }
            });
        });
    }

    // Edit Document Form Submission
    const editDocumentForm = document.getElementById('editDocumentForm');
    if (editDocumentForm) {
        editDocumentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('update_document.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Belge başarıyla güncellendi.');
                    location.reload();
                } else {
                    alert('Güncelleme sırasında bir hata oluştu: ' + data.error);
                }
            });
        });
    }

    // Add Template Form Submission
    const addTemplateForm = document.getElementById('addTemplateForm');
    if (addTemplateForm) {
        addTemplateForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('add_template.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Şablon başarıyla eklendi.');
                    location.reload();
                } else {
                    alert('Ekleme sırasında bir hata oluştu: ' + data.error);
                }
            });
        });
    }

    // Edit Template Form Submission
    const editTemplateForm = document.getElementById('editTemplateForm');
    if (editTemplateForm) {
        editTemplateForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('update_template.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Şablon başarıyla güncellendi.');
                    location.reload();
                } else {
                    alert('Güncelleme sırasında bir hata oluştu: ' + data.error);
                }
            });
        });
    }

    
    
    

    // attachForm 
    const attachForm = document.getElementById('attachForm');
    if (attachForm) {
        attachForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('upload_attachment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Dosya başarıyla eklendi.');
                    location.reload();
                } else {
                    alert('Ekleme sırasında bir hata oluştu: ' + data.error);
                }
            });
        });
    }
});

function openEditModal(type,button) {
    var row = button.closest('tr');
    var selected = document.querySelector(`input[name='${type}s[]']:checked`);
    if (!selected) {
        alert('Lütfen düzenlemek için bir kayıt seçin.');
        return;
    }

    var row = selected.closest('tr');
    openEditModalFromRow(row, type);
}

function openEditModalFromRow(event, button, type) {
    event.stopPropagation();
    var row = button.closest('tr');
    if (type === 'customer') {
        document.getElementById('editCustomerId').value =row.cells[1].innerText;
        document.getElementById('editCustomerName').value = row.cells[2].innerText;
        document.getElementById('editCustomerAddress').value = row.cells[3].innerText;
        document.getElementById('editCustomerContact').value = row.cells[4].innerText;
        document.getElementById('editCustomerWebsite').value = row.cells[5].innerText;
        document.getElementById('editCustomerEmail').value = row.cells[6].innerText;
        document.getElementById('editCustomerTel').value = row.cells[7].innerText;
        document.getElementById('editCustomerFaturaAdres').value = row.cells[8].innerText;
        document.getElementById('editCustomerVergid').value = row.cells[9].innerText;
        document.getElementById('editCustomerVergino').value = row.cells[10].innerText;
        document.getElementById('editCustomerRefererans').value = row.cells[11].innerText;

        var customerModal = new bootstrap.Modal(document.getElementById('editCustomerModal'));
        customerModal.show();
    } else if (type === 'template') {
        document.getElementById('editTemplateId').value = row.cells[1].innerText;
        document.getElementById('editTemplateName').value = row.cells[2].innerText;
        document.getElementById('editTemplateSubject').value = row.cells[3].innerText;
        document.getElementById('editTemplateBody').value = row.cells[4].innerText;
        var templateModal = new bootstrap.Modal(document.getElementById('editTemplateModal'));
        templateModal.show();
    }
}

//önizleme
function openReviewCustomerModal(button) {
    var row = button.closest('tr');
    var customerId = row.cells[1].innerText;

    fetch('fetchCustomerData.php?customer_id=' + customerId)
        .then(response => response.json())
        .then(data => {
            if (data.customer) {
                document.getElementById('editCustomerId').value = data.customer.id;
                document.getElementById('editrCustomerName').value = data.customer.f_ad;
                document.getElementById('editrCustomerAddress').value = data.customer.f_adres;
                document.getElementById('editrCustomerContact').value = data.customer.f_yetkili;
                document.getElementById('editrCustomerWebsite').value = data.customer.f_website;
                document.getElementById('editrCustomerEmail').value = data.customer.f_eposta;
                document.getElementById('editrCustomerTel').value = data.customer.f_tel;
                document.getElementById('editrCustomerFaturaAdres').value = data.customer.f_fatura_adres;
                document.getElementById('editrCustomerVergid').value = data.customer.f_vergid;
                document.getElementById('editrCustomerVergino').value = data.customer.f_vergino;
                document.getElementById('editrCustomerRefererans').value = data.customer.f_refererans;
            }

         
            var certificatesList = document.getElementById('certificatesList');
            certificatesList.innerHTML = '';
            data.documents.forEach(certificate => {
                var certElement = document.createElement('div');
                certElement.className = 'certificate-item';
                certElement.innerHTML = `
                    <p><strong>Certificate No:</strong> ${certificate.c_no}</p>
                    <p><strong>Type:</strong> ${certificate.c_tip}</p>
                    <p><strong>Scope:</strong> ${certificate.c_kapsam}</p>
                    <p><strong>Address:</strong> ${certificate.c_adres}</p>
                    <p><strong>Publication Date:</strong> ${certificate.c_yayin_tarihi}</p>
                    <p><strong>Surveillance Date:</strong> ${certificate.c_gozetim_tarihi}</p>
                    <p><strong>End Date:</strong> ${certificate.c_bitis_tarihi}</p>
                `;
                certificatesList.appendChild(certElement);
            });

            var mailsList = document.getElementById('mailsList');
            mailsList.innerHTML = '';
            data.mails.forEach(mail => {
                var mailElement = document.createElement('div');
                mailElement.className = 'mail-item';
                mailElement.innerHTML = `
                    <p><strong>Subject:</strong> ${mail.m_konu}</p>
                    <p><strong>Content:</strong> ${mail.m_icerik}</p>
                    <p><strong>Sent Date:</strong> ${mail.gonderim_tarihi}</p>
                `;
                mailsList.appendChild(mailElement);
            });
        });

    var reviewCustomerModal = new bootstrap.Modal(document.getElementById('editReviewCustomerModal'));
    reviewCustomerModal.show();
}





function openAttachModal(button) {
    var row = button.closest('tr');
    document.getElementById('attachTemplateId').value = row.cells[1].innerText;
    var attachModal = new bootstrap.Modal(document.getElementById('attachModal'));
    attachModal.show();
}

//! customer form 2 POST GİDİYOR PHP POSTUNU ÇIKART
document.getElementById('editCustomerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    fetch('update_customer.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Müşteri başarıyla güncellendi.');
            location.reload();
        } else {
            alert('Güncelleme sırasında bir hata oluştu: ' + data.error);
        }
    })
    .catch(error => {
        alert('Güncelleme sırasında bir hata oluştu: ' + error.message);
    });
});

function saveTemplateChanges() {
    var formData = new FormData(document.getElementById('editTemplateForm'));
    fetch('update_template.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Şablon başarıyla güncellendi.');
            location.reload();
        } else {
            alert('Güncelleme sırasında bir hata oluştu: ' + data.error);
        }
    });
}

function toggleDarkMode() {
    var htmlElement = document.documentElement;
    var darkModeToggle = document.getElementById('darkModeToggle');
    var darkModeIcon = document.getElementById('darkModeIcon');
    if (htmlElement.getAttribute('data-bs-theme') === 'dark') {
        htmlElement.setAttribute('data-bs-theme', 'light');
        darkModeToggle.classList.remove('btn-light');
        darkModeToggle.classList.add('btn-outline-dark');
        darkModeIcon.classList.remove('fa-sun');
        darkModeIcon.classList.add('fa-moon');
        localStorage.setItem('darkModeEnabled', 'false');
    } else {
        htmlElement.setAttribute('data-bs-theme', 'dark');
        darkModeToggle.classList.remove('btn-outline-dark');
        darkModeToggle.classList.add('btn-light');
        darkModeIcon.classList.remove('fa-moon');
        darkModeIcon.classList.add('fa-sun');
        localStorage.setItem('darkModeEnabled', 'true');
    }
}

function toggleSwitch(event, row) {
    if (event.target.tagName.toLowerCase() !== 'input') {
        var checkbox = row.querySelector('input[type="checkbox"]');
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
        }
    }
}

function toggleRadio(row) {
    var radios = document.querySelectorAll("input[type='radio'][name='templates']");
    radios.forEach(function(radio) {
        radio.checked = false;
    });
    var radio = row.querySelector('input[type="radio"]');
    if (radio) {
        radio.checked = true;
    }
}

document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('hidden.bs.modal', function () {
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.parentNode.removeChild(backdrop);
        }
    });
});

function resetSelections() {
    // Checkboxe
    var checkboxes = document.querySelectorAll('input[name="customers[]"]:checked');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });

    // Radio button
    var radios = document.querySelectorAll('input[type="radio"][name="templates"]:checked');
    radios.forEach(function(radio) {
        radio.checked = false;
    });

    // Disable Templates tab
    document.getElementById('templates-tab').classList.add('disabled');
    document.getElementById('customers-tab').click();
}

function sendEmails() {
    var selectedCustomers = Array.from(document.querySelectorAll('input[name="customers[]"]:checked')).map(c => c.closest('tr').querySelector('td:nth-child(3)').innerText);
    var selectedTemplate = document.querySelector('input[name="templates"]:checked').closest('tr').querySelector('td:nth-child(3)').innerText;

    var formData = new FormData();
    formData.append('send', '1');
    formData.append('customers', selectedCustomers.join(','));
    formData.append('templates', selectedTemplate);

    var spinnerModal = new bootstrap.Modal(document.getElementById('spinnerModal'));
    var spinnerText = document.getElementById('spinnerText');
    spinnerModal.show();
    spinnerText.textContent = 'E-postalar gönderiliyor, lütfen bekleyin...';

    fetch('mailer.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        var successMessage = document.getElementById('successMessage');
        var errorMessage = document.getElementById('errorMessage');
        if (data.includes('E-posta başarıyla gönderildi')) {
            successMessage.style.display = 'block';
            successMessage.innerHTML = data;
            errorMessage.style.display = 'none';
            spinnerText.textContent = 'Gönderme işlemi başarılı!';
            setTimeout(function() {
                successMessage.style.display = 'none';
                spinnerModal.hide();
                resetSelections();
                closeAllModals();
            }, 3000); // 3 saniye sonra gizle 
        } else {
            errorMessage.style.display = 'block';
            errorMessage.innerHTML = data;
            successMessage.style.display = 'none';
            spinnerText.textContent = 'Gönderme işlemi başarısız oldu!';
            setTimeout(function() {
                errorMessage.style.display = 'none';
                spinnerModal.hide();
                resetSelections();
            }, 3000); // 3 saniye sonra gizle 
        }
    })
    .catch(error => {
        var errorMessage = document.getElementById('errorMessage');
        errorMessage.style.display = 'block';
        errorMessage.innerHTML = 'Gönderme işlemi sırasında bir hata oluştu: ' + error.message;
        successMessage.style.display = 'none';
        spinnerText.textContent = 'Gönderme işlemi başarısız oldu!';
        setTimeout(function() {
            errorMessage.style.display = 'none';
            spinnerModal.hide();
            resetSelections();
        }, 3000); // 3 saniye sonra gizle 
    });
}

function closeAllModals() {
    document.querySelectorAll('.modal').forEach(modal => {
        var modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
}

// Ekleme işlemleri
function openAddCustomerModal() {
    document.getElementById('addCustomerForm').reset();
    var addCustomerModal = new bootstrap.Modal(document.getElementById('addCustomerModal'));
    addCustomerModal.show();
}

function openAddTemplateModal() {
    document.getElementById('addTemplateForm').reset();
    var addTemplateModal = new bootstrap.Modal(document.getElementById('addTemplateModal'));
    addTemplateModal.show();
}

function addCustomer() {
    var formData = new FormData(document.getElementById('addCustomerForm'));
    fetch('add_customer.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Müşteri başarıyla eklendi.');
            location.reload();
        } else {
            alert('Ekleme sırasında bir hata oluştu: ' + data.error);
        }
    });
}

function addTemplate() {
    var formData = new FormData(document.getElementById('addTemplateForm'));
    fetch('add_template.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Şablon başarıyla eklendi.');
            location.reload();
        } else {
            alert('Ekleme sırasında bir hata oluştu: ' + data.error);
        }
    });
}

// Silme işlemleri
function deleteCustomer(button) {
    var row = button.closest('tr');
    var customerID = row.querySelector('input[name="customers[]"]').value;
    if (!customerID) {
        alert('Lütfen silmek için bir müşteri seçin.');
        return;
    }
    fetch('delete_customer.php', {
        method: 'POST',
        body: JSON.stringify({ CustomerID: customerID }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Müşteri başarıyla silindi.');
            location.reload();
        } else {
            alert('Silme sırasında bir hata oluştu: ' + data.error);
        }
    });
}

function deleteTemplate(button) {
    var row = button.closest('tr');
    var templateID = row.querySelector('input[name="templates"]').value;

    if (!templateID) {
        alert('Lütfen silmek için bir şablon seçin.');
        return;
    }

    if (confirm('Bu şablonu silmek istediğinize emin misiniz?')) {
        fetch('delete_template.php', {
            method: 'POST',
            body: JSON.stringify({ MailTemplateID: templateID }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Şablon başarıyla silindi.');
                location.reload();
            } else {
                alert('Silme sırasında bir hata oluştu: ' + data.error);
            }
        })
        .catch(error => {
            alert('Silme sırasında bir hata oluştu: ' + error.message);
        });
    }
}

// Excel dosyası yükleme
function uploadExcel() {
    var form = document.getElementById('uploadExcelForm');
    var formData = new FormData(form);
    var uploadStatus = document.getElementById('uploadStatus');
    var uploadMessage = document.getElementById('uploadMessage');

    uploadStatus.style.display = 'block';
    uploadMessage.innerText = 'Dosya yükleniyor...';

    fetch('upload_excel.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            uploadMessage.innerText = 'Veriler başarıyla yüklendi!';
        } else {
            uploadMessage.innerText = 'Veri yükleme sırasında bir hata oluştu.';
        }
        setTimeout(function() {
            uploadStatus.style.display = 'none';
            location.reload();
        }, 3000);
    })
    .catch(error => {
        uploadMessage.innerText = 'Dosya yüklenirken bir hata oluştu: ' + error.message;
        setTimeout(function() {
            uploadStatus.style.display = 'none';
        }, 3000);
    });
}

// Müşteri projelerini yükleme


function openImportHtmlModal() {
    document.getElementById('importHtmlForm').reset();
    var importHtmlModal = new bootstrap.Modal(document.getElementById('importHtmlModal'));
    importHtmlModal.show();
}

function uploadHtml() {
    var form = document.getElementById('importHtmlForm');
    var formData = new FormData(form);
    var importStatus = document.getElementById('importStatus');
    var importMessage = document.getElementById('importMessage');

    importStatus.style.display = 'block';
    importMessage.innerText = 'Dosya yükleniyor...';

    fetch('upload_html.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            importMessage.innerText = 'HTML dosyası başarıyla yüklendi!';
        } else {
            importMessage.innerText = 'HTML dosyası yükleme sırasında bir hata oluştu.';
        }
        setTimeout(function() {
            importStatus.style.display = 'none';
            location.reload();
        }, 3000);
    })
    .catch(error => {
        importMessage.innerText = 'Dosya yüklenirken bir hata oluştu: ' + error.message;
        setTimeout(function() {
            importStatus.style.display = 'none';
        }, 3000);
    });
}

function openTab(event, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tab-pane");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("show");
        tabcontent[i].classList.remove("active");
    }

    tablinks = document.getElementsByClassName("nav-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    document.getElementById(tabName).classList.add("show");
    document.getElementById(tabName).classList.add("active");

    if (event) {
        event.currentTarget.classList.add("active");
    }
}

function openImportHtmlModal() {
    document.getElementById('importHtmlForm').reset();
    var importHtmlModal = new bootstrap.Modal(document.getElementById('importHtmlModal'));
    importHtmlModal.show();
}

function openEditDocumentModal(button) {
    var row = button.closest('tr');
    document.getElementById('edit_doc_id').value = row.cells[0].innerText;
    document.getElementById('edit_c_id').value = row.cells[1].innerText;
    document.getElementById('edit_c_no').value = row.cells[2].innerText;
    document.getElementById('edit_c_tip').value = row.cells[3].innerText;
    document.getElementById('edit_c_kapsam').value = row.cells[4].innerText;
    document.getElementById('edit_c_yayin_tarih').value = row.cells[5].innerText;
    document.getElementById('edit_c_gozetim_tarih').value = row.cells[6].innerText;
    document.getElementById('edit_c_bitis_tarih').value = row.cells[7].innerText;
    document.getElementById('edit_c_adres').value = row.cells[8].innerText;
    document.getElementById('edit_c_status').value = row.cells[9].innerText;

    var editDocumentModal = new bootstrap.Modal(document.getElementById('editDocumentModal'));
    editDocumentModal.show();
}


function deleteDocument(button) {
    var row = button.closest('tr');
    var documentID = row.cells[0].innerText;
    if (!documentID) {
        alert('Lütfen silmek için bir belge seçin.');
        return;
    }
    fetch('delete_document.php', {
        method: 'POST',
        body: JSON.stringify({ id: documentID }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Belge başarıyla silindi.');
            location.reload();
        } else {
            alert('Silme sırasında bir hata oluştu: ' + data.error);
        }
    });
}


function uploadAttachment() {
    var form = document.getElementById('attachForm');
    var formData = new FormData(form);
    var attachStatus = document.getElementById('attachStatus');
    var attachMessage = document.getElementById('attachMessage');

    attachStatus.style.display = 'block';
    attachMessage.innerText = 'Dosya yükleniyor...';

    fetch('upload_attachment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            attachMessage.innerText = 'Dosya başarıyla eklendi!';
        } else {
            attachMessage.innerText = 'Dosya yükleme sırasında bir hata oluştu.';
        }
        setTimeout(function() {
            attachStatus.style.display = 'none';
            location.reload();
        }, 3000);
    })
    .catch(error => {
        attachMessage.innerText = 'Dosya yüklenirken bir hata oluştu: ' + error.message;
        setTimeout(function() {
            attachStatus.style.display = 'none';
        }, 3000);
    });
}
