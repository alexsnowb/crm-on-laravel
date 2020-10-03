<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {
        return view('livewire.team.index', [
            'teams' => Team::where('user_id', Auth::id())
                ->where('name','like', '%'.$this->searchTerm.'%')
                ->orderBy('id', 'desc')
                ->paginate(10)
        ]);
    }
}
