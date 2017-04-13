<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AboWorkerTest extends TestCase {

    protected $abo;
    protected $mock;

    public function setUp()
    {
        parent::setUp();

        $this->abo = new \App\Droit\User\Worker\AboWorker(\App::make('App\Droit\User\Repo\UserInterface'));

        $this->mock = Mockery::mock('App\Droit\User\Repo\UserInterface');
        $this->app->instance('App\Droit\User\Repo\UserInterface', $this->mock);
    }

    public function tearDown(){

        Mockery::close();

        $delete = new \App\Droit\User\Entities\User();

        $delete::where('numero', '=', 2000)->delete();
    }

	/**
	 * @return void
	 */
	public function testGetAllUsers()
	{
        //$users = $this->abo->allAbos();

       // $this->assertTrue(!empty($users));
	}

    /**
     * @return void
     */
    public function testGetOneUser()
    {
        //$user = $this->abo->getUser(188);
        //$this->assertTrue(!empty($user));
    }

    public function testCreateAccountAndAbo()
    {
        $input = [
            'numero' => 2000,
            'email'  => 'clesch@bluewin.ch',
            'name'   => 'Cathy Leschaud'
        ];

        $this->abo->account = $input;

        $expect = new App\Droit\User\Entities\User;
        $expect->email  = 'clesch@bluewin.ch';
        $expect->name   = 'Cathy Leschaud';
        $expect->numero = 2000;

        $user = $this->abo->createAccountAndAbo(2000);

        $this->assertEquals($expect->email, $user->email);
        $this->assertEquals($expect->numero, $user->numero);

    }

    public function testArrayDiff()
    {
        $abos     = [1,2,3,4,5];
        $accounts = [2,3,4,5];

        $actual = array_diff($abos,$accounts);

        $this->assertEquals($actual,[1]);
    }

    public function testArrayDiffEmpty()
    {
        $abos     = [1,2,3,4,5];
        $accounts = [1,2,3,4,5];

        $actual = array_diff($abos,$accounts);

        $this->assertEquals($actual,[]);
    }

    public function testNumeroFromFacture()
    {
        $facture = 'RJN-188-2014';

        $numero  = $this->abo->numeroFromFacture($facture);

        $this->assertEquals($numero,188);
    }

    public function testNumeroFromFactureFalse()
    {
        $facture = 'RJN-188';

        $numero  = $this->abo->numeroFromFacture($facture);

        $this->assertFalse($numero);
    }

}
