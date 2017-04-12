<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NoteTest extends TestCase {

    protected $mock;
    protected $mat;

    public function setUp()
    {
        parent::setUp();

        $this->refreshApplication();

        $this->mock = Mockery::mock('App\Droit\Matiere\Repo\MatiereNoteInterface');
        $this->app->instance('App\Droit\Matiere\Repo\MatiereNoteInterface', $this->mock);

        $this->mat = Mockery::mock('App\Droit\Matiere\Repo\MatiereInterface');
        $this->app->instance('App\Droit\Matiere\Repo\MatiereInterface', $this->mat);

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
	public function testNoteindex()
	{

        $this->mat->shouldReceive('find')->with(1)->once()->andReturn(new App\Droit\Matiere\Entities\Matiere);
        $response = $this->call('GET', '/admin/note/matiere/1');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertViewHas('notes');
        $this->assertViewHas('matiere_id');
	}

    /**
     *
     * @return void
     */
    public function testNoteCreate()
    {

        $response = $this->call('GET', '/admin/note/create/1');

        $this->assertEquals(200, $response->getStatusCode());

    }

    /**
     *
     * @return void
     */
    public function testNoteStore()
    {
        $input = [
            'matiere_id'     => 1,
            'content'        => 'content',
            'page'           => 100,
            'volume_id'      => 5,
            'domaine'        => 1,
            'confer_externe' => '',
            'confer_interne' => 'cf.'
        ];

        $expect = new App\Droit\Matiere\Entities\Matiere_note;
        $expect->id = 1;

        $this->mock->shouldReceive('create')->once()->with($input)->andReturn($expect);

        $response = $this->call('POST', 'admin/note', $input);

        $this->assertRedirectedTo('admin/note/1');

    }


    /**
     *
     * @return void
     */
    public function testNoteEdit()
    {
        $input = [
            'id'             => 1,
            'matiere_id'     => 1,
            'content'        => 'content',
            'page'           => 120,
            'volume_id'      => 5,
            'domaine'        => 1,
            'confer_externe' => '',
            'confer_interne' => 'cf.'
        ];

        $expect = new App\Droit\Matiere\Entities\Matiere;
        $expect->id = 1;

        $this->mock->shouldReceive('update')->once()->with($input)->andReturn($expect);

        $response = $this->call('PUT', 'admin/note/1', $input);

        $this->assertRedirectedTo('admin/note/1');

    }


    /**
     *
     * @return void
     */
    public function testNoteDelete()
    {

        $expect = new App\Droit\Matiere\Entities\Matiere_note;
        $expect->matiere_id = 1;

        $this->mock->shouldReceive('find')->with(1)->once()->andReturn($expect);
        $this->mock->shouldReceive('delete')->with(1)->once();

        $response = $this->call('DELETE', '/admin/note/1');

        $this->assertRedirectedTo('admin/note/matiere/1');

    }

}
