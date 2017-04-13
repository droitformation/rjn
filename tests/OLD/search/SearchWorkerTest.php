<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Droit\Service\Worker\SearchWorker;

class SearchWorkerTest extends TestCase {

    protected $worker;
    protected $stub;
    protected $dispo;
    protected $doctrine;
    protected $chronique;

    public function setUp()
    {

        $this->refreshApplication();

        $this->doctrine = Mockery::mock('App\Droit\Doctrine\Repo\DoctrineInterface');
        $this->app->instance('App\Droit\Doctrine\Repo\DoctrineInterface', $this->doctrine);

        $this->chronique = Mockery::mock('App\Droit\Chronique\Repo\ChroniqueInterface');
        $this->app->instance('App\Droit\Chronique\Repo\ChroniqueInterface', $this->chronique);

        $user = App\Droit\User\Entities\User::find(1);
        $this->actingAs($user);

        $this->worker = new App\Droit\Service\Worker\SearchWorker();

        $this->dispo  = \App::make('App\Droit\Disposition\Entities\Disposition');

        $this->stub   = $this->dispo->where('id','=',517)->with('disposition_pages')->get();
    }

    /**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testSearchParamsInDisposition()
	{
        $values = ['alinea' => '4', 'lettre' => 'c'];
        $params = ['alinea' => '4', 'lettre' => 'c'];

        $data   = $this->worker->find($values,$params);

        $this->assertEquals(true, $data);
	}

    /**
     * A test
     *
     * @return void
     */
    public function testSearchOneContentSimple()
    {
        $term    = 'CACIV.2012.48';
        $content = 'doctrine';
        $search_type = 'searchSimple';

        $expect = new Illuminate\Database\Eloquent\Collection(['id'=> 1, 'name' => 'cindy']);

        $this->doctrine->shouldReceive('searchSimple')->once()->andReturn($expect);

        $result = $this->worker->processSimpleSearch($term,$content,$search_type);

        $this->assertEquals($expect, $result);
    }

    /**
     * A test
     *
     * @return void
     */
    public function testSearchMultipleContentSimple()
    {
        $term    = 'CACIV.2012.48';
        $content = ['doctrine','chronique'];
        $search_type = 'searchSimple';

        $doctrine     = new App\Droit\Doctrine\Entities\Doctrine;
        $doctrine->id = 1;
        $doctrine->titre = 'cindy';

        $chronique     = new App\Droit\Chronique\Entities\Chronique;
        $chronique->id = 2;
        $chronique->titre = 'celine';

        $one = new Illuminate\Database\Eloquent\Collection([$doctrine]);
        $two = new Illuminate\Database\Eloquent\Collection([$chronique]);

        $expect['doctrine']  = $one;
        $expect['chronique'] = $two;

        $this->doctrine->shouldReceive('searchSimple')->once()->andReturn($one);
        $this->chronique->shouldReceive('searchSimple')->once()->andReturn($two);

        $result = $this->worker->processSimpleSearch($term,$content,$search_type);

        $this->assertEquals($expect, $result);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testConvertDisposition()
    {
        $values = (object) ['alinea' => '4', 'lettre' => 'c'];
        $params = ['alinea' => '4', 'lettre' => 'c'];

        $data   = $this->worker->convertToArray($values);

        $this->assertEquals($params, $data);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSearch()
    {
        $params = ['alinea' => '1', 'lettre' => 'c'];
        $data   = $this->worker->search($this->stub,$params);
        $this->assertEquals(517, $data->first()->id);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPrepapreTerms()
    {
        $terms  = 'Cour civile';
        $actual = $this->worker->prepareTerms($terms);
        $expect = ['complex' => '+Cour +civile'];

        $this->assertEquals($expect, $actual);
    }

    /**
     *
     * @return void
     */
    public function testPrepapreTermsComplex()
    {
        $terms  = 'CACIV.2012.48';
        $actual = $this->worker->prepareTerms($terms);
        $expect = ['simple' => 'CACIV.2012.48'];

        $this->assertEquals($expect, $actual);
    }

    /**
     *
     * @return void
     */
    public function testPrepapreTermsQuotes()
    {
        $terms  = '"ATF 116 II 209" Droit civil';
        $actual = $this->worker->termInQuotes($terms);
        $expect = [
            ['simple' => 'ATF 116 II 209'],
            ['simple' => 'Droit'],
            ['simple' => 'civil']
        ];

        $this->assertEquals($expect, $actual);

    }

}
