<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontendTest extends TestCase
{
    public function testHomepage()
    {
        $user = \App\Droit\User\Entities\User::find(1);
        $this->actingAs($user);

        $this->get('/')->assertStatus(200);
        $this->get('jurisprudence')->assertStatus(200);
        $this->get('doctrine')->assertStatus(200);
        $this->get('matiere')->assertStatus(200);
        $this->get('lois')->assertStatus(200);
        $this->get('historique')->assertStatus(200);
        $this->get('contact')->assertStatus(200);
    }

    public function testNotLoggedHomepage()
    {
        $this->get('/')->assertStatus(200);
        $this->get('jurisprudence')->assertStatus(302);
        $this->get('doctrine')->assertStatus(302);
        $this->get('matiere')->assertStatus(302);
        $this->get('lois')->assertStatus(302);
        $this->get('historique')->assertStatus(200);
        $this->get('contact')->assertStatus(200);
    }
}
