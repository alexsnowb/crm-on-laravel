<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {

        $teams = Auth::user()
            ->allTeams()
        ;

        return view('livewire.team.index', [
            'teams' => $teams
        ]);
    }
}
