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
        let rowCount = 1;

        let rows = "";
        for (let i = 0; i < uploadedFiles.length; i++) {
            const size = (uploadedFiles[i].size / 1024).toFixed(1); // size in KB
            const icon = handleIconUploadFiles(uploadedFiles[i].name, uploadedFiles[i].type);
            rows +=
                `
                <div class="file-item bg-light border"
                        style="width: calc(50% - 5px); padding: 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span><i class="${icon}" style="margin-right: 5px;"></i><b>${uploadedFiles[i].name}</b><small> (${size} KB)</small></span>
                        <button class="btn btn-default remove-file-btn" data-index="${i}" title="Remove">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </button>
                </div>
                `;
        }
        uploadedFilesList.innerHTML = rows;

        uploadedFilesList.querySelectorAll('.remove-file-btn').forEach(btn => {
            btn.onclick = function () {
                const idx = parseInt(this.getAttribute('data-index'));
                uploadedFiles.splice(idx, 1);
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

    fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            uploadedFiles = uploadedFiles.concat(Array.from(fileInput.files));
            renderUploadedFiles();
            updateInputFiles();
        }
    }


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

        evidenceList.querySelectorAll(".remove-file-btn").forEach(btn => {
            btn.onclick = () => {
                const index = parseInt(btn.getAttribute('data-index'));
                uploadedFiles.splice(index, 1);
                renderUploadedFiles();
                updateInputFiles();
            }
        });
        
    }
    const updateInputFiles = () => {
        const dataTransfer = new DataTransfer();
        uploadedFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }


}


