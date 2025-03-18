// script.js
document.getElementById('uploadForm').addEventListener('submit', function (e) {
    const employeeFileInput = document.getElementById('employeeFile');
    const sampleFileInput = document.getElementById('previousFile');
    const errorMessage = document.getElementById('error-message');

    // Get file extensions for both files
    const employeeFile = employeeFileInput.files[0];
    const sampleFile = sampleFileInput.files[0];
    
    const employeeFileExtension = employeeFile ? employeeFile.name.split('.').pop().toLowerCase() : '';
    const sampleFileExtension = sampleFile ? sampleFile.name.split('.').pop().toLowerCase() : '';

    // Validate employee file type (.xlsx or .csv) - required
    if (employeeFileExtension !== 'xlsx' && employeeFileExtension !== 'csv') {
        e.preventDefault(); // Prevent form submission
        errorMessage.textContent = 'The Employee List file must be .xlsx or .csv!';
        return;
    }
    
    // Validate sample file type (.xlsx or .csv) - optional
    if (sampleFile && (sampleFileExtension !== 'xlsx' && sampleFileExtension !== 'csv')) {
        e.preventDefault(); // Prevent form submission
        errorMessage.textContent = 'The Previous Year Sample file must be .xlsx or .csv if provided!';
        return;
    }

    // Clear error message if validation passed
    errorMessage.textContent = '';
});
