document.addEventListener('DOMContentLoaded', function() {
    // Form validation and submit functionality
    const reportForm = document.getElementById('reportForm');
    const confirmMainSubmit = document.getElementById('confirmMainSubmit');
    const submitConfirmModal = new bootstrap.Modal(document.getElementById('submitConfirmModal'));
    const finalSubmitBtn = document.getElementById('finalSubmitBtn');
    const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    // Form validation function
    function validateForm() {
        const requiredFields = reportForm.querySelectorAll('[required]');
        let isValid = true;
        const errors = [];

        // Clear previous error styling
        requiredFields.forEach(field => {
            field.classList.remove('is-invalid');
        });

        // Check required fields
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
                const fieldName = field.getAttribute('name') || field.getAttribute('id');
                errors.push(`${fieldName} is required`);
            }
        });

        // Check if at least one relevant party is added
        const partiesTable = document.querySelector('tbody');
        const partyRows = partiesTable.querySelectorAll('tr');
        let hasParties = false;
        
        partyRows.forEach(row => {
            if (!row.querySelector('td[colspan]')) {
                hasParties = true;
            }
        });

        if (!hasParties) {
            errors.push('At least one relevant party must be added');
            isValid = false;
        }

        // Check if at least one evidence is added
        const evidenceTable = document.querySelectorAll('tbody')[1];
        const evidenceRows = evidenceTable.querySelectorAll('tr');
        let hasEvidence = false;
        
        evidenceRows.forEach(row => {
            if (!row.querySelector('td[colspan]')) {
                hasEvidence = true;
            }
        });

        if (!hasEvidence) {
            errors.push('At least one evidence must be added');
            isValid = false;
        }

        return { isValid, errors };
    }

    // Show validation errors
    function showValidationErrors(errors) {
        // Remove existing error alert
        const existingAlert = document.querySelector('.alert-danger');
        if (existingAlert) {
            existingAlert.remove();
        }

        // Create new error alert
        const errorAlert = document.createElement('div');
        errorAlert.className = 'alert alert-danger mb-3';
        errorAlert.innerHTML = `
            <ul class="mb-0">
                ${errors.map(error => `<li>${error}</li>`).join('')}
            </ul>
        `;

        // Insert before the form
        reportForm.insertBefore(errorAlert, reportForm.firstChild);
        
        // Scroll to top to show errors
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Handle main submit button click
    if (confirmMainSubmit) {
        confirmMainSubmit.addEventListener('click', function(e) {
            e.preventDefault();
            
            const validation = validateForm();
            
            if (!validation.isValid) {
                showValidationErrors(validation.errors);
                return;
            }

            // Show confirmation modal
            submitConfirmModal.show();
        });
    }

    // Handle final submit button click
    if (finalSubmitBtn) {
        finalSubmitBtn.addEventListener('click', function() {
            // Disable button to prevent double submission
            finalSubmitBtn.disabled = true;
            finalSubmitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...';
            
            // Submit the form
            reportForm.submit();
        });
    }

    // Handle delete confirmation
    let deleteUrl = null;
    
    // Add click event listeners to delete buttons
    document.querySelectorAll('.delete-icon').forEach(deleteBtn => {
        deleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            deleteUrl = this.getAttribute('data-url');
            deleteConfirmModal.show();
        });
    });

    // Handle confirm delete button
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (deleteUrl) {
                window.location.href = deleteUrl;
            }
        });
    }

    // Handle party form submission
    const partyForm = document.getElementById('partyForm');
    if (partyForm) {
        partyForm.addEventListener('submit', function(e) {
            const fullname = document.getElementById('fullname').value.trim();
            const relationship = document.getElementById('relationship').value;
            
            if (!fullname || !relationship) {
                e.preventDefault();
                alert('Please fill in all required fields');
                return;
            }
        });
    }

    // Handle evidence form submission
    const evidenceForm = document.getElementById('evidenceForm');
    if (evidenceForm) {
        evidenceForm.addEventListener('submit', function(e) {
            const type = document.getElementById('type').value;
            
            if (!type) {
                e.preventDefault();
                alert('Please select evidence type');
                return;
            }
        });
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (alert.classList.contains('alert-success') || alert.classList.contains('alert-danger')) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        });
    }, 5000);

    // Real-time validation for required fields
    const requiredFields = reportForm.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Prevent form submission on Enter key in textareas
    const textareas = reportForm.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.ctrlKey) {
                // Allow Ctrl+Enter for new line
                return;
            }
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    });

    // Add loading state to modal forms
    const modalForms = document.querySelectorAll('#partyForm, #evidenceForm');
    modalForms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
            }
        });
    });

    // Success message handling
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success')) {
        const successAlert = document.createElement('div');
        successAlert.className = 'alert alert-success alert-dismissible fade show';
        successAlert.innerHTML = `
            <i class="bi bi-check-circle-fill me-2"></i>
            ${urlParams.get('success')}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        reportForm.insertBefore(successAlert, reportForm.firstChild);
    }
}); 