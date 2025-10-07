<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Show the student registration form
     */
    public function create()
    {
        return view('students.register');
    }

    /**
     * Store a new student in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20|unique:students,phone',
            'id_card' => 'required|string|max:50',
        ]);

        $student = Student::create($validated);

        return redirect()->back()->with('success', 'Student registered successfully!');
    }
}
