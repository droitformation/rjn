<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MatiereTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Matiere\Repo\MatiereInterface');
        $this->app->instance('App\Droit\Matiere\Repo\MatiereInterface', $this->mock);

        $user = App\Droit\User\Entities\User::find(1);
        $this->be($user);

    }

    public function tearDown(){

        Mockery::close();
    }

	/**
	 *
	 * @return void
	 */
	public function testMatiereindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/matiere');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('matieres');
	}

    /**
     *
     * @return void
     */
    public function testMatiereCreate()
    {

        $response = $this->call('GET', '/admin/matiere/create');

        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testMatiereStore()
    {

        $input = [
            'title' => 'title',
        ];

        $expect = new App\Droit\Matiere\Entities\Matiere;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/matiere', $input);

        $this->assertRedirectedTo('admin/matiere/1');

    }


    /**
     *
     * @return void
     */
    public function testMatiereEdit()
    {

        $input = [
            'id'    => 1,
            'title' => 'title',
        ];

        $expect = new App\Droit\Matiere\Entities\Matiere;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/matiere/1', $input);

        $this->assertRedirectedTo('admin/matiere/1');

    }


    /**
     *
     * @return void
     */
    public function testMatiereDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/matiere/1');

        $this->assertRedirectedTo('admin/matiere');

    }

}
