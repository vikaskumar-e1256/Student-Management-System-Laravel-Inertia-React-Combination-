<?php

namespace App\Http\Controllers\Teacher;

use Inertia\Inertia;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\CreateRequest;
use App\Http\Requests\Other\StoreClassAndSubjectRequest;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return Inertia::render('Teacher/List', [
            'teachers' => $teachers
        ]);
    }

    public function create()
    {
        $classes = Classes::all();

        return Inertia::render('Teacher/Create', [
            'classes' => $classes
        ]);
    }

    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['image'] = NULL;

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('teacher_images', 'public');
        }

        Teacher::create($validatedData);

        return redirect()->route('teacher.create');
    }

    public function assignedClassAndSubject(Teacher $teacher)
    {
        $classes = Classes::all();
        return Inertia::render('Teacher/AssignedClassAndSubject', [
            'classes' => $classes,
            'create_url' => route('teacher.store.classAndSubject', $teacher->id),
        ]);
    }

    public function storeClassAndSubject(StoreClassAndSubjectRequest $request, Teacher $teacher)
    {
        $teacher->classes()->sync([$request->classes_id]);
        $teacher->subjects()->sync($request->subject_ids);
        return redirect()->back();
    }
}
