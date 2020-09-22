<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class Create extends Component
{
    /** @var Project */
    public $project;

    protected $rules = [
        'project.title' => 'required|string|min:2',
        'project.description' => 'required|string|max:500',
    ];

    public function createProject()
    {
        $validatedData = $this->validate();
        auth()->user()->projects()->create($validatedData['project']);
    }

    public function render()
    {
        return view('livewire.project.create');
    }
}
