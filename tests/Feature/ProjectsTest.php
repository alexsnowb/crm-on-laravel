<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use withFaker, RefreshDatabase;

//    /** @test */
//    public function can_user_registration(){
//        $user = User::factory()->create();
//        $this->assertDatabaseHas('users', ['id' => $user->id, 'email'=> $user->email]);
//    }

    /** @test **/
    public function can_user_create_project()
    {
        $attributes = [
            'title'         => $this->faker->sentence,
            'description'   => $this->faker->paragraph
        ];

        $this->actingAs(User::factory()->create());

        $this->post('/dashboard/projects', $attributes)->assertRedirect('/dashboard/projects');
        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/dashboard/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function validate_project_title()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/dashboard/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_project_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/dashboard/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function only_auth_users_can_create_project()
    {
        $attributes = Project::factory()->raw();
        $this->post('/dashboard/projects', $attributes)->assertRedirect('/login');
    }

    /** @test **/
    public function can_user_view_project()
    {
        $this->actingAs(User::factory()->create());


        $project = Project::factory()->create();

        $this->get('/dashboard/projects/'. $project->id)
            ->assertStatus(200)
            ->assertSee($project->title)
            ->assertSee($project->description);

    }
}
