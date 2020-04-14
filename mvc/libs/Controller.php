<?php

class Controller {
	
	/*
	// set object variables
	public function example1() {
		$this->msg = "IndexController::test() = I work!";
		echo $this->msg ."<br>";
	}
	
	// get data from route
	public function example2($route) {
		echo $route->path ."<br>";
		echo $route->ext ."<br>";
		echo $route->params['show'] ."<br>";
	}
	
	// redirect to another route
	public function example3() {
		return self::redirecT('/otherRoute');
	}
	
	// call a view
	public function example4($route) {
		$data = array();
		$data['params'] = $route->params;
		
		return self::view("path/to/my/CustomView", $data);
	}
	*/
	
	public $user_vars = array();
	private $url_path;
	private $callback;
	
	public function __construct($up, $cb) {
		$this->url_path = $up;
		$this->callback = $cb;
	}
	
	public function __set($var, $val) {
		$this->user_vars[$var] = $val;
	}
	
	public function __get($var) {
		return (isset($this->user_vars[$var])) ? $this->user_vars[$var] : null;
	}
	
	protected function view($view, $viewdata = []) {
		//unset all other variables
		$vars = array_keys(get_defined_vars());
		for ($i = 0; $i < sizeOf($vars); $i++) {
			if ($vars[$i] == 'view' || $vars[$i] == 'viewdata')
				continue;
			unset(${$vars[$i]});
		}
		unset($vars,$i);
		$nl = '
';
		
		//save each key=>pair as variable=>value
		$args = $viewdata instanceof Arrayable ? $viewdata->toArray() : (array) $viewdata;
		foreach($args as $var => $val) {
			$$var = $val;
		}
		
		// load the view
		$view_path = VIEWS . $view . ".php";
		if (file_exists($view_path)) {
			//include $view_path;
			$viewcode = file_get_contents($view_path);
			// recursively parse the views to parse all includes as well
			$temp = "";
			while ($temp != $viewcode) {
				$temp = $viewcode;
				// parse php at's
				$viewcode = str_replace('<?php', '@@{', $viewcode);
				$viewcode = str_replace('?>', '}@@', $viewcode);
				$viewcode = str_replace('@include', '<?php include ', $viewcode);
				$viewcode = str_replace('@endinclude', '; ?>'.$nl, $viewcode);
				
				// check for eval error
				ob_start();
				try { eval('?>'.$viewcode); }
				catch (ParseError $e) {
					echo "<strong>Parse error:</strong> ".$e->getMessage()." in <strong>".$view_path."</strong> on line <strong>".$e->getLine()."</strong>";
					echo $viewcode;
					$viewcode = ob_get_clean();
					break;
				}
				$viewcode = ob_get_clean();
			}
			
			// parse php at's
			$viewcode = str_replace('@@{', '<?php', $viewcode);
			$viewcode = str_replace('}@@', '?>'.$nl, $viewcode);
			$viewcode = str_replace('@{', '<?php echo', $viewcode);
			$viewcode = str_replace('}@', '; ?>'.$nl, $viewcode);
			
			// check for eval error
			ob_start();
			try { eval('?>'.$viewcode); }
			catch (ParseError $e) {
				echo "<strong>Parse error:</strong> ".$e->getMessage()." in <strong>".$view_path."</strong> on line <strong>".$e->getLine()."</strong>";
				echo $viewcode;
			}
			$html = ob_get_clean();
			
			// if error then correct message to proper view
			if (strpos($html, "eval()'d code") !== false) {
				$html = str_replace("/var/www/watch/tv/mvc/libs/Controller.php(85) : eval()'d code", $view_path, $html);
				$html = str_replace("/var/www/watch/tv/mvc/libs/Controller.php(103) : eval()'d code", $view_path, $html);
			}
			
			$html = static::formatHTML($html);
			echo $html;
			
			// unset the variables used to parse code above
			unset($view, $viewdata, $args, $view_path, $viewcode, $temp, $e, $html);
			
			return;
		}
		else
			ErrorPage::viewNotFound($this->url_path ."<br>". $this->callback ."<br>". $view.".php");
	}
	
	protected function redirect($route) {
		if (substr($route, 0, 4) === "http")
			header("Location:".$route);
		else
			header("Location:/tv".$route);
        exit;
		//echo '<META HTTP-EQUIV="refresh" content="0;URL=/tv/' . $route . '">';
	}
	
	// Could get this function working for some reason :( so had to use library below
	private static function beautifyHTML($html) {
		$dom = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = TRUE;
		$dom->loadHTML($html);
		return $dom->saveHTML();
	}
	
	private static function formatHTML($html) {
		$format = new Format;
		$formatted_html = $format->HTML($html);
		return $formatted_html;
	}
}
?>