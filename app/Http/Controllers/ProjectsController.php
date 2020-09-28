<?php

namespace App\Http\Controllers;

use App\Models\Project;


class ProjectsController extends Controller
{
    public function index() {
        return view('projects.index');
    }

    public function create() {
        return view('projects.create');
    }

    public function store() {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        \Auth::user()->projects()->create($attributes);

        return redirect('/dashboard/projects');
    }

    public function show()
    {
        $project = Project::findOrFail(\request('project'));

        if(\Auth::user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));

    }

    public function edit()
    {
        $project = Project::findOrFail(\request('project'));

        if(\Auth::user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.edit', compact('project'));

    }
}
