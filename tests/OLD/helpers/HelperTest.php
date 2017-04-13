<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Droit\Doctrine\Entities\Doctrine as Doctrine;

class HelperTest extends TestCase {

    protected $helper;
    protected $domains;

    public function __construct()
    {
        parent::setUp();

       /* $this->helper = new \App\Droit\Helper\Helper;

        League\FactoryMuffin\Facade::define('Doctrine', array(
            'domain_id'  => '1',          // Set the foo attribute to a random word
            'titre'      => 'sentence', // Set the name attribute to a random sentence
        ));

        $domain = \App::make('App\Droit\Domain\Repo\DomainInterface');

        $this->domains = $domain->getAll(1)->lists('id')->all();*/

    }

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testPrepareDisposition()
	{
        $article     = 'Art. 3';
        $disposition = 'Al. 1; Al. 2 | let. d';

        $prepare = $this->helper->prepareDisposition($article,$disposition);
        $expect  = [
            'Art. 3' => [
                'Al. 1' ,
                'Al. 2 let. d'
            ]
        ];

        $this->assertEquals($expect, $prepare);
	}

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSearchSubdivision()
    {

        $disposition = 'Al. 2 | let. d';

        $prepare = $this->helper->searchSubdivision($disposition);

        $expect  = 'Al. 2 let. d';

        $this->assertEquals($expect, $prepare);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSearchSubdivisionNoPipe()
    {

        $disposition = 'al. 2';

        $prepare = $this->helper->searchSubdivision($disposition);

        $expect  = 'al. 2';

        $this->assertEquals($expect, $prepare);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testParamsInString()
    {

        $params = [
            [
                'alinea'  => '1',
                'lettre'  => 'd',
                'chiffre' => null
            ],
            [
                'alinea'  => '2',
                'lettre'  => null,
                'chiffre' => null
            ],
            [
                'alinea'  => '3',
                'lettre'  => null,
                'chiffre' => 1
            ]
        ];

        $expect  = [
            'al. 1 let. d',
            'al. 2',
            'al. 3 ch. 1'
        ];

        foreach($params as $i => $param)
        {
            $prepare = $this->helper->convertSearchParams($param);
            $this->assertEquals($expect[$i], $prepare);
        }
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testParamsInStringOne()
    {

        $params = [
            'alinea'  => '2',
            'lettre'  => null,
            'chiffre' => null
        ];

        $expect  = 'al. 2';

        $prepare = $this->helper->convertSearchParams($params);
        $this->assertEquals($expect, $prepare);

    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testConvertDispositionPages()
    {
        $data = [ 'sub' =>
            [
                'alinea'    => ['1','',''],
                'lettre'    => ['','b',''],
                'chiffre'   => [3,4,''],
                'page'      => [115,115,0],
                'volume_id' => [5,5,'']
            ]
        ];

        $expect = [
            ['alinea' => '1','lettre' => '','chiffre' => '3','page' => '115','volume_id' => '5'],
            ['alinea' => '','lettre' => 'b','chiffre' => '4','page' => '115','volume_id' => '5']
        ];

        $prepare = $this->helper->convertDispositionPages($data);
        $this->assertEquals($expect, $prepare);

    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testDispatchDisposition()
    {
        $disposition = 'Al. 1; Al. 2 | let. d';

        $prepare = $this->helper->dispatchInArrayDisposition($disposition);
        $expect  = [
             ['aliena' => '1'],
             ['aliena' => '2', 'lettre' => 'd']
        ];

        //$this->assertEquals($expect, $prepare);
    }


    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testReplaceDelimiter()
    {
        $disposition = 'let. d';
        $prepare = $this->helper->findTypeDivision($disposition);
        $expect  = ['lettre' => 'd'];

        $this->assertEquals($expect, $prepare);

        $disposition2 = 'Al. 3';
        $prepare2 = $this->helper->findTypeDivision($disposition2);
        $expect2  = ['alinea' => '3'];

        $this->assertEquals($expect2, $prepare2);

        $disposition3 = 'ch 3';
        $prepare3 = $this->helper->findTypeDivision($disposition3);
        $expect3  = ['chiffre' => '3'];

        $this->assertEquals($expect3, $prepare3);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testDispatchDomains()
    {

        $doctrine            = new App\Droit\Doctrine\Entities\Doctrine;
        $doctrine2           = new App\Droit\Doctrine\Entities\Doctrine;
        $doctrine3           = new App\Droit\Doctrine\Entities\Doctrine;
        $doctrine4           = new App\Droit\Doctrine\Entities\Doctrine;

        $doctrine->domain_id  = 7;
        $doctrine->volume_id  = 1;

        $doctrine2->domain_id = 9;
        $doctrine2->volume_id = 2;

        $doctrine3->domain_id = 9;
        $doctrine3->volume_id = 3;

        $doctrine4->domain_id = 9;
        $doctrine4->volume_id = 1;

        $collection = new Illuminate\Database\Eloquent\Collection([$doctrine2,$doctrine, $doctrine3, $doctrine4]);

        $prepare = $this->helper->dispatchDomaine($collection,$this->domains);

        $expect  = [
            7 => [ 1 => [ $doctrine] ],
            9 => [ 3 => [ $doctrine3 ], 2 =>[ $doctrine2 ] , 1 =>[ $doctrine4 ]]
        ];

        $this->assertEquals($expect, $prepare);
    }

}
