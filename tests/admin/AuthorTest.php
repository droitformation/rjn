<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorTest extends TestCase {

    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Author\Repo\AuthorInterface');
        $this->app->instance('App\Droit\Author\Repo\AuthorInterface', $this->mock);

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
	public function testAuthorindex()
	{

        $this->mock->shouldReceive('getAll')->once()->andReturn(new Illuminate\Database\Eloquent\Collection);
        $response = $this->call('GET', '/admin/author');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('authors');
	}

    /**
     *
     * @return void
     */
    public function testAuthorCreate()
    {

        $response = $this->call('GET', '/admin/author/create');
        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testAuthorStore()
    {
        $input = [
            'first_name' => 'Cindy',
            'last_name'  => 'Leschaud',
            'occupation' => 'Web developpeur'
        ];

        $expect = new App\Droit\Author\Entities\Author;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/author', $input);

        $this->assertRedirectedTo('admin/author/1');

    }


    /**
     *
     * @return void
     */
    public function testAuthorEdit()
    {

        $input = [
            'id'         => 1,
            'first_name' => 'Cindy',
            'last_name'  => 'Leschaud',
            'occupation' => 'Webmaster'
        ];

        $expect = new App\Droit\Author\Entities\Author;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/author/1', $input);

        $this->assertRedirectedTo('admin/author/1');

    }

    /**
     *
     * @return void
     */
    public function testAuthorDelete()
    {

        $this->mock->shouldReceive('delete')->once()->andReturn(true);

        $response = $this->call('DELETE', '/admin/author/1');

        $this->assertRedirectedTo('admin/author');

    }

}
