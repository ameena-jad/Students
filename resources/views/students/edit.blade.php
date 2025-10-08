@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="container">
    <div class="form-wrapper">
        <h1>Edit Student</h1>

        <form action="{{ route('students.update', $student) }}" method="POST" id="student-form">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $student->name) }}" 
                    required
                >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email', $student->email) }}" 
                    required
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (10 digits)</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="form-control @error('phone') is-invalid @enderror" 
                    value="{{ old('phone', $student->phone) }}" 
                    placeholder="e.g., 1234567890"
                    maxlength="10"
                    required
                >
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_card">ID Card Number (9 digits)</label>
                <input 
                    type="text" 
                    id="id_card" 
                    name="id_card" 
                    class="form-control @error('id_card') is-invalid @enderror" 
                    value="{{ old('id_card', $student->id_card) }}" 
                    placeholder="e.g., 123456789"
                    maxlength="9"
                    required
                >
                @error('id_card')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

