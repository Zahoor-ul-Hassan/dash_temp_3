<?php

namespace App\Http\Controllers\form_layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class VerticalForm extends Controller
{
  public function index()
  {
    return view('content.form-layout.form-layouts-vertical');
  }
  
  

}
