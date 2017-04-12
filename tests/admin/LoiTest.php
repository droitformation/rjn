<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoiTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Loi\Repo\LoiInterface');
        $this->app->instance('App\Droit\Loi\Repo\LoiInterface', $this->mock);

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
	public function testLoiindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/loi');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('lois');
	}

    /**
     *
     * @return void
     */
    public function testLoiCreate()
    {

        $response = $this->call('GET', '/admin/loi/create');

        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testLoiStore()
    {
        $input = [
            'name'  => 'nom',
            'sigle' => 'sigle',
            'droit' => 1
        ];

        $expect = new App\Droit\Loi\Entities\Loi;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/loi', $input);

        $this->assertRedirectedTo('admin/loi/1');

    }


    /**
     *
     * @return void
     */
    public function testLoiEdit()
    {

        $input = [
            'id'      => 1,
            'name'  => 'nom',
            'sigle' => 'sigle',
            'droit' => 1
        ];

        $expect = new App\Droit\Loi\Entities\Loi;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/loi/1', $input);

        $this->assertRedirectedTo('admin/loi/1');

    }


    /**
     *
     * @return void
     */
    public function testLoiDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/loi/1');

        $this->assertRedirectedTo('admin/loi');

    }

}
