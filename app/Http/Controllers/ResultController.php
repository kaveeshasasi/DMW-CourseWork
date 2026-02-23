<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with(['exam', 'student'])->get();
        return view('results.index', compact('results'));
    }

    public function create()
    {
        $exams = Exam::with('course')->get();
        $students = Student::all();
        return view('results.create', compact('exams', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'marks' => 'required|integer',
            'grade' => 'required',
        ]);

        Result::create($request->all());

        return redirect()->route('results.index')->with('success', 'Result created successfully.');
    }

    public function show(Result $result)
    {
        return view('results.show', compact('result'));
    }

    public function edit(Result $result)
    {
        $exams = Exam::all();
        $students = Student::all();
        return view('results.edit', compact('result', 'exams', 'students'));
    }

    public function update(Request $request, Result $result)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'marks' => 'required|integer',
            'grade' => 'required',
        ]);

        $result->update($request->all());

        return redirect()->route('results.index')->with('success', 'Result updated successfully.');
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->route('results.index')->with('success', 'Result deleted successfully.');
    }
}
