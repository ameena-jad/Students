@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="container">
    <div class="students-wrapper">
        <div class="header-section">
            <h1>Students List</h1>
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($students->count() > 0)
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
                                <td class="actions-cell">
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
                <a href="{{ route('students.create') }}" class="btn btn-primary">Register First Student</a>
            </div>
        @endif
    </div>
</div>
@endsection

