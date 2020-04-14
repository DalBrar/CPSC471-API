<?php

class GenericController extends Controller {
	
	/* index()
		- Returns the status of the API if all is working correctly.
		GET: /
	*/
	public function index() {
		$obj =  new stdClass();
		$obj->status = 200;
		$obj->msg = "CPSC 471 PandaTV API running.";
		$obj->database = Database::status();
		
		return $obj;
	}
	
	/* shows()
		- Returns a list of all shows in the database.
		GET: /shows
	*/
	public function shows() {
		$obj = Database::getAllShows();
		
		if ($obj->status === 200)
			return $obj->data;
		else
			return $obj;
	}
	
	/* actors()
		- Returns a lsit of all Actors in a given show.
		GET: /show/{showid}/actors
	*/
	public function actors($router) {
		$showid = $router->params['showid'];
		
		$obj = Database::getActors($showid);
		
		if ($obj->status === 200)
			return $obj->data;
		else
			return $obj;
	}
	
	/* seasons()
		- Returns a list of seasons including their number and name for a given show.
		GET: /show/{showid}/seasons 
	*/
	public function seasons($router) {
		$showid = $router->params['showid'];
		
		$obj = new stdClass();
		$obj->showid = $showid;
		
		$result = Database::getSeasons($showid);
		if ($result->status === 500)
			return $result;
		
		$seasons = $result->data;
		$obj->seasons = $seasons;
		
		return $obj;
	}
	
	/* episodes()
		- Returns the number of episodes in the given season for the given show.
		GET: /show/{showid}/episodes/{seasonid}
	*/
	public function episodes($router) {
		$showid = $router->params['showid'];
		$seasonid = $router->params['seasonid'];
		
		$obj = new stdClass();
		$obj->showid = $showid;
		$obj->seasonid = $seasonid;
		
		$result = Database::getEpisodes($showid, $seasonid);
		if ($result->status === 500)
			return $result;
		
		$obj->episodes = $result->data[0];
		
		return $obj;
	}
	
	/* episode()
		- Get Episode information for the given show, season and episode.
		GET: /episode/{showid}/{seasonid}/{episodeid}
	*/
	public function episode($router) {
		$showid = $router->params['showid'];
		$seasonid = $router->params['seasonid'];
		$episodeid = $router->params['episodeid'];
		
		$result = Database::getEpisodeInfo($showid, $seasonid, $episodeid);
		if ($result->status === 500)
			return $result;
		
		return $result->data[0];
	}
}

?>