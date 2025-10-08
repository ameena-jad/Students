// Form validation with jQuery
export function initFormValidation() {
    const $form = $('#student-form');
    
    if ($form.length) {
        const $inputs = $form.find('.form-control');
        
        // Remove error styling on input
        $inputs.on('input', function() {
            const $this = $(this);
            if ($this.hasClass('is-invalid')) {
                $this.removeClass('is-invalid');
                $this.parent().find('.error-message').remove();
            }
        });

        // Add blur validation
        $inputs.on('blur', function() {
            validateField($(this));
        });

        // Form submission
        $form.on('submit', function(e) {
            let isValid = true;
            
            $inputs.each(function() {
                if (!validateField($(this))) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // Auto-hide success messages
    const $successAlert = $('.alert-success');
    if ($successAlert.length) {
        setTimeout(function() {
            $successAlert.fadeOut(500, function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Phone number formatting - only digits (10 digits max)
    $('#phone').on('input', function() {
        const value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });

    // ID Card formatting - only digits (9 digits max)
    $('#id_card').on('input', function() {
        const value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });
}

/**
 * Validate individual form field
 */
function validateField($field) {
    const value = $field.val().trim();
    const fieldName = $field.attr('name');
    let isValid = true;
    let errorMessage = '';

    // Remove existing error message
    $field.parent().find('.error-message').remove();

    // Required validation
    if ($field.attr('required') && !value) {
        isValid = false;
        errorMessage = getFieldLabel($field) + ' is required.';
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
        $field.addClass('is-invalid');
        const $errorSpan = $('<span class="error-message"></span>').text(errorMessage);
        $field.parent().append($errorSpan);
    } else {
        $field.removeClass('is-invalid');
    }

    return isValid;
}

/**
 * Get human-readable field label
 */
function getFieldLabel($field) {
    const $label = $field.parent().find('label');
    if ($label.length) {
        return $label.text().trim();
    }
    return $field.attr('name').charAt(0).toUpperCase() + $field.attr('name').slice(1);
}

