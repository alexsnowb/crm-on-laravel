<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function has_path()
    {
        $project = Project::factory()->create();
        $this->assertEquals('/projects/'. $project->id, $project->path());
    }
}
