<?php

class UserController extends Controller {

	/* shows()
		- Return a list of shows tracked by the specified User and the number
		  of episodes tracked for each show.
		GET: /user/{userid}/shows
	*/
	public function shows($router) {
		$userid = $router->params['userid'];
		
		$result = Database::userGetShows($userid);
		if ($result->status === 500)
			return $result;
		$shows = $result->data;
		
		$obj = new stdClass();
		$obj->userid = $userid;
		$obj->shows = $shows;
		
		return $obj;
	}
	
	/* episode()
		- Returns whether the specified episode for a season in a show has been
		  watched by the given user.
		GET: /user/{userid}/episode/{showid}/{seasonid}/{episodeid}
	*/
	public function episode($router) {
		$userid = $router->params['userid'];
		$showid = $router->params['showid'];
		$seasonid = $router->params['seasonid'];
		$episodeid = $router->params['episodeid'];
		
		$result = Database::userEpisodeWatched($userid, $showid, $seasonid, $episodeid);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->userid = $userid;
		$obj->showid = $showid;
		$obj->season = $seasonid;
		$obj->episode = $episodeid;
		$obj->watched = ($result->data[0] == 1) ? true : false;
		
		return $obj;
	}
	
	/* toggleShow()
		- Toggles the given showID for the given user as tracked or not tracked.
		PUT: /user/{userid}/trackshow/{showid}
	*/
	public function toggleShow($router) {
		$userid = $router->params['userid'];
		$showid = $router->params['showid'];
		
		$result = Database::userToggleShow($userid, $showid);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->userid = $userid;
		$obj->showid = $showid;
		$obj->tracked = ($result->data[0] == 1) ? true : false;
		
		return $obj;
	}
	
	/* toggleEpisode()
		- Tracks or untracks the given episode for the season of a show for the given user.
		POST: /user/{userid}/trackepisode
	*/
	public function toggleEpisode($router) {
		$userid = $router->params['userid'];
		$POST = json_decode(file_get_contents('php://input'));
		
		$showid = $POST->showid;
		$season = $POST->season;
		$episode = $POST->episode;
		
		if ($showid == null || $season == null || $episode == null) {
			ErrorPage::InvalidRequest($router);
			return;
		}
		
		$result = Database::userToggleEpisode($userid, $showid, $season, $episode);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->userid = $userid;
		$obj->season = $season;
		$obj->episode = $episode;
		$obj->tracked = ($result->data[0] == 1) ? true : false;
		
		return $obj;
	}
}

?>