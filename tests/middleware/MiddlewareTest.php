<?php


use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MiddlewareTest extends TestCase {

	public function testNotLoggued()
	{
        $response = $this->call('GET', '/matiere');

		$this->assertRedirectedTo('/auth/login');
        $this->assertSessionHas('status', 'warning');
	}

    public function testAdminUserLoggued()
    {
        $user = App\Droit\User\Entities\User::find(1);
        $this->actingAs($user);

        $this->visit('/matiere')->see('Matières');
    }

    public function testUserWithNoValidCode()
    {
        $user = App\Droit\User\Entities\User::find(201);
        $this->actingAs($user);

        $response = $this->call('GET', '/matiere');

        $this->assertRedirectedTo('/auth/activate');
        $this->assertSessionHas('status', 'warning');
    }

    public function testUserWithValidCode()
    {
        $user = App\Droit\User\Entities\User::find(204);
        $this->actingAs($user);

        $this->visit('/matiere')->see('Matières');
    }
}
