<?php

// Include Database credentials required by Database.php
require_once 'db_credentials.php';
// info will be in the following format:
#	define('DBHOST', "localhost");
#	define('DBNAME', "myDB");
#	define('DBUSER', "myUser");
#	define('DBPASS', "myPass");

class Database {
	
	private static $conn = null;
	private static $status;
	
	public static function initialize() {
		if (static::$conn === null)
			static::connect();
	}
	
	public static function isConnected() {
		if (static::$conn === null)
			return false;
		else
			return true;
	}
	
	public static function status() {
		return static::$status;
	}
	
	private static function connect() {
		try
		{
			static::$conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
			// set the PDO error mode to exception
			static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			static::$status = "connected";
		}
		catch(PDOException $e)
		{
			static::$conn = null;
			static::$status = $e->getMessage();
		}
	}
	
	private static function error() {
		$obj =  new stdClass();
		$obj->status = 500;
		$obj->msg = "Unable to complete request.";
		$obj->database = static::$status;
		return $obj;
	}
	
	/*
		Executes the given SQL stored procedure and returns a package.
		Package status = 200, where data is the returned results, otherwise status = 500;
	*/
	private static function execute($type, $statement) {
		if (static::isConnected()) {
			try {
				$sql = static::$conn->prepare($statement);
				$sql->execute();
				$result = $sql->fetchAll($type);
				
				$obj =  new stdClass();
				$obj->status = 200;
				$obj->data = $result;
				
				return $obj;
			}
			catch(Exception $e)
			{
				static::$status = $e->getMessage();
			}
		}
		return static::error();
	}
	
	/* ======================================================================
		Stored Procedures:
	====================================================================== */
	
	// Generic Controller
	public static function getAllShows() {
		return static::execute(PDO::FETCH_ASSOC, "CALL get_all_shows()");
	}
	
	public static function getActors($show) {
		return static::execute(PDO::FETCH_COLUMN, "CALL get_actors_for_show($show)");
	}
	
	public static function getSeasons($show) {
		return static::execute(PDO::FETCH_ASSOC, "CALL get_seasons_for_show($show)");
	}
	
	public static function getEpisodes($show, $season) {
		return static::execute(PDO::FETCH_COLUMN, "CALL get_episodes_for_show($show, $season)");
	}
	
	public static function getEpisodeInfo($show, $season, $episode) {
		return static::execute(PDO::FETCH_ASSOC, "CALL get_episode_info($show, $season, $episode)");
	}
	
	// Users Controller
	public static function userGetShows($user) {
		return static::execute(PDO::FETCH_ASSOC, "CALL user_get_shows($user)");
	}
	
	public static function userEpisodeWatched($user, $show, $season, $episode) {
		return static::execute(PDO::FETCH_COLUMN, "CALL user_episode_watched($user, $show, $season, $episode)");
	}
	
	public static function userToggleShow($user, $show) {
		return static::execute(PDO::FETCH_COLUMN, "CALL user_toggle_show($user, $show)");
	}
	
	public static function userToggleEpisode($user, $show, $season, $episode) {
		return static::execute(PDO::FETCH_COLUMN, "CALL user_toggle_episode($user, $show, $season, $episode)");
	}
	
	// Admin Controller
	public static function adminAddUser($admin, $user, $name) {
		return static::execute(PDO::FETCH_COLUMN, "CALL admin_add_user($admin, $user, '$name')");
	}
	
	public static function adminRemoveUser($admin, $user, $name) {
		return static::execute(PDO::FETCH_COLUMN, "CALL admin_remove_user($admin, $user, '$name')");
	}
	
	public static function adminChangeShow($POST) {
		$addremove = $POST->add_remove;
		$showid = $POST->showid;
		$title = $POST->title;
		$desc = $POST->description;
		$poster = $POST->poster;
		$rating = $POST->rating;
		$genre = $POST->genre;
		$network = $POST->network;
		return static::execute(PDO::FETCH_COLUMN, "CALL admin_change_show('$addremove', $showid, '$title', '$desc', '$poster', $rating, '$genre', '$network')");
	}
	
	public static function adminChangeSeason($POST) {
		$addremove = $POST->add_remove;
		$showid = $POST->showid;
		$season = $POST->seasonnum;
		$name = $POST->seasonname;
		return static::execute(PDO::FETCH_COLUMN, "CALL admin_change_season('$addremove', $showid, $season, '$name')");
	}
	
	public static function adminChangeEpisode($POST) {
		$addremove = $POST->add_remove;
		$showid = $POST->showid;
		$season = $POST->season;
		$episode = $POST->episodenum;
		$title = $POST->title;
		$synopsis = $POST->synopsis;
		$runtime = $POST->runtime;
		return static::execute(PDO::FETCH_COLUMN, "CALL admin_change_episode('$addremove', $showid, $season, $episode, '$title', '$synopsis', $runtime)");
	}
	
}

Database::initialize();

?>