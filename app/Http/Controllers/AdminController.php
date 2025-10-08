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
     * Process admin login (check against database)
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Check credentials against database
        $admin = \DB::table('admins')->where('username', $request->username)->first();

        if ($admin && \Hash::check($request->password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
                'admin_username' => $admin->username
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

        return back()->withErrors(['credentials' => 'Invalid username or password']);
    }

    /**
     * Show admin dashboard with students list
     */
    public function dashboard(Request $request)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Filter by verification status
        $filter = $request->get('filter', 'all');
        
        $query = Student::query();
        
        if ($filter === 'verified') {
            $query->whereNotNull('verified_at');
        } elseif ($filter === 'unverified') {
            $query->whereNull('verified_at');
        }
        
        $students = $query->latest()->get();
        
        return view('admin.dashboard', compact('students', 'filter'));
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
