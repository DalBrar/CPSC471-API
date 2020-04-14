<?php
/**
 * Rewritten version of Sammy by Dan Horrigan under MIT License
 */
class Router {
	
	/* ======================================================================
				Class Fields & Functions
	====================================================================== */
	public static $route_found = false;
	public $path = '';			// current url path
	public $method = '';		// request method
	public $ext = '';			// file extension if one exists
	public $params = array();	// parameters from the url path, eg: /tv/{show}/
	
	// Constructor
	public function __construct() {
		// Start Output Buffering
		ob_start();
		$this->path = static::getPath();
		$this->method = static::getMethod();
		$this->ext = static::getExtension($this->path);
	}
	
	// method overloading for Object->method calls for the method get($param)
	public function __call($name, $args) {
		if ($name === 'get' && func_num_args() === 2) { // 1st arg = $this, 2nd arg = $args[0]
			return call_user_func(array($this, 'getParam'), $args[0]);
		}
	}
	
	public function getParam($param) {
		if(array_key_exists($param, $this->params))
			return $this->params[$param];
		return null;
	}
	
	public function all() {
		return $this->params;
	}
	
	/* ======================================================================
				Public Static Functions
	====================================================================== */
	// method overloading for Static::method calls for the method get($route, $callback)
	public static function __callStatic($name, $args) {
		if ($name === 'get' && func_num_args() === 2) {
			static::getRoute($args[0], $args[1]);
		}
	}
	
	public static function getRoute($route, $callback) {
		static::process($route, $callback, 'GET');
	}
	
	public static function post($route, $callback) {
		static::process($route, $callback, 'POST');
	}
	
	public static function put($route, $callback) {
		static::process($route, $callback, 'PUT');
	}
	
	public static function delete($route, $callback) {
		static::process($route, $callback, 'DELETE');
	}
	
	public static function ajax($route, $callback) {
		static::process($route, $callback, 'XMLHttpRequest');
	}
	
	// Call this function after all routes to run the router
	public static function run() {
		$router = static::getInstance();
		if (!static::$route_found)
			ErrorPage::pathNotFound($router->method, $router->path);
		
		// print and end Output Buffer
		ob_end_flush();
	}
	
	/* ======================================================================
				Private Static Functions
	====================================================================== */
	
	// Get a new instance of Router or return existing if already created.
	private static function getInstance() {
		// only called once due to static modifier
		static $instance = null;
		
		if ($instance === null)
			$instance = new Router;
		
		return $instance;
	}
	
	private static function process($route, $callback, $type) {
		// IF route is found return false;
		if (static::$route_found)
			return false;
		
		$router = static::getInstance();
		
		// Check for and set AJAX
		if ($type == 'XMLHttpRequest')
			$router->method = static::getAJAXMethod();
		
		// IF	url doesnt match this route OR
		//		request type doesnt match this route's type
		// THEN return and do nothing;
		if (!static::getParameters($router, $route) ||
			$router->method != $type) {
			return false;
		}
		
		// Set route_found to true and execute the callback function
		static::$route_found = true;
		static::dispatch($callback);
	}
	
	private static function dispatch($callback) {
		$router = static::getInstance();
		
		$parts = explode('@', $callback);
		$controller = $parts[0];
		$method = $parts[1];
		
		self::loadController($controller);
		
		if (class_exists($controller)) {
			$object = new $controller($router->path, $callback);
			
			if (is_callable(array($object, $method))) {
				$result = $object->$method($router);
				if ($result !== null) {
					$json = json_encode($result);
					echo $json;
				}
			} else
				ErrorPage::methodNotFound($router->path ."<br>". $callback."()");
		}
		else
			ErrorPage::controllerNotFound($router->path ."<br>". $controller);
	}
	
	/* ======================================================================
				Private Helper Functions
	====================================================================== */
	private static function getPath() {
		if (isset($_SERVER['PATH_INFO'])) {
	        $uri = $_SERVER['PATH_INFO'];
	    }
		elseif (isset($_SERVER['REQUEST_URI'])) {
	        $uri = $_SERVER['REQUEST_URI'];
		
			// remove and SCRIPT_NAME ot directory prefix from uri
			if( strpos($uri, $_SERVER['SCRIPT_NAME']) === 0 ) {
	            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
	        }
			elseif( strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0 ) {
	            $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
	        }
			
			// if uri starts with ?/ then remove that from the uri
			if( strncmp($uri, '?/', 2) === 0 )
	            $uri = substr($uri, 2);
			
			// if uri has query after the path, get just the path as uri
			$parts = preg_split('#\?#i', $uri, 2);
	        $uri = $parts[0];
			
			// fix the QUERY_STRING server var and $_GET array
			if (isset($parts[1])) {
				$_SERVER['QUERY_STRING'] = $parts[1];
				parse_str($_SERVER['QUERY_STRING'], $_GET);
			}
			else {
				$_SERVER['QUERY_STRING'] = '';
				$_GET = array();
			}
			
			// Parse the uri for just the PHP_URL_PATH
			$uri = parse_url($uri, PHP_URL_PATH);
		}
		else
			return '';
		
		// Some final cleanup before returning the path
		// trim and slashes on either end
		$uri = trim($uri, '/');
		// replace // or ../ with just /
		$uri = str_replace(array('//', '../'), '/', $uri);
		// prefix with forward slash
		return '/'.$uri;
	}
	
	private static function getMethod() {
		if (isset($_SERVER['REQUEST_METHOD']))
			return $_SERVER['REQUEST_METHOD'];
		else
			return 'GET';
	}
	
	private static function getAJAXMethod() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']))
			return $_SERVER['HTTP_X_REQUESTED_WITH'];
		else
			return 'GET';
	}
	
	private static function getExtension($url) {
		if (preg_match('/\.\w{3,4}($|\?)/', $url, $matches))
			return $matches[0];
		else
			return '';
	}
	
	private static function getParameters($router, $route) {
		$template = static::getSegments($route);
		$actual = static::getSegments($router->path);
		if (sizeof($template) == sizeof($actual)) {
			$params = array();
			for($i = 0; $i < sizeof($template); $i++) {
				$parameter = $template[$i];
				$value = $actual[$i];
				if ($parameter == $value)
					continue;
				elseif (preg_match('/\{([^\]]*)\}/', $parameter, $param)) {
					$params[$param[1]] = $value;
				}
				else
					return false;
			}
			$router->params = $params;
			return true;
		}
		return false;
	}
	
	private static function getSegments($url) {
		return explode('/', trim($url, '/'));
	}
	
	private static function loadController($controller) {
		$controller_path = CONTROLLERS . $controller . ".php";
		if (file_exists($controller_path))
			require_once $controller_path;
	}
}
?>