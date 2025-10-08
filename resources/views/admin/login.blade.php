@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container">
    <div class="form-wrapper">
        <h1>Admin Login</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('credentials'))
            <div class="alert alert-error">
                {{ $errors->first('credentials') }}
            </div>
        @endif

        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-control @error('username') is-invalid @enderror" 
                    value="{{ old('username') }}" 
                    required
                    autofocus
                >
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    required
                >
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="login-helper">
            <small>Demo Credentials: <strong>admin</strong> / <strong>admin123</strong></small>
        </div>
    </div>
</div>
@endsection

