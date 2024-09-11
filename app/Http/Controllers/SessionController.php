<?php

namespace App\Http\Controllers;

use App\Jobs\SendInvitation;
use App\Notifications\InvitationNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        //validate
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //attempt to login the user
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'sorry, Invalid credentials',
            ]);
        }

        //regenerate the session login
        request()->session()->regenerate();

        // $job = new SendInvitation(auth()->user(), request()->ip());
        // dispatch($job);
        Notification::send(auth()->user(), new InvitationNotification(request()->ip()));
        //redirect
        return redirect('/jobs');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
