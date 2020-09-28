<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function has_path()
    {
        $project = Project::factory()->create();
        $this->assertEquals('/dashboard/projects/'. $project->id, $project->path());
    }

    /** @test */
    public function belongs_to_owner()
    {
        $project = Project::factory()->create();
        $this->assertInstanceOf(User::class, $project->owner);
    }

    /** @test */
    public function can_add_task()
    {
        $project = Project::factory()->create();
        $task = Task::factory()->make(['project_id' => $project->id]);
        $project->tasks()->save($task);
        $this->assertCount(1, $project->tasks);
    }
}
