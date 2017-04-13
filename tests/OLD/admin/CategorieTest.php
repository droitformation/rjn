<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategorieTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Categorie\Repo\CategorieInterface');
        $this->app->instance('App\Droit\Categorie\Repo\CategorieInterface', $this->mock);

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
	public function testCategorieindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/categorie');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('categories');
	}

    /**
     *
     * @return void
     */
    public function testCategorieCreate()
    {

        $response = $this->call('GET', '/admin/categorie/create');
        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testCategorieStore()
    {
        $input = [
            'pid'        => 1,
            'domain_id'  => 1,
            'title'      => 'title',
            'image'      => ''
        ];

        $expect = new App\Droit\Categorie\Entities\Categorie;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/categorie', $input);

        $this->assertRedirectedTo('admin/categorie/1');

    }


    /**
     *
     * @return void
     */
    public function testCategorieEdit()
    {

        $input = [
            'id'         => 1,
            'domain_id'  => 1,
            'title'      => 'title',
            'image'      => ''
        ];

        $expect = new App\Droit\Categorie\Entities\Categorie;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT','admin/categorie/1', $input);

        $this->assertRedirectedTo('admin/categorie/1');

    }


    /**
     *
     * @return void
     */
    public function testCategorieDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/categorie/1');

        $this->assertRedirectedTo('admin/categorie');

    }

}
