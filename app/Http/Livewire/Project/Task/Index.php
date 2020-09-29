<?php

namespace App\Http\Livewire\Project\Task;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;
    public $project;
    public $tasks;

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

    public function render(Project $project)
    {
        return view('livewire.project.task.index', [
            'tasks' => Task::where('project_id', $project->id)
                ->where('title','like', '%'.$this->searchTerm.'%')
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }
}
