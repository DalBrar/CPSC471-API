<?php

class AjaxController extends Controller {
	
	public function watch() {
		if (!static::validData())
			return;
		
		$type = $_POST['type'];
		$id = $_POST['id'];
		$show = $_POST['show'];
		static::keepOnWatchlist($show);
		
		return static::traktSync($type, $id);
	}
	
	public function forget() {
		if (!static::validData())
			return;
		
		$type = $_POST['type'];
		$id = $_POST['id'];
		$show = $_POST['show'];
		static::keepOnWatchlist($show);
		
		return static::traktSync($type, $id, "/remove");
	}
	
	public function subscribe() {
		$id = $_POST['id'];
		return static::syncWatchlist('shows', $id);
	}
	
	public function unsubscribe() {
		$id = $_POST['id'];
		return static::syncWatchlist('shows', $id, '/remove');
	}
	
	// ================================================== //
	//			Helper Functions
	// ================================================== //
	private static function validData() {
		$oneOf = "Must be one of: movies, shows, seasons, episodes.";
		if (empty($_POST['type']) || empty($_POST['id'] || $_POST['show'])) {
			echo "Error: Status button missing information:\n";
			if (empty($_POST['type']))
				echo "\tMissing 'type' attribute. ".$oneOf."\n";
			if (empty($_POST['id']))
				echo "\tMissing 'trakt' attribute.";
			if (empty($_POST['show']))
				echo "\tMissing 'show' attribute.";	
			return false;
		}
		
		$type = $_POST['type'];
		
		$types = array("movies", "shows", "seasons", "episodes");
		if (!in_array($type, $types)) {
			echo "Error: '".$type."' is not a valid type. ".$oneOf;
			return false;
		}
		return true;
	}
	
	private static function traktSync($type, $id, $remove = "") {
		$data[$type]['ids']['trakt'] = $id;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.trakt.tv/sync/history".$remove);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"".
			$type."\": [{\"ids\": {\"trakt\": ".
			$id."}}]}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"Authorization: Bearer " .Auth::getUser()->access_token,
			"trakt-api-version: 2",
			"trakt-api-key: ".API_ID
		));
		
		$response = curl_exec($ch);
		curl_close($ch);
		$array = json_decode($response, true);
		
		$output = "added";
		if ($remove != "")
			$output = "deleted";
		
		if(array_key_exists($output, $array) && 
		   array_key_exists('episodes', $array[$output]) &&
		   (int)$array[$output]['episodes'] > 0)
		{
			echo "true";
			return;
		}
		echo "false";
		return;
	}
	
	public static function keepOnWatchlist($show) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.trakt.tv/sync/watchlist");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"shows\": [{\"ids\": {\"slug\": \"".
			$show."\"}}]}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"Authorization: Bearer ".Auth::getUser()->access_token,
			"trakt-api-version: 2",
			"trakt-api-key: ".API_ID
		));
		
		$response = curl_exec($ch);
		curl_close($ch);
		$array = json_decode($response, true);
		//echo "token :".Auth::getUser()->access_token;
		//echo "\nid: ".API_ID."\n";
		//print_r($response);
	}
	
	public static function syncWatchlist($type, $id, $remove = "") {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.trakt.tv/sync/watchlist".$remove);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"".
			$type."\": [{\"ids\": {\"trakt\": ".
			$id."}}]}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"Authorization: Bearer ".Auth::getUser()->access_token,
			"trakt-api-version: 2",
			"trakt-api-key: ".API_ID
		));
		
		$response = curl_exec($ch);
		curl_close($ch);
		$array = json_decode($response, true);
		
		$output = "added";
		if ($remove != "")
			$output = "deleted";
		
		if(array_key_exists($output, $array) && 
		   array_key_exists('episodes', $array[$output]) &&
		   (int)$array[$output]['episodes'] > 0)
		{
			return static::true();
		}

		print_r($array);
		return false;
	}
	
	private static function true() {
		ob_clean();
		echo true;
		die();
	}
}

?>