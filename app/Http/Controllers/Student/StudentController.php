<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateRequest;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('studentClass')->get();

        return Inertia::render('Student/List', [
            'students' => $students
        ]);
    }

    public function create()
    {
        $classes = Classes::all();
        return Inertia::render('Student/Create', [
            'classes' => $classes
        ]);
    }

    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['image'] = NULL;

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('student_images', 'public');

        }

        Student::create($validatedData);

        return redirect()->route('student.create');
    }
}
