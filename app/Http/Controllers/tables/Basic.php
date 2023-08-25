<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Basic extends Controller
{
  public function index()
  {
        // Fetch users with the role "teacher" from the database
        $managers = DB::table('users')->where('role', 'manager')->get();
        $teachers = DB::table('users')->where('role', 'teacher')->get();
        $students = DB::table('students')->get();


        // Pass the data to the view
       // return view('content.tables.tables-basic')->with('managers', $managers)->with('teachers', $teachers)->with('students', $students); 
    
  }
  public function manager()
  {
        // Fetch users with the role "teacher" from the database
        $managers = DB::table('users')->where('role', 'manager')->get();
        

        // Pass the data to the view
        return view('content.tables.manager-table')->with('managers', $managers); 
    
  }
  public function teacher()
  {
        // Fetch users with the role "teacher" from the database
        $teachers = DB::table('users')->where('role', 'teacher')->get();


        // Pass the data to the view
        return view('content.tables.teacher-table')->with('teachers', $teachers); 
    
  }
  public function student()
  {
        // Fetch users with the role "teacher" from the database
        $students = DB::table('students')->get();


        // Pass the data to the view
        return view('content.tables.student-table')->with('students', $students); 
    
  }

  
}
