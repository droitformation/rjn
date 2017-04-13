<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CodeTest extends TestCase
{
    public function testNotLoggued()
    {
        $response = $this->get('matiere');
        $response->assertRedirect('login');
    }

    public function testUserWithNoValidCode()
    {
        $user = factory(\App\Droit\User\Entities\User::class)->create();
        $code = factory(\App\Droit\Code\Entities\Code::class)->create([
            'user_id'  => $user->id,
            'valid_at' => \Carbon\Carbon::yesterday()->toDateString(),
        ]);

        $this->actingAs($user);

        $response = $this->get( 'matiere');
        $response->assertRedirect('activate');
    }

    public function testUserWithValidCode()
    {
        $arret = factory(\App\Droit\Arret\Entities\Arret::class)->create();
        $user  = factory(\App\Droit\User\Entities\User::class)->create();
        $code  = factory(\App\Droit\Code\Entities\Code::class)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $this->get('arret/'.$arret)->assertStatus(200);
    }
}
