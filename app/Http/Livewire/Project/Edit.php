<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class Edit extends Component
{

    public $project;

    protected $rules = [
        'project.title' => 'required|string|min:2',
        'project.description' => 'required|string|max:500',
    ];

    public function editProject()
    {
        $validatedData = $this->validate();
        auth()->user()->projects()->create($validatedData['project']);
    }

    public function render()
    {

        //dd(request());

        return view('livewire.project.edit');
    }
}
