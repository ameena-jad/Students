<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

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
            'phone' => 'required|digits:10|unique:students,phone',
            'id_card' => 'required|digits:9|unique:students,id_card',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student registered successfully!');
    }

    /**
     * Show the form for editing a student
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10|unique:students,phone,' . $student->id,
            'id_card' => 'required|digits:9|unique:students,id_card,' . $student->id,
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Soft delete the specified student
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
