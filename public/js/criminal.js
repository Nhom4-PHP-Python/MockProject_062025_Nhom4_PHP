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
        if(fileToUpload.length === 0) return;
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
        if(fileToUpload.length === 0) {
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
        for (let i = 0; i < uploadedFiles.length; i += 2) {
            const row = document.createElement('div');
            row.className = 'row mb-1';
            for (let j = i; j < i + 2 && j < uploadedFiles.length; j++) {
                const col = document.createElement('div');
                col.className = 'col-6';
                col.innerHTML = `
                    <div class="border rounded p-2 bg-white d-flex align-items-center justify-content-between">
                        <span class="text-truncate"><i class="fa fa-file me-2 text-primary"></i>${uploadedFiles[j].name}</span>
                        <button type="button" class="btn btn-link text-danger p-0 ms-2 remove-file-btn" data-index="${j}" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                `;
                row.appendChild(col);
            }
            uploadedFilesList.appendChild(row);
            rowCount++;
        }
        uploadedFilesList.querySelectorAll('.remove-file-btn').forEach(btn => {
            btn.onclick = function() {
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
    

