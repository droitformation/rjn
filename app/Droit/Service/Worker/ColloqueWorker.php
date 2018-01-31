<?php namespace App\Droit\Service\Worker;

class ColloqueWorker{

    protected $custom;
    protected $client;
    protected $base_url;

    /* Inject dependencies */
    public function __construct()
    {
        $this->custom  = new \App\Droit\Helper\Helper;
        $this->client  = new \GuzzleHttp\Client([ 'verify' => false ]);

        $environment = app()->environment();
        $this->base_url = ($environment == 'local' ? 'https://shop.local' : 'https://www.publications-droit.ch');
    }

    public function getColloques(){

        $response   = $this->client->get($this->base_url.'/event?name=RJN');
        $data       = json_decode($response->getBody(), true);

        $collection = new \Illuminate\Support\Collection($data['data']);

        return $collection;
    }

    public function getArchives(){

        $response   = $this->client->get($this->base_url.'/event?name=RJN&archive=1');
        $data       = json_decode($response->getBody(), true);

        $collection = new \Illuminate\Support\Collection($data['data']);

        return $collection;
    }

    public function organiseYear($data){

        if(!empty($data))
        {
            foreach($data as $colloque)
            {
                $date = $colloque['event']['start_at'];
                $year = \Carbon\Carbon::parse($date);
                $years[$year->year] = $colloque;
            }

            ksort($years);

            return $years;
        }

        return [];
    }
}