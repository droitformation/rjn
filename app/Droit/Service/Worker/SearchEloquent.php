<?php namespace Droit\Service\Worker;
/**
 * Repo Search Eloquent Class
 */

use Droit\Service\Worker\SearchInterface;

/**
 * Implements SearchInterface 
 * Custom search by keywords in the database for arrets and categories
 */

class SearchEloquent implements SearchInterface {

    protected $arret;

    protected $categorie;

    public function __construct( $arret, $categorie )
    {
        $this->arret     = $arret;

        $this->categorie = $categorie;

        $this->custom    = new \Custom;
	}
	
	/**
	 * Find arret by keywords
	 * Allow for htmlentities and accents
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function find($data){
		
		// background processing, special commands (backspace, etc.), quotes newlines, or some other special characters 
   		$matchSimple =  trim($data);
		$pattern     = '/(;|\||`|>|<|^|'."\n|\r|'".'|{|}|[|]|\)|\()/i';
		
		$matchSimple = preg_replace($pattern, '', $matchSimple);
		
		// We still have something to search for
		if( ($matchSimple != '') && (strlen($matchSimple) > 1) )
        {
			
			// Prepare terms
			$terms = $this->custom->prepareSearch($matchSimple);

            return $this->arret->where('pid','=',195)
                ->where(function($query) use ($terms, $matchSimple)
                {
                    foreach($terms as $term){
                        $query->where('reference', 'LIKE', '%'.$term.'%')
                            ->orWhere('abstract', 'LIKE',  '%'.$term.'%')
                            ->orWhere('pub_text', 'LIKE',  '%'.$term.'%');
                    }
                })
                ->with( array('arrets_categories' => function ($query)
                    {
                        $query->orderBy('sorting', 'ASC');
                    },'arrets_analyses' => function($query)
                    {
                        $query->where('analyses.deleted', '=', 0);
                    }))
                ->orderBy('pub_date', 'DESC')->get();

	    }


    }

}