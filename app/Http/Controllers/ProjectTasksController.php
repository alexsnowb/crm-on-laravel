<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        \request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task = new Task([
            'title' => \request('title'),
            'description' => \request('description')
        ]);

        $project->addTask($task);
        return redirect($project->path());
    }
}
