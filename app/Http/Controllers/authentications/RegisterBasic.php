<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidRole;
use App\Models\Student;


class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }
  public function register(Request $request){

    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8',
      'role' => 'required|in:manager,teacher',
      
  ]); 
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }
  $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        // Save the user record to the database
        $user->save();
        return redirect('dashboard/dashboards-analytics')->with('success','Registration Successful'); 
  }

  //Store Student
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [

          'name' => 'required|string|max:255', // Validate that name is a required string up to 255 characters
          'email' => 'required|email|unique:students,email', // Validate that email is a required and unique email address
          'phone_number' => 'required|string|max:11',
          'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          'fee'=> 'required|numeric|min:0'
          // You can add more validation rules for other fields if needed.
        ]);
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }


      
      // Create a new Student instance with validated data
      $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->phone_number=$request->input('phone_number');
        $student->fee = $request->input('fee');
        $student->picture = $request->input('picture');
        // Save the student record to the database
      $student->save();

      // Optionally, you can redirect to a success page or return a response indicating successful creation.
      return redirect('dashboard/dashboards-analytics')->with('success','Registration Successful');
  }
   
  public function update(Request $request ,$id)
  {
    
      // Validate the request data
     
    
// Retrieve the currently authenticated user
      

// Determine the user's role
      $role = $request->input('role');

// Retrieve data based on the user's role
      if ($role === 'student') {
        
        $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:students,email,' . $id,
          'role' => 'required|in:manager,teacher,student',
          'phone_number'=>'nullable|integer|max:11'
  
        ]);
        $student = Student::where('id', $request->id)->first();

    // Now you can access the student data using the $student object
         if ($student) {
        // Update the student data based on the form inputs, if provided
        $student->name =  $request->input('name') ?: $student->name;
        $student->email =  $request->input('email') ?: $student->email;
        $student->phone_number =  $request->input('phone_number') ?: $student->phone_number;
        $student->fee =  $request->input('fee') ?: $student->fee;
        // Save the updated student data
        $student->save();
        }
      }elseif ($role === 'manager' || $role === 'teacher') {
        $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:users,email,' . $id,
          'password' => 'required|string|min:8',
          'role' => 'required|in:manager,teacher,student',
  
        ]);
        $user = User::where('id', $request->id)->first();
        $user->name = $request->input('name') ?: $user->name;
        $user->email = $request->input('email')?: $user->email;
        $user->password = Hash::make($request->input('password')) ?: $user->password;
        $user->role = $request->input('role') ?: $user->role;

    
        $user->save();
      
      }
      return response()->json(['message' => 'Data updated successfully']);
    

  }

}
