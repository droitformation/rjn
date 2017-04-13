<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Droit\Service\Worker\LoiWorker;

class ConvertDispositionTest extends TestCase {

    protected $worker;
    protected $stub;
    protected $stub2;

    public function setUp()
    {
        $this->createApplication();

        $this->worker = new LoiWorker(
            \App::make('App\Droit\Loi\Repo\LoiInterface'),
            \App::make('App\Droit\Disposition\Repo\DispositionInterface'),
            \App::make('App\Droit\Matiere\Repo\MatiereInterface'),
            \App::make('App\Droit\Matiere\Repo\MatiereNoteInterface')
        );

        $this->stub  = (object) ['cote' => 'Art. 115', 'subdivision' => 'al. 1 | let. d; al. 2'];
        $this->stub2 = (object) ['cote' => 'Art. 115', 'subdivision' => 'Titre final'];

    }

    /**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testConvertDisposition()
	{
        $data = $this->worker->convertDispositions($this->stub);

        $expect = [
            ['alinea' => '1', 'lettre' => 'd'],
            ['alinea' => '2']
        ];

        $this->assertEquals($expect, $data);
	}

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testConvertDispositionText()
    {
        $data = $this->worker->convertDispositions($this->stub2);

        $expect = [
            ['Titre final']
        ];

        $this->assertEquals($expect, $data);
    }
}
