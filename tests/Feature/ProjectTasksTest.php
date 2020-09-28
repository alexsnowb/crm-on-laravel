<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function can_project_have_tasks()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()
            ->create(['owner_id' => \Auth::id()]);

        $task = Task::factory()->create(
            [
                'project_id' => $project->id
            ]
        );
        $this->post($project->path().'/tasks', compact($task));

        $this->get($project->path())
            ->assertSee($task->title);
    }
}
