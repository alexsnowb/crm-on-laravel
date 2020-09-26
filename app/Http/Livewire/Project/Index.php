<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {
        return view('livewire.project.index', [
            'projects' => Project::where('owner_id', Auth::id())
                ->where('title','like', '%'.$this->searchTerm.'%')
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }
}
