<?php

namespace App\Http\Controllers\Subject;

use Inertia\Inertia;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\CreateRequest;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teachers', 'students', 'languages')->get();

        return Inertia::render('Subject/List', [
            'subjects' => $subjects
        ]);
    }

    public function create()
    {
        $languages = Language::all();
        $classes = Classes::all();

        return Inertia::render('Subject/Create', [
            'languages' => $languages,
            'classes' => $classes
        ]);
    }

    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();

        $languages = $validatedData['languages'];
        $classIDs = $validatedData['classes_id'];

        unset($validatedData['languages']);
        unset($validatedData['classes_id']);

        $subject = Subject::create($validatedData);

        $subject->languages()->sync($languages);

        $subject->classes()->sync($classIDs);

        return redirect()->route('subject.create')->with('success', 'Subject added successfully!');
    }

    public function getSubjectsByClassIDS(Request $request)
    {
        $classesIdString = $request->input('class');

        $subjects = Subject::whereIn('id', function ($query) use ($classesIdString) {
            // Subquery to select subject_id from the classes_subject pivot table
            $query->select('subject_id')
            ->from('classes_subject')
            ->where('classes_id', $classesIdString);
        })->get();

        return response()->json($subjects);
    }
}
