document.addEventListener('DOMContentLoaded', function() {
    // Language dropdown functionality
    const langBtn = document.querySelector('.language-btn');
    const langMenu = document.querySelector('.language-menu');

    if (langBtn && langMenu) {
        // Toggle menu when clicking the button
        langBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            langMenu.classList.toggle('show');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function() {
            langMenu.classList.remove('show');
        });

        // Prevent menu from closing when clicking inside
        langMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    // Search functionality
    const searchInput = document.getElementById('search-input');
    const searchSuggestions = document.getElementById('search-suggestions');
    let searchTimeout;

    if (searchInput && searchSuggestions) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            // Clear previous timeout
            clearTimeout(searchTimeout);

            if (query.length >= 2) {
                // Delay search to avoid too many requests
                searchTimeout = setTimeout(() => {
                    fetchSearchSuggestions(query);
                }, 300);
            } else {
                hideSuggestions();
            }
        });

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                hideSuggestions();
            }
        });
    }

    function fetchSearchSuggestions(query) {
        fetch(`/ajax/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySuggestions(data, query);
            })
            .catch(error => {
                console.error('Search error:', error);
                hideSuggestions();
            });
    }

    function displaySuggestions(data, query) {
        if (!data.reports || data.reports.length === 0) {
            hideSuggestions();
            return;
        }
        let html = '<div class="suggestion-list">';
        if (data.reports && data.reports.length > 0) {
            html += '<div class="suggestion-category">Reports</div>';
            data.reports.forEach(report => {
                html += `<div class="suggestion-item" onclick="window.location.href='/report/${report.report_id}'">
                    <strong>${report.case_id}</strong><br>
                    <small>${report.type_report}</small>
                </div>`;
            });
        }
        if (data.has_more) {
            html += `<div class="suggestion-item suggestion-more" onclick="document.querySelector('.search-form').submit()">
                View all results for "${query}"
            </div>`;
        }
        html += '</div>';
        searchSuggestions.innerHTML = html;
        searchSuggestions.style.display = 'block';
    }

    function hideSuggestions() {
        if (searchSuggestions) {
            searchSuggestions.style.display = 'none';
        }
    }

    const handleAttachments = () => {
        const dropArea = document.querySelector("#drop-area");
        const selectFileButton = document.querySelector("#select-files-btn");
        const fileInput = document.querySelector("#attachments");
        const selectFileDiv = document.querySelector("#selected-files");
        const uploadButton = document.querySelector("#upload-btn");
        const uploadedFilesList = document.querySelector("#uploaded-files-list");

        let fileToUpload = [];
        let uploadedFiles = [];

        dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropArea.classList.add("border-primary");
        });
        dropArea.addEventListener("dragleave", (e) => {
            e.preventDefault();
            dropArea.classList.remove("border-primary");
        });
        dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            dropArea.classList.remove("border-primary");
            handleFiles(e.dataTransfer.files);
        });

        // choose button 
        selectFileButton.onclick = () => fileInput.click();
        // after choosing button
        fileInput.onchange = () => handleFiles(fileInput.files);

        // Show file name into the div
        const renderSelectedFiles = () => {
            selectFileDiv.innerHTML = "";
            if (fileToUpload.length === 0) return;
            fileToUpload.forEach(file => {
                const div = document.createElement("div");
                div.className = "text-truncate text-primary small";
                div.innerHTML = `<i class="fa fa-file me-2"></i>${file.name}`;
                selectFileDiv.appendChild(div);
            });
        }

        // Handle files selected or dropped
        const handleFiles = (files) => {
            fileToUpload = Array.from(files);
            renderSelectedFiles();
        }

        // Upload button
        uploadButton.onclick = () => {
            if (fileToUpload.length === 0) {
                alert("Please select files to upload.");
                return;
            }
            uploadedFiles = uploadedFiles.concat(fileToUpload);
            fileToUpload = [];
            fileInput.value = "";
            renderSelectedFiles();
            renderUploadedFiles();
            updateInputFiles();
        }

        // create html for uploaded files
        const renderUploadedFiles = () => {
            uploadedFilesList.innerHTML = "";
            let rows = "";
            uploadedFiles.forEach((file, index) => {
                const size = (file.size / 1024).toFixed(1); // size in KB
                const icon = handleIconUploadFiles(file.name, file.type);
                rows +=
                    `
                    <div class="file-item bg-light border"
                            style="width: calc(50% - 5px); padding: 10px; display: flex; justify-content: space-between; align-items: center;">
                            <span><i class="${icon}" style="margin-right: 5px;"></i><b>${file.name}</b><small> (${size} KB)</small></span>
                            <button type="button" class="btn btn-default remove-file-btn" data-index="${index}" title="Remove">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                    </div>
                    `;
            });
            uploadedFilesList.innerHTML = rows;

            // remove item
            uploadedFilesList.querySelectorAll('.remove-file-btn').forEach(btn => {
                btn.onclick = () => {                
                    const index = parseInt(btn.getAttribute('data-index'));
                    uploadedFiles.splice(index, 1);
                    renderUploadedFiles();
                    updateInputFiles();
                };
            });
        }

        // update file input to submit
        const updateInputFiles = () => {
            const dataTransfer = new DataTransfer();
            uploadedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }
    }

    const handleIconUploadFiles = (name, type) => {
        const ext = name.split('.').pop().toLowerCase();
        if (type.includes('pdf')) return 'fas fa-file-pdf text-danger';
        if (type.includes('word') || ['doc', 'docx'].includes(ext)) return 'fas fa-file-word text-primary';
        if (type.includes('excel') || ['xls', 'xlsx'].includes(ext)) return 'fas fa-file-excel text-success';
        if (type.startsWith('image/')) return 'fas fa-file-image text-info';
        return 'fas fa-file text-secondary';
    }

    const handleUploadFile = () => {
        const fileInput = document.querySelector("#file_input");
        const evidenceList = document.querySelector("#evidence-list");
        let uploadedFiles = [];

        // Choose file from library
        fileInput.onchange = () => {
            if (fileInput.files.length > 0) {
                uploadedFiles = uploadedFiles.concat(Array.from(fileInput.files));
                renderUploadedFiles();
                updateInputFiles();
            }
        }

        // create html for uploaded files
        const renderUploadedFiles = () => {
            evidenceList.innerHTML = "";
            let rows = "";
            uploadedFiles.forEach((file, index) => {
                const size = (file.size / 1024).toFixed(1); // size in KB
                const icon = handleIconUploadFiles(file.name, file.type);
                rows +=
                    `
                        <div class="evidence-item bg-light border"
                            style="width: calc(50% - 5px); padding: 10px; display: flex; justify-content: space-between; align-items: center;">
                            <span><i class="${icon}" style="margin-right: 5px;"></i><b>${file.name}</b><small>(${size} KB)</small></span>
                            <button class="btn btn-default remove-file-btn" data-index="${index}" title="Remove" type="button">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </div>
                    `;
            });
            evidenceList.innerHTML = rows;        
            // remove item
            evidenceList.querySelectorAll(".remove-file-btn").forEach(btn => {
                btn.onclick = () => {
                    const index = parseInt(btn.getAttribute('data-index'));
                    uploadedFiles.splice(index, 1);
                    renderUploadedFiles();
                    updateInputFiles();
                }
            });
            
        }
        // update file input to submit
        const updateInputFiles = () => {
            const dataTransfer = new DataTransfer();
            uploadedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }


    }

    let partyIndex = 0;
    let evidenceIndex = 0;

    function addPartyRow() {
        const tbody = document.getElementById('parties-body');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>#${partyIndex + 1}</td>
            <td><input type="text" name="party_role[]" class="form-control" required></td>
            <td><input type="text" name="party_name[]" class="form-control"></td>
            <td><input type="text" name="party_statement[]" class="form-control"></td>
            <td><input type="file" name="party_attachment[]" class="form-control"></td>
            <td><button type="button" class="btn btn-link text-danger" onclick="this.closest('tr').remove()"><i class="bi bi-trash"></i></button></td>
        `;
        tbody.appendChild(row);
        partyIndex++;
    }

    function addEvidenceRow() {
        const tbody = document.getElementById('evidence-body');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>#${evidenceIndex + 1}</td>
            <td><input type="text" name="evidence_type[]" class="form-control" required></td>
            <td><input type="text" name="evidence_location[]" class="form-control"></td>
            <td><input type="text" name="evidence_description[]" class="form-control"></td>
            <td><input type="file" name="evidence_attachment[]" class="form-control"></td>
            <td><button type="button" class="btn btn-link text-danger" onclick="this.closest('tr').remove()"><i class="bi bi-trash"></i></button></td>
        `;
        tbody.appendChild(row);
        evidenceIndex++;
    }

    window.onload = function() {
        addPartyRow();
        addEvidenceRow();
    };

    handleAttachments();
    handleUploadFile();
});


