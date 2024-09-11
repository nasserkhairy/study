<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate(
            [
                'title' => ['required', 'min:3'],
                'salary' => ['required'],
            ]
        );


        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        Mail::to($job->employer->user)->queue(
            new JobPosted()
        );
        return redirect('/jobs');
    }


    public function edit(Job $job)
    {


        // if (Auth::guest()) {
        //     return redirect('/login');
        // }
        // if ($job->employer->user->isNot(Auth::user())) {
        //     abort(403);
        // }
        // Gate::authorize('edit_job', $job);
        // Auth::user()->can('edit_job', $job);

        return view('jobs.edit', ['job' => $job]);
    }



    public function update(Job $job)
    {

        Gate::authorize('edit_job', $job);
        //validate
        request()->validate(
            [
                'title' => ['required', 'min:3'],
                'salary' => ['required'],
            ]
        );
        //authorize(On hold...)

        //Update
        // $job=Job::findOrFail($id);

        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        return redirect('/jobs/' . $job->id);
    }
    public function destroy(job $job)
    {
        Gate::authorize('edit_job', $job);

        //authorize(On hold...)

        //delete
        $job->delete();


        //redirect
        return redirect('/jobs');
    }

    public function test()
    {
        $response = Http::get('https://beta.ri7laty.com');

        return $response->body();
        dd($body);
        $array  = json_decode($body, true);
        dd($array[7]['title']);
    }
}
