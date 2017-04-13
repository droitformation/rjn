<?php namespace App\Droit\Service\Worker;

class SearchWorker{

    protected $arret;

    public function __construct()
    {
        $this->arret     = \App::make('App\Droit\Arret\Repo\ArretInterface');
        $this->matiere   = \App::make('App\Droit\Matiere\Repo\MatiereInterface');
        $this->loi       = \App::make('App\Droit\Loi\Repo\LoiInterface');
        $this->chronique = \App::make('App\Droit\Chronique\Repo\ChroniqueInterface');
        $this->doctrine  = \App::make('App\Droit\Doctrine\Repo\DoctrineInterface');
    }

    public function search($dispositions)
    {
        // dispositions found Get arrets with page and volume
        return $dispositions->map(function ($item, $key) {
            return $this->arret->getVolumePage($item->volume_id,$item->page);
        })->reject(function ($value, $key) {
            return !$value;
        })->flatten(1)->unique('id');
    }

    public function findArret($found,$search)
    {
        if(!empty($found))
        {
            $result = [];

            foreach($found as $find)
            {
                $founded = $this->arret->getByVolumePage($find->volume_id,$find->page,$search);

                if(!$founded->isEmpty())
                {
                    foreach($founded as $item)
                    {
                        $result[$item->id] = $item;
                    }
                }
            }

            return $result;
        }

        return [];
    }

    public function convertToArray($subdivision)
    {
        $keys     = ['alinea','chiffre','lettre'];
        $division = [];
        foreach($keys as $key )
        {
            if(is_array($subdivision))
            {
                if(isset($subdivision[$key]) && !empty($subdivision[$key])){
                    $division[$key] = $subdivision[$key];
                }
            }
            else
            {
                if(isset($subdivision->$key)){
                    $division[$key] = $subdivision->$key;
                }
            }
        }

        return $division;
    }

    public function find($params,$division){

        $result = array_diff_assoc($params,$division);

        if(empty($result))
        {
            return true;
        }

        return false;
    }

    public function searchAll($terms,$content){

        $all_search = $this->termInQuotes($terms);
        $all_result = [];

        foreach($all_search as $id => $search)
        {
            $type = key($search);
            $term = $search[$type];

            $search_type = ($type == 'simple' ? 'searchSimple' : 'searchAgainst');

            $all_result[$id]['terms']  = $term;
            $all_result[$id]['result'] = $this->processSimpleSearch($term,$content,$search_type);
        }

        return $all_result;
    }

    public function processSimpleSearch($term,$content,$search_type){

        if(is_array($content))
        {
            foreach($content as $model)
            {
               $result[$model] = $this->$model->$search_type($term);
            }

            return $result;
        }

        return $this->$content->$search_type($term);

    }

    public function prepareTerms($terms){

        $liaison  = array(' de ',' des ',' du ',' le ',' les ',' la ');
        $cleaned  = str_replace($liaison, "", $terms);

        $words    = array_map('trim', explode(' ', $cleaned));

        if(count($words) > 1)
        {
            $words  = array_filter($words);
            $string = [];

            if(!empty($words))
            {
                foreach($words as $word){
                    $string[]= '+'.$word;
                }
            }

            return ['complex' => implode(' ',$string)];
        }
        else
        {
            return ['simple' => trim($cleaned)];
        }

    }

    public function termInQuotes($terms){

        $s =  htmlspecialchars_decode($terms);
        preg_match_all('/"(?:\\\\.|[^\\\\"])*"|\S+/', $s, $matches);

        $recherche = $matches[0];

        foreach($recherche as $rech)
        {
            if (preg_match('/\"([^\"]*?)\"/', $rech, $m)) {
                $string = $m[1];
                $string = str_replace('"', '', $string);
                $item   = str_replace('"', '', $string);
                $data[] = ['simple' => $item];
            }
            else{
                $string = str_replace('"', '', $rech);
                $item   = str_replace('"', '', $string);
                $data[] = $this->prepareTerms($item);
            }
        }

        return $data;
    }
}