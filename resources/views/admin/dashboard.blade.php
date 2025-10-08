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

        <div class="filter-buttons">
            <a href="{{ route('admin.dashboard', ['filter' => 'all']) }}" 
               class="filter-btn {{ (!isset($filter) || $filter === 'all') ? 'active' : '' }}">
                All Students
            </a>
            <a href="{{ route('admin.dashboard', ['filter' => 'verified']) }}" 
               class="filter-btn {{ $filter === 'verified' ? 'active' : '' }}">
                Verified Only
            </a>
            <a href="{{ route('admin.dashboard', ['filter' => 'unverified']) }}" 
               class="filter-btn {{ $filter === 'unverified' ? 'active' : '' }}">
                Unverified Only
            </a>
        </div>

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
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="delete-form">
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
@endsection

