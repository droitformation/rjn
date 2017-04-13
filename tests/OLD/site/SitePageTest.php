<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class SitePageTest extends TestCase {

	/**
	 * Homepage
	 *
	 * @return void
	 */
	public function testHomepage()
	{
        $user = App\Droit\User\Entities\User::find(1);

        $this->actingAs($user)
            ->visit('/')
            ->see('RJN');
	}

    /**
     * Homepage
     *
     * @return void
     */
    public function testContact()
    {
        $response = $this->call('GET', 'contact');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Colloques
     *
     * @return void
     */
    public function testColloques()
    {
        $response = $this->call('GET', 'colloque');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Lois
     *
     * @return void
     */
    public function testLois()
    {
        $response = $this->call('GET', 'lois');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('lois');
    }

    /**
     * Matieres
     *
     * @return void
     */
    public function testMatieres()
    {
        $response = $this->call('GET', 'matiere');

        $this->assertViewHas('matieres');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Dispositions
     *
     * @return void
     */
    public function testDisposition()
    {
        $response = $this->call('GET', 'disposition/3');

        $this->assertViewHas('dispositions');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Chronique
     *
     * @return void
     */
    public function testChronique()
    {
        $response = $this->call('GET', 'chronique/1');

        $this->assertViewHas('chronique');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Article
     *
     * @return void
     */
    public function testArticle()
    {
        $response = $this->call('GET', 'article/2');

        $this->assertViewHas('article');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Article
     *
     * @return void
     */
    public function testArret()
    {
        $response = $this->call('GET', 'arret/2');

        $this->assertViewHas('arret');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
