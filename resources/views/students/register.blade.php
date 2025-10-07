@extends('layouts.app')

@section('title', 'Student Registration Form')

@section('content')
<div class="container">
    <div class="form-wrapper">
        <h1>Student Registration Form</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" id="student-form">
            @csrf
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}" 
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
                    value="{{ old('email') }}" 
                    required
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (Unique)</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    class="form-control @error('phone') is-invalid @enderror" 
                    value="{{ old('phone') }}" 
                    required
                >
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_card">ID Card Number</label>
                <input 
                    type="text" 
                    id="id_card" 
                    name="id_card" 
                    class="form-control @error('id_card') is-invalid @enderror" 
                    value="{{ old('id_card') }}" 
                    required
                >
                @error('id_card')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Register Student</button>
        </form>
    </div>
</div>
@endsection

