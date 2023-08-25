<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session;



class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }
  public function login(Request $request){

    
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);
    $user = User::where('email', $request->input('email'))->first();
    $password=$request->input('password');
    //$request->get('password'), $user->password
    
  
    if ($user && Hash::check($password, $user->password)){
      if ($user->role === 'admin') {
        // Redirect to the admin dashboard
        return redirect('dashboard/dashboards-analytics');
     }
     /*
     elseif ($user->role === 'manager') {
      # code...
     }
     elseif ($user->role === 'teacher') {
      # code...
     }
     */
      //return view('content.dashboard.dashboards-analytics');
  
        
      }
    else{
      
      return redirect('/')->withError('Login details are not valid');

    }
    
  }

  public function logout(){
    
    Auth::logout();
    return redirect('/');
  }
}
