<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['frontend.*'], 'App\Http\ViewComposers\RjnComposer');
        view()->composer(['admin.*'], 'App\Http\ViewComposers\AdminComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUserService();
        $this->registerArretService();
        $this->registerGroupeService();
        $this->registerDoctrineService();
        $this->registerDomainService();
        $this->registerCategorieService();
        $this->registerRjnService();
        $this->registerMatiereService();
        $this->registerMatiereNoteService();
        $this->registerLoiService();
        $this->registerDispositionService();
        $this->registerChroniqueService();
        $this->registerAuthorService();
        $this->registerPageService();
        $this->registerCritiqueService();
        $this->registerCodeService();
        $this->registerCodeWorkerService();
    }

    /**
     * Auth
     */
    protected function registerUserService(){

        $this->app->singleton('App\Droit\User\Repo\UserInterface', function()
        {
            return new \App\Droit\User\Repo\UserEloquent( new \App\Droit\User\Entities\User );
        });
    }

    /**
     * Arret
     */
    protected function registerArretService(){

        $this->app->singleton('App\Droit\Arret\Repo\ArretInterface', function()
        {
            return new \App\Droit\Arret\Repo\ArretEloquent( new \App\Droit\Arret\Entities\Arret );
        });
    }

    /**
     * Groupe
     */
    protected function registerGroupeService(){

        $this->app->singleton('App\Droit\Groupe\Repo\GroupeInterface', function()
        {
            return new \App\Droit\Groupe\Repo\GroupeEloquent( new \App\Droit\Groupe\Entities\Groupe );
        });
    }

    /**
     * Doctrine
     */
    protected function registerDoctrineService(){

        $this->app->singleton('App\Droit\Doctrine\Repo\DoctrineInterface', function()
        {
            return new \App\Droit\Doctrine\Repo\DoctrineEloquent( new \App\Droit\Doctrine\Entities\Doctrine );
        });
    }

    /**
     * Domain
     */
    protected function registerDomainService(){

        $this->app->singleton('App\Droit\Domain\Repo\DomainInterface', function()
        {
            return new \App\Droit\Domain\Repo\DomainEloquent( new \App\Droit\Domain\Entities\Domain );
        });
    }

    /**
     * Categorie
     */
    protected function registerCategorieService(){

        $this->app->singleton('App\Droit\Categorie\Repo\CategorieInterface', function()
        {
            return new \App\Droit\Categorie\Repo\CategorieEloquent( new \App\Droit\Categorie\Entities\Categorie );
        });
    }

    /**
     * Rjn
     */
    protected function registerRjnService(){

        $this->app->singleton('App\Droit\Rjn\Repo\RjnInterface', function()
        {
            return new \App\Droit\Rjn\Repo\RjnEloquent( new \App\Droit\Rjn\Entities\Rjn );
        });
    }

    /**
     * Matiere
     */
    protected function registerMatiereService(){

        $this->app->singleton('App\Droit\Matiere\Repo\MatiereInterface', function()
        {
            return new \App\Droit\Matiere\Repo\MatiereEloquent( new \App\Droit\Matiere\Entities\Matiere );
        });
    }

    /**
     * Matiere note
     */
    protected function registerMatiereNoteService(){

        $this->app->singleton('App\Droit\Matiere\Repo\MatiereNoteInterface', function()
        {
            return new \App\Droit\Matiere\Repo\MatiereNoteEloquent( new \App\Droit\Matiere\Entities\Matiere_note );
        });
    }

    /**
     * Loi
     */
    protected function registerLoiService(){

        $this->app->singleton('App\Droit\Loi\Repo\LoiInterface', function()
        {
            return new \App\Droit\Loi\Repo\LoiEloquent( new \App\Droit\Loi\Entities\Loi );
        });
    }

    /**
     * Disposition
     */
    protected function registerDispositionService(){

        $this->app->singleton('App\Droit\Disposition\Repo\DispositionInterface', function()
        {
            return new \App\Droit\Disposition\Repo\DispositionEloquent( new \App\Droit\Disposition\Entities\Disposition );
        });
    }

    /**
     * Chronique
     */
    protected function registerChroniqueService(){

        $this->app->singleton('App\Droit\Chronique\Repo\ChroniqueInterface', function()
        {
            return new \App\Droit\Chronique\Repo\ChroniqueEloquent( new \App\Droit\Chronique\Entities\Chronique );
        });
    }

    /**
     * Author
     */
    protected function registerAuthorService(){

        $this->app->singleton('App\Droit\Author\Repo\AuthorInterface', function()
        {
            return new \App\Droit\Author\Repo\AuthorEloquent( new \App\Droit\Author\Entities\Author );
        });
    }


    /**
     * Critique
     */
    protected function registerCritiqueService(){

        $this->app->singleton('App\Droit\Critique\Repo\CritiqueInterface', function()
        {
            return new \App\Droit\Critique\Repo\CritiqueEloquent( new \App\Droit\Critique\Entities\Critique );
        });
    }


    /**
     * Code
     */
    protected function registerCodeService(){

        $this->app->singleton('App\Droit\Code\Repo\CodeInterface', function()
        {
            return new \App\Droit\Code\Repo\CodeEloquent( new \App\Droit\Code\Entities\Code );
        });
    }

    /**
     * CodeWorker
     */
    protected function registerCodeWorkerService(){

        $this->app->singleton('App\Droit\Code\Worker\CodeWorkerInterface', function()
        {
            return new \App\Droit\Code\Worker\CodeWorker(
                \App::make('App\Droit\Code\Repo\CodeInterface')
            );
        });
    }

    /**
     * Page worker
     */
    protected function registerPageService(){

        $this->app->singleton('App\Droit\Service\Worker\PageInterface', function()
        {
            return new \App\Droit\Service\Worker\PageWorker(
                \App::make('App\Droit\Doctrine\Repo\DoctrineInterface'),
                \App::make('App\Droit\Chronique\Repo\ChroniqueInterface'),
                \App::make('App\Droit\Arret\Repo\ArretInterface')
            );
        });
    }

}
