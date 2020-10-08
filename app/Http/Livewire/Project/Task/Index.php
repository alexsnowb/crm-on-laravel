<?php

namespace App\Http\Livewire\Project\Task;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
     * @var Project
     */
    public $project;

    /**
     * @var string
     */
    public $newTaskTitle;

    /**
     * @var string
     */
    public $updatedTaskTitle;

    /**
     * @var Task[]
     */
    private $tasks;


    /**
     * @var bool
     */
    private $taskUpdated;


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

    public function updateTask($taskId)
    {
        /** @var Task $task */
        $task = Task::findOrFail($taskId);
        $task->title = $this->updatedTaskTitle;
        $task->save();

        $this->tasks = Task::where('project_id', $this->project->id)
            ->orderBy('id', 'desc')
            ->paginate(10)
        ;

        session()->flash('message', 'Task updated successfully');


        $this->updatedTaskTitle = '';


    }

    public function render()
    {

        if( empty($this->tasks) ) {
            $this->tasks = Task::where('project_id', $this->project->id)
                ->orderBy('id', 'desc')
                ->paginate(10)
            ;
        }


        return view('livewire.project.task.index', [
            'tasks' => $this->tasks
        ]);
    }
}
