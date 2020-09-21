<?php

namespace App\Http\Controllers;

use App\Models\Project;


class ProjectsController extends Controller
{
    public function index() {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store() {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $attributes['owner_id'] = auth()->id();

        Project::create($attributes);

        return redirect('/dashboard/projects');
    }

    public function show()
    {
        $project = Project::findOrFail(\request('project'));
        return view('projects.show', compact('project'));

    }
}
