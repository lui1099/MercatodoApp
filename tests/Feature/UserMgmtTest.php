<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;


class UserMgmtTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function UserCanBeDeleted()
    {
        //$this->withoutExceptionHandling();

        $users = User::factory()->count(1)->create();

        $user = User::first();
        $this->assertCount(1, User::all());

        $response = User::destroy($user->id);

        $this->assertCount(0, User::all());

    }


    /** @test */
    public function UserCanBeEdited()
    {
        //$this->withoutExceptionHandling();

        $users = User::factory()->count(1)->create();

        $user = User::first();
        $this->assertCount(1, User::all());

        $response = $this->get(route('users.edit', $user));
        $response -> assertOk();
        $response -> assertViewIs('users.useredit');
        $response -> assertViewHas('user');



    }

    /** @test */
    public function UserCanBeUpdated()
    {
        //$this->withoutExceptionHandling();

        $data = [
            'name' => 'PRUEBA',
            'email' => 'prueba@prueba.com',
        ];
        $users = User::factory()->count(1)->create();

        $user = User::first();
        $this->assertCount(1, User::all());

        $response = $this->patch(route('users.update', $user), $data);
//        $response->assertRedirect();

        $user = $user->refresh();
        $this->assertEquals($data['name'], $user->name);

    }

    /** @test */
    public function UserCanBeBanned()
    {
        $users = User::factory()->count(1)->create();
        $user = User::first();
        $this->assertCount(1, User::all());

        $data = [1];

        $response = $this->patch(route('users.ban', $user->is_banned));
    //    $response->assertRedirect();
        $user = $user->refresh();
        $this->assertEquals($data[0], $user->is_banned);


    }

}
