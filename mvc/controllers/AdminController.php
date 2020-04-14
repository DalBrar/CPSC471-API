<?php

class AdminController extends Controller {

	/* addUser()
		- Used by an admin to add a user to the database if it does not exist.
		POST: /admin/{adminid}/add/user
	*/
	public function addUser($router) {
		$adminid = $router->params['adminid'];
		
		$POST = json_decode(file_get_contents('php://input'));
		$userid = $POST->userid;
		$username = $POST->username;
		
		if ($userid == null || $username == null) {
			ErrorPage::InvalidRequest($router);
			return;
		}
		
		$result = Database::adminAddUser($adminid, $userid, $username);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->adminid = $adminid;
		$obj->userid = $userid;
		$obj->username = $username;
		$obj->status = ($result->data[0] === "1") ? "added" : "already exists";
		
		return $obj;
	}

	/* removeUser()
		- Remove the given userid and username if the pair exists in the database.
		POST: /admin/{adminid}/remove/user
	*/
	public function removeUser($router) {
		$adminid = $router->params['adminid'];
		
		$POST = json_decode(file_get_contents('php://input'));
		$userid = $POST->userid;
		$username = $POST->username;
		
		if ($userid == null || $username == null) {
			ErrorPage::InvalidRequest($router);
			return;
		}
		
		$result = Database::adminRemoveUser($adminid, $userid, $username);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->adminid = $adminid;
		$obj->userid = $userid;
		$obj->username = $username;
		$obj->status = ($result->data[0] === "1") ? "removed" : "no match found";
		
		return $obj;
	}

	/* show()
		- Add or Update the given show details into the database.
		POST: /admin/{adminid}/show
	*/
	public function show($router) {
		$adminid = $router->params['adminid'];
		
		$POST = json_decode(file_get_contents('php://input'));
		$addremove = $POST->add_remove;
		$showid = $POST->showid;
		$title = $POST->title;
		$desc = $POST->description;
		$poster = $POST->poster;
		$rating = $POST->rating;
		$genre = $POST->genre;
		$network = $POST->network;
		
		if ($addremove == null || $showid == null || $title == null || $desc == null || $poster == null || $rating == null || $genre == null || $network == null) {
			ErrorPage::InvalidRequest($router);
			return;
		}
		
		$result = Database::adminChangeShow($POST);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->adminid = $adminid;
		$obj->showid = $showid;
		$obj->status = $result->data[0];
		
		return $obj;
	}

	/* season()
		- Add or update the given season details into the database
		POST: /admin/{adminid}/season
	*/
	public function season($router) {
		$adminid = $router->params['adminid'];
		
		$POST = json_decode(file_get_contents('php://input'));
		$addremove = $POST->add_remove;
		$showid = $POST->showid;
		$season = $POST->seasonnum;
		$name = $POST->seasonname;
		
		if ($addremove == null || $showid == null || $season == null || $name == null) {
			ErrorPage::InvalidRequest($router);
			return;
		}
		
		$result = Database::adminChangeSeason($POST);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->adminid = $adminid;
		$obj->showid = $showid;
		$obj->seasonnum = $season;
		$obj->status = $result->data[0];
		
		return $obj;
	}

	/* episode()
		- Add or update the given episode details into the database
		POST: /admin/{adminid}/episode
	*/
	public function episode($router) {
		$adminid = $router->params['adminid'];
		
		$POST = json_decode(file_get_contents('php://input'));
		$addremove = $POST->add_remove;
		$showid = $POST->showid;
		$season = $POST->season;
		$episode = $POST->episodenum;
		$title = $POST->title;
		$synopsis = $POST->synopsis;
		$runtime = $POST->runtime;
		
		if ($addremove == null || $showid == null || $season == null || $episode == null || $title == null || $synopsis == null || $runtime == null) {
			ErrorPage::InvalidRequest($router);
			return;
		}
		
		$result = Database::adminChangeEpisode($POST);
		if ($result->status === 500)
			return $result;
		
		$obj = new stdClass();
		$obj->adminid = $adminid;
		$obj->showid = $showid;
		$obj->seasonnum = $season;
		$obj->status = $result->data[0];
		
		return $obj;
	}

}

?>