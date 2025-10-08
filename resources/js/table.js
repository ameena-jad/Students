// Students table search functionality with jQuery
export function initTableSearch() {
    const $table = $('.students-table');
    const $searchInput = $('#table-search');
    
    if ($table.length && $searchInput.length) {
        // Search functionality
        $searchInput.on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            
            $table.find('tbody tr').each(function() {
                const $row = $(this);
                const rowText = $row.text().toLowerCase();
                
                if (rowText.indexOf(searchValue) > -1) {
                    $row.show();
                } else {
                    $row.hide();
                }
            });
            
            // Show/hide empty message
            const visibleRows = $table.find('tbody tr:visible').length;
            if (visibleRows === 0) {
                if ($('.no-results').length === 0) {
                    $table.after('<p class="no-results">No students found matching your search.</p>');
                }
            } else {
                $('.no-results').remove();
            }
        });
    }
}

