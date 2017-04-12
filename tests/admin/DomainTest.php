<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DomainTest extends TestCase {
    
    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Domain\Repo\DomainInterface');
        $this->app->instance('App\Droit\Domain\Repo\DomainInterface', $this->mock);

        $user = App\Droit\User\Entities\User::find(1);
        $this->actingAs($user);

    }

    public function tearDown(){

        Mockery::close();
    }

	/**
	 *
	 * @return void
	 */
	public function testDomainindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/domain');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('domains');
	}

    /**
     *
     * @return void
     */
    public function testDomainCreate()
    {

        $response = $this->call('GET', '/admin/domain/create');

        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testDomainStore()
    {

        $input = [
            'title'   => 'titre',
            'droit'   => 1,
            'sorting' => 1
        ];

        $expect = new App\Droit\Domain\Entities\Domain;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/domain', $input);

        $this->assertRedirectedTo('admin/domain/1');

    }


    /**
     *
     * @return void
     */
    public function testDomainEdit()
    {

        $input = [
            'id'      => 1,
            'title'   => 'titre',
            'droit'   => 1,
            'sorting' => 1
        ];

        $expect = new App\Droit\Domain\Entities\Domain;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/domain/1', $input);

        $this->assertRedirectedTo('admin/domain/1');

    }


    /**
     *
     * @return void
     */
    public function testDomainDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/domain/1');

        $this->assertRedirectedTo('admin/domain');

    }

}
