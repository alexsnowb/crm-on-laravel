<?php

namespace App\Http\Livewire\Project\Task;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $project;

    public $newTaskTitle;

    public function addNewTask()
    {
        $this->validate(['newTaskTitle' => 'required|max:255']);

        Task::create([
                'title' => $this->newTaskTitle,
                'project_id' => $this->project->id
            ]
        );

        $this->newTaskTitle = '';

        session()->flash('message', 'Task added successfully');

    }

    public function render()
    {
        $tasks = Task::where('project_id', $this->project->id)
            ->orderBy('id', 'desc')
            ->paginate(10)
        ;

        return view('livewire.project.task.index', [
            'tasks' => $tasks
        ]);
    }
}
