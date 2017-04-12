<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DoctrineTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Doctrine\Repo\DoctrineInterface');
        $this->app->instance('App\Droit\Doctrine\Repo\DoctrineInterface', $this->mock);

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
	public function testDoctrineindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/article');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('articles');
	}

    /**
     *
     * @return void
     */
    public function testDoctrineCreate()
    {

        $response = $this->call('GET', '/admin/article/create');
        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testDoctrineStore()
    {

        $input = [
            'pid'           => 1,
            'titre'         => 'titre',
            'volume_id'     => 5,
            'domain_id'     => 1,
            'page'          => 100,
            'pub_date'      => '2000-10-01',
            'article'       => 'article',
            'bibliographie' => '',
            'notes'         => '',
            'citations'     => ''
        ];

        $expect = new App\Droit\Doctrine\Entities\Doctrine;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/article', $input);

        $this->assertRedirectedTo('admin/article/1');

    }


    /**
     *
     * @return void
     */
    public function testDoctrineEdit()
    {

        $input = [
            'id'            => 1,
            'titre'         => 'titre',
            'volume_id'     => 5,
            'domain_id'     => 1,
            'page'          => 100,
            'pub_date'      => '2000-10-01',
            'article'       => 'article',
            'bibliographie' => '',
            'notes'         => '',
            'citations'     => ''
        ];

        $expect = new App\Droit\Doctrine\Entities\Doctrine;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/article/1', $input);

        $this->assertRedirectedTo('admin/article/1');

    }

    /**
     *
     * @return void
     */
    public function testDoctrineDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/article/1');

        $this->assertRedirectedTo('admin/article');

    }

}
