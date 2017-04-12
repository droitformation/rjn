<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DispositionTest extends TestCase {

    protected $mock;
    protected $loi;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Disposition\Repo\DispositionInterface');
        $this->app->instance('App\Droit\Disposition\Repo\DispositionInterface', $this->mock);

        $this->loi = Mockery::mock('App\Droit\Loi\Repo\LoiInterface');
        $this->app->instance('App\Droit\Loi\Repo\LoiInterface', $this->loi);

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
	public function testDispositionindex()
	{

        $this->loi->shouldReceive('find')->with(47)->once()->andReturn(new App\Droit\Loi\Entities\Loi);
        $response = $this->call('GET', '/admin/disposition/loi/47');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('dispositions');
	}

    /**
     *
     * @return void
     */
    public function testDispositionCreate()
    {

        $response = $this->call('GET', '/admin/disposition/create/47');
        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testDispositionAddPages()
    {

        $data = [ 'id' => 1, 'sub' =>
            [
                'alinea'    => ['1','',''],
                'lettre'    => ['','b',''],
                'chiffre'   => [3,4,''],
                'page'      => [115,115,0],
                'volume_id' => [5,5,'']
            ]
        ];

        $expect = new App\Droit\Disposition\Entities\Disposition;
        $expect->id = 1;

        $this->mock->shouldReceive('find')->with(1)->once()->andReturn($expect);

        $response = $this->call('POST', 'admin/disposition/addpage', $data);

        $this->assertRedirectedTo('admin/disposition/page/1');

    }

    /**
     *
     * @return void
     */
    public function testDispositionStore()
    {
        $input = [
            'loi_id'      => 1,
            'cote'        => '',
            'page'        => '',
            'content'     => '',
            'subdivision' => ''
        ];

        $expect = new App\Droit\Disposition\Entities\Disposition;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/disposition', $input);

        $this->assertRedirectedTo('admin/disposition/1');

    }

    /**
     *
     * @return void
     */
    public function testDispositionEdit()
    {
        $input = [
            'id'          => 1,
            'loi_id'      => 1,
            'cote'        => '',
            'page'        => '',
            'content'     => '',
            'subdivision' => ''
        ];

        $expect = new App\Droit\Disposition\Entities\Disposition;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/disposition/1', $input);

        $this->assertRedirectedTo('admin/disposition/1');

    }

    /**
     *
     * @return void
     */
    public function testDispositionDelete()
    {
        $expect = new App\Droit\Disposition\Entities\Disposition;
        $expect->loi_id = 47;

        $this->mock->shouldReceive('find')->with(282)->once()->andReturn($expect);
        $this->mock->shouldReceive('delete')->with(282)->once();

        $response = $this->call('DELETE', '/admin/disposition/282');

        $this->assertRedirectedTo('admin/disposition/loi/47');

    }

}
