// Form validation and interactivity
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('student-form');
    
    if (form) {
        // Add real-time validation
        const inputs = form.querySelectorAll('.form-control');
        
        inputs.forEach(input => {
            // Remove error styling on input
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    const errorMsg = this.parentElement.querySelector('.error-message');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            });

            // Add blur validation
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Auto-hide success messages
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.5s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.remove();
            }, 500);
        }, 5000);
    }
});

/**
 * Validate individual form field
 */
function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';

    // Remove existing error message
    const existingError = field.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Required validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = `${getFieldLabel(field)} is required.`;
    }

    // Email validation
    if (fieldName === 'email' && value) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        }
    }

    // Phone validation (10 digits exactly)
    if (fieldName === 'phone' && value) {
        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(value)) {
            isValid = false;
            errorMessage = 'Phone number must be exactly 10 digits.';
        }
    }

    // ID Card validation (9 digits exactly)
    if (fieldName === 'id_card' && value) {
        const idCardPattern = /^\d{9}$/;
        if (!idCardPattern.test(value)) {
            isValid = false;
            errorMessage = 'ID Card must be exactly 9 digits.';
        }
    }

    // Display error if invalid
    if (!isValid) {
        field.classList.add('is-invalid');
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        errorSpan.textContent = errorMessage;
        field.parentElement.appendChild(errorSpan);
    } else {
        field.classList.remove('is-invalid');
    }

    return isValid;
}

/**
 * Get human-readable field label
 */
function getFieldLabel(field) {
    const label = field.parentElement.querySelector('label');
    if (label) {
        return label.textContent.trim();
    }
    return field.name.charAt(0).toUpperCase() + field.name.slice(1);
}

/**
 * Phone number formatting - only digits (10 digits max)
 */
const phoneInput = document.getElementById('phone');
if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
        // Remove non-numeric characters
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });
}

/**
 * ID Card formatting - only digits (9 digits max)
 */
const idCardInput = document.getElementById('id_card');
if (idCardInput) {
    idCardInput.addEventListener('input', function(e) {
        // Remove non-numeric characters
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });
}
