<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArretTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->mock = Mockery::mock('App\Droit\Arret\Repo\ArretInterface');
        $this->app->instance('App\Droit\Arret\Repo\ArretInterface', $this->mock);

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
	public function testArretindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $this->visit('admin/arret');

        $this->assertViewHas('arrets');
	}

    /**
     *
     * @return void
     */
    public function testArretCreate()
    {

        $response = $this->call('GET', '/admin/arret/create');
        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testArretStore()
    {

        $input = [
            'designation' => 'titre',
            'sommaire'    => 'sommaire',
            'portee'      => 'portee',
            'faits'       => '',
            'volume_id'   => 5,
            'pid'         => 1,
            'domain_id'   => 1,
            'page'        => 12,
            'pub_date'    => '2011-12-01',
            'cotes'       => 'Art. 1'
        ];

        $expect = new App\Droit\Arret\Entities\Arret;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/arret', $input);

        $this->assertRedirectedTo('admin/arret/1');

    }


    /**
     *
     * @return void
     */
    public function testArretEdit()
    {

        $input = [
            'id'          => 1,
            'designation' => 'titre',
            'sommaire'    => 'sommaire',
            'portee'      => 'portee',
            'faits'       => '',
            'volume_id'   => 5,
            'pid'         => 1,
            'domain_id'   => 1,
            'page'        => 12,
            'pub_date'    => '2011-12-01',
            'cotes'       => 'Art. 1'
        ];

        $expect = new App\Droit\Arret\Entities\Arret;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/arret/1', $input);

        $this->assertRedirectedTo('admin/arret/1');

    }

    /**
     *
     * @return void
     */
    public function testArretDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/arret/1');

        $this->assertRedirectedTo('admin/arret');

    }

}
