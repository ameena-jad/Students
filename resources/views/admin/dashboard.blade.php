@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="students-wrapper">
        <div class="header-section">
            <h1>Admin Dashboard - Students List</h1>
            <a href="{{ route('admin.logout') }}" class="btn btn-danger">Logout</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($students->count() > 0)
            <div class="search-box">
                <input type="text" id="table-search" placeholder="Search students by name, email, phone, or ID card..." />
            </div>
            
            <div class="table-responsive">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>ID Card</th>
                            <th>Registered</th>
                            <th>Verified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->id_card }}</td>
                                <td>{{ $student->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="verified-badge {{ $student->verified_at ? 'verified' : 'unverified' }}">
                                        {{ $student->verified_at ? 'Verified' : 'Not Verified' }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <label class="verify-checkbox">
                                        <input 
                                            type="checkbox" 
                                            class="verify-student" 
                                            data-student-id="{{ $student->id }}"
                                            {{ $student->verified_at ? 'checked' : '' }}
                                        >
                                        <span>Verify</span>
                                    </label>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <p>No students registered yet.</p>
            </div>
        @endif
    </div>
</div>

<style>
.verified-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 500;
}

.verified-badge.verified {
    background-color: #d1fae5;
    color: #065f46;
}

.verified-badge.unverified {
    background-color: #fee2e2;
    color: #991b1b;
}

.verify-checkbox {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    margin-right: 0.5rem;
}

.verify-checkbox input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.verify-checkbox span {
    font-size: 0.875rem;
    font-weight: 500;
}
</style>

<script>
$(document).ready(function() {
    // Handle verify checkbox change
    $('.verify-student').on('change', function() {
        const checkbox = $(this);
        const studentId = checkbox.data('student-id');
        const row = checkbox.closest('tr');
        const badge = row.find('.verified-badge');
        
        // Disable checkbox during request
        checkbox.prop('disabled', true);
        
        $.ajax({
            url: '/admin/students/' + studentId + '/verify',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
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
    
    function showMessage(message, type) {
        const alertDiv = $('<div class="alert alert-' + type + '"></div>').text(message);
        $('.header-section').after(alertDiv);
        setTimeout(function() {
            alertDiv.fadeOut(500, function() {
                $(this).remove();
            });
        }, 3000);
    }
});
</script>
@endsection

