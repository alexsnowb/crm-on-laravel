<?php

namespace App\Http\Controllers;

use App\Models\Project;


class ProjectsController extends Controller
{
    public function index() {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create() {
        return view('projects.create');
    }

    public function store() {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        auth()->user()->projects()->create($attributes);

        return redirect('/dashboard/projects');
    }

    public function show()
    {
        $project = Project::findOrFail(\request('project'));

        if(auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));

    }

    public function edit()
    {
        $project = Project::findOrFail(\request('project'));

        if(auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.edit', compact('project'));

    }
}
