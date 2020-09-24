<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class Edit extends Component
{

    /** @var Project */
    public $project;

    protected $rules = [
        'project.title' => 'required|string|min:2',
        'project.description' => 'required|string|max:500',
    ];

    public function editProject()
    {
        $this->validate();
        $this->project->save();
        $this->redirect($this->project->path());
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}
