<?php

namespace Tests\Feature;

use App\Http\Livewire\Project\Create;
use App\Http\Livewire\Project\Index;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use withFaker, RefreshDatabase;

    /** @test **/
    public function can_user_create_project()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/dashboard/projects/create')
            ->assertStatus(200)
            ;

        $attributes = [
            'title'         => $this->faker->sentence,
            'description'   => $this->faker->paragraph
        ];

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

    /** @test */
    public function only_auth_users_can_view_project()
    {
        $attributes = Project::factory()->raw();
        $this->post('/dashboard/projects', $attributes)->assertRedirect('/login');
    }

    /** @test */
    public function guest_cannot_create_project()
    {
        $this->get('/dashboard/projects/create')->assertRedirect('/login');
        $attributes = Project::factory()->raw();
        $this->post('/dashboard/projects', $attributes)->assertRedirect('/login');
    }

    /** @test */
    public function guest_cannot_view_projects()
    {
        $this->get('/dashboard/projects')->assertRedirect('/login');
    }

    /** @test */
    public function guest_cannot_view_project()
    {
        $project = Project::factory()->create();
        $this->get($project->path())->assertRedirect('/login');
    }

    /** @test **/
    public function can_user_view_his_project()
    {

        $this->be(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertStatus(200)
            ->assertSee($project->title)
            ->assertSee($project->description)
            ->assertSee($project->owner->name)
        ;
    }

    /** @test **/
    public function cannot_auth_user_view_not_his_project()
    {

        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertStatus(403)
        ;

    }

    /** @test  */
    function is_redirected_to_posts_page_after_creation()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->make();

        Livewire::test(Create::class)
            ->set('project.title', $project->title)
            ->set('project.description', $project->description)
            ->call('createProject')
            ->assertRedirect('/dashboard/projects')
        ;

        $project->owner_id = auth()->user()->id;
        $this->assertDatabaseHas('projects', $project->toArray());
    }

    /** @test  */
    function can_paginate()
    {
        $this->actingAs(User::factory()->create());

        $projectList = Project::factory()
            ->count(21)
            ->create(['owner_id' => \Auth::id()]);

        Livewire::test(Index::class)
            ->call('gotoPage', '3')
            ->assertStatus(200)
            ->assertSee($projectList[0]->title)
            ->assertSee($projectList[0]->description)
            ->assertSee($projectList[0]->owner->name);
    }

    /** @test  */
    function can_search()
    {
        $this->actingAs(User::factory()->create());

        $projectList = Project::factory()
            ->count(21)
            ->create(['owner_id' => \Auth::id()]);

        Livewire::test(Index::class)
            ->set('searchTerm', $projectList[0]->title)
            ->assertSee($projectList[0]->title)
            ->assertSee($projectList[0]->description)
            ->assertSee($projectList[0]->owner->name);
    }

}
