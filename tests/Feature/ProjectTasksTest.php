<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{

    use RefreshDatabase, withFaker;


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

    /** @test */
    public function validate_task_title()
    {
        $this->actingAs(User::factory()->create());

        /** @var Project $project */
        $project = \Auth::user()->projects()->create(
            Project::factory()->raw()
        );

        $attributes = Task::factory()->raw([
            'title' => '',
            'project_id' => $project->id
        ]);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_task_description()
    {
        $this->actingAs(User::factory()->create());

        /** @var Project $project */
        $project = \Auth::user()->projects()->create(
            Project::factory()->raw()
        );

        $attributes = Task::factory()->raw([
            'description' => '',
            'project_id' => $project->id
        ]);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('description');
    }
}
