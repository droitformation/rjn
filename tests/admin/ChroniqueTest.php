<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChroniqueTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Chronique\Repo\ChroniqueInterface');
        $this->app->instance('App\Droit\Chronique\Repo\ChroniqueInterface', $this->mock);

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
	public function testChroniqueindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/chronique');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('chroniques');
	}

    /**
     *
     * @return void
     */
    public function testChroniqueCreate()
    {

        $response = $this->call('GET', 'admin/chronique/create');
        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testChroniqueStore()
    {

        $input = [
            'pid'       => 1,
            'domain_id' => 1,
            'sorting'   => 1,
            'volume_id' => 5,
            'page'      => 100,
            'pub_date'  => '2000-10-01',
            'titre'     => 'titre',
            'faits'     => 'faites'
        ];

        $expect = new App\Droit\Chronique\Entities\Chronique;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/chronique', $input);

        $this->assertRedirectedTo('admin/chronique/1');

    }


    /**
     *
     * @return void
     */
    public function testChroniqueEdit()
    {

        $input = [
            'id'        => 1,
            'domain_id' => 1,
            'sorting'   => 1,
            'volume_id' => 5,
            'page'      => 100,
            'pub_date'  => '2000-10-01',
            'titre'     => 'titre',
            'faits'     => 'faites'
        ];

        $expect = new App\Droit\Chronique\Entities\Chronique;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/chronique/1', $input);

        $this->assertRedirectedTo('admin/chronique/1');

    }

    /**
     *
     * @return void
     */
    public function testChroniqueDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/chronique/1');

        $this->assertRedirectedTo('admin/chronique');

    }

}
