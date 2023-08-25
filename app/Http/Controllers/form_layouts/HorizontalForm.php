<?php

namespace App\Http\Controllers\form_layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\User;
use App\Models\Student;
class HorizontalForm extends Controller
{
  public function index()
  {
    $teachers = User::where('role', 'teacher')->get();
    $managers = User::where('role', 'manager')->get();

    $students = Student::all();

    return view('content.form-layout.form-layouts-horizontal', compact('teachers', 'managers', 'students'));
  }
  public function store(Request $request)
  {
    // Validate the form data
    
    $validatedData = $request->validate([
      'name' => 'required',
      'fee' => 'required|numeric',
      'description' => 'required',
      'teachers' => 'required|array',
      'teachers.*' => 'exists:users,id',
      'managers' => 'required|array',
      'managers.*' => 'exists:users,id',
      'students' => 'required|array', 
      'students.*' => 'exists:students,id',
    ]);

    // Create the workshop
    $workshop = Workshop::create($validatedData);

    // Attach students to the workshop
    $workshop->students()->attach($validatedData['students']);
    $workshop->teacher()->attach($validatedData['teachers']);
    $workshop->manager()->attach($validatedData['managers']);

    return redirect('dashboard/dashboards-analytics')->with('success','Registration Successful');
  }
}
