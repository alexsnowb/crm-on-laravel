<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {

        if(\Auth::user()->isNot($project->owner)) {
            abort(403);
        }

        \request()->validate([
            'title' => 'required',
        ]);

        $task = new Task([
            'title' => \request('title'),
            'description' => \request('description')
        ]);

        $project->addTask($task);
        return redirect($project->path());
    }

    public function show()
    {
        $project = Project::findOrFail(\request('project'));
        $task = Task::findOrFail(\request('task'));

        if(\Auth::user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));

    }
}
