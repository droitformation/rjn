<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Droit\Service\Worker\PageWorker;
use App\Droit\Doctrine\Repo\DoctrineEloquent;
use App\Droit\Chronique\Repo\ChroniqueEloquent;
use App\Droit\Arret\Repo\ArretEloquent;
use App\Droit\Arret\Entities\Arret as Arret;
use App\Droit\Doctrine\Entities\Doctrine as Doctrine;
use App\Droit\Chronique\Entities\Chronique as Chronique;

class FindPageTest extends TestCase {

    protected $worker;

    public function __construct()
    {
        $this->worker = new PageWorker(new DoctrineEloquent(new Doctrine), new ChroniqueEloquent(new Chronique), new ArretEloquent(new Arret));
    }

	public function testGetPage()
	{
        $calcul = $this->worker->calcul(165,5);

		$this->assertEquals(['content' => 'arret', 'id' => 13 ], $calcul);
	}

}
