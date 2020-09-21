<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;;

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
}
