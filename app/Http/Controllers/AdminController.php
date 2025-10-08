<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin login form
     */
    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Process admin login (dummy data)
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Dummy credentials
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

        return back()->withErrors(['credentials' => 'Invalid username or password']);
    }

    /**
     * Show admin dashboard with students list
     */
    public function dashboard()
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $students = Student::latest()->get();
        return view('admin.dashboard', compact('students'));
    }

    /**
     * Verify student (toggle verified_at)
     */
    public function verify(Request $request, Student $student)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Toggle verification
        if ($student->verified_at) {
            $student->verified_at = null;
            $message = 'Student unverified successfully';
        } else {
            $student->verified_at = now();
            $message = 'Student verified successfully';
        }

        $student->save();

        return response()->json([
            'success' => true,
            'message' => $message,
            'verified' => $student->verified_at ? true : false
        ]);
    }

    /**
     * Logout admin
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
}
