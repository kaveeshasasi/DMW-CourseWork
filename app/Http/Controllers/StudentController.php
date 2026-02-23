<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('batch')->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $batches = Batch::all();
        return view('students.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reg_no' => 'required|unique:students',
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'batch_id' => 'required|exists:batches,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $batches = Batch::all();
        return view('students.edit', compact('student', 'batches'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'reg_no' => 'required|unique:students,reg_no,' . $student->id,
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'batch_id' => 'required|exists:batches,id',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
