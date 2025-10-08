// Admin panel functionality
export function initAdminPanel() {
    // Handle verify checkbox change
    $('.verify-student').on('change', function() {
        const checkbox = $(this);
        const studentId = checkbox.data('student-id');
        const row = checkbox.closest('tr');
        const badge = row.find('.verified-badge');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        // Disable checkbox during request
        checkbox.prop('disabled', true);
        
        $.ajax({
            url: '/admin/students/' + studentId + '/verify',
            method: 'POST',
            data: {
                _token: csrfToken
            },
            success: function(response) {
                if (response.success) {
                    // Update badge
                    if (response.verified) {
                        badge.removeClass('unverified').addClass('verified').text('Verified');
                    } else {
                        badge.removeClass('verified').addClass('unverified').text('Not Verified');
                    }
                    
                    // Show success message
                    showMessage(response.message, 'success');
                }
                checkbox.prop('disabled', false);
            },
            error: function() {
                alert('Error updating verification status');
                // Revert checkbox
                checkbox.prop('checked', !checkbox.prop('checked'));
                checkbox.prop('disabled', false);
            }
        });
    });
    
    // Delete form confirmation
    $('.delete-form').on('submit', function(e) {
        if (!confirm('Are you sure you want to delete this student?')) {
            e.preventDefault();
        }
    });
}

function showMessage(message, type) {
    const alertDiv = $('<div class="alert alert-' + type + '"></div>').text(message);
    $('.header-section').after(alertDiv);
    setTimeout(function() {
        alertDiv.fadeOut(500, function() {
            $(this).remove();
        });
    }, 3000);
}

