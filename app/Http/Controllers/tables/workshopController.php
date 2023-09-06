<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Workshop;
use App\Models\User;
use App\Models\Student;


class workshopController extends Controller
{
  public function index()
  {
        // Fetch users with the role "teacher" from the database
        $workshops = Workshop::with('teacher', 'manager','students')->get();
        $teachs = User::where('role', 'teacher')->get();
        $manags = User::where('role', 'manager')->get();
        $studs = Student::all();          

        // Pass the data to the view
        return view('content.tables.tables-workshop')->with('workshops', $workshops)->with('teachs', $teachs)->with('manags', $manags)->with('studs', $studs); 
    
  }
  public function update(Request $request ,$id)
  {
    $validatedData = $request->validate([
      'name' => 'nullable',
      'status' => 'nullable',
      'fee' => 'nullable|numeric',
      'description' => 'nullable',
      'teachers' => 'nullable|array',
      'teachers.*' => 'nullable:users,id',
      'managers' => 'nullable|array',
      'managers.*' => 'exists:users,id',
      'students' => 'nullable|array',
      'students.*' => 'exists:students,id',
      'studentfee' => 'nullable|numeric',
  ]);

  try {
    // Find the workshop by its ID
    $workshop = Workshop::findOrFail($id);
    $students = Student::all();   
    // Update the workshop with the validated data
    $workshop->update($validatedData);
    $workshop->teacher()->attach($request->input('teachers'));
    $workshop->manager()->attach($request->input('managers'));
    // If students data is sent in the request, sync the students relationship
    if ($request->has('students')) {
      foreach ($request->input('students') as $studentData) {
        $student = Student::find($studentData);
        $studentfees=$request->input('studentfee');
        if ($student) {
            // Update the student's fee if it's provided
            if($studentfees){
                $student->fee = $studentfees;
                $student->save();
              }
              else{
                $student->fee = $workshop['fee'];
              }
          }
          $workshop->students()->attach($request->input('students'));
    }
        
    }
    return view('content.tables.workshop-view')->with('workshop', $workshop)->with('students', $students);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error updating workshop'], 500);
    }

  }
  public function edit(Request $request ,$id){
    $workshop = Workshop::with('teacher', 'manager','students')->find($id);
    $teachers = User::where('role', 'teacher')->get();
    $managers = User::where('role', 'manager')->get();
    $students = Student::all();  
    if (!$workshop) {
      return response()->json(['error' => 'Workshop not found'], 404);
    }
    return view('content.tables.workshop-edit')->with('workshop', $workshop)->with('teachers', $teachers)->with('managers', $managers)->with('students', $students);
    
  }
  public function view(Request $request ,$id){
    $workshop = Workshop::with('teacher', 'manager','students')->find($id);
    $students = Student::all();  
    if (!$workshop) {
      return response()->json(['error' => 'Workshop not found'], 404);
    }
    return view('content.tables.workshop-view')->with('workshop', $workshop)->with('students', $students);
    
  }

  public function remove(Request $request,$id){
    $validatedData = $request->validate([
      'name' => 'nullable',
      'status' => 'nullable',
      'fee' => 'nullable|numeric',
      'description' => 'nullable',
      'teachers' => 'nullable|array',
      'teachers.*' => 'nullable:users,id',
      'managers' => 'nullable|array',
      'managers.*' => 'exists:users,id',
      'students' => 'nullable|array',
      'students.*' => 'exists:students,id',
    ]);

    $workshop = Workshop::findOrFail($id);
    $workshop->update($validatedData);

    // Sync managers: remove missing managers and add new managers
    if ($request->has('managers')) {
        $workshop->manager()->sync($request->input('managers'));
    }

    // Sync teachers: remove missing teachers and add new teachers
    if ($request->has('teachers')) {
        $workshop->teacher()->sync($request->input('teachers'));
    }

    // Detach removed managers
    if ($request->has('removed_manager_ids')) {
        $removedManagerIds = json_decode($request->input('removed_manager_ids'));
       $workshop->manager()->detach($removedManagerIds);
    }

    // Detach removed teachers
    if ($request->has('removed_teacher_ids')) {
        $removedTeacherIds = json_decode($request->input('removed_teacher_ids'));
        $workshop->teacher()->detach($removedTeacherIds);
    }

    return response()->json(['message' => 'Workshop updated successfully']);
  }

  public function managerWorkshops($id){
    $manager = User::where('role', 'manager')->find($id);
    $workshops = $manager->workshopsAsManager()->get(); 

    return response()->json(['workshops' => $workshops]);
  }

  public function teacherWorkshops($id){
    $teacher = User::where('role', 'teacher')->find($id);
    $workshops = $teacher->workshopsAsTeacher()->get(); 

    return response()->json(['workshops' => $workshops]);
  }

  public function studentWorkshops($id){
    $student = Student::find($id);
    $workshops = $student->workshops()->get(); 

    return response()->json(['workshops' => $workshops]);
  }
  
}
