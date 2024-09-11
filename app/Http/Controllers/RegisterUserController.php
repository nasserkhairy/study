<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;

class RegisterUserController extends Controller
{
    public function create(){

        return view('auth.register');
       

    }

    public function store(){
        //validate
        $attributes=request()->validate([
           'first_name'=>['required'], 
           'last_name'=>['required'], 
           'email'=>['required','email'], 
           'password'=>['required',password::min(6),'confirmed'], 
        ]);
        //create the user
        $user=User::create( $attributes);
        //login
        Auth::login($user);
        //redirect
        return redirect('/jobs');
    }
   
}
