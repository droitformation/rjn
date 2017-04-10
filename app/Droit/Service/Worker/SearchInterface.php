<?php namespace Droit\Service\Worker;
/**
 * Repo Interface 
 */

/**
 * Search Interface
 * Custom search by keywords in the database for user or adresse
 */
interface SearchInterface {

	/**
	 * Find data by keywords
	 */
	public function find($data);
	
}

