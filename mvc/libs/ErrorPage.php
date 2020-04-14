<?php

class ErrorPage {
	
	public static function InvalidRequest($router) {
		ErrorPage::display("400", $router->method, "Bad Request", $router->path);
	}
	
	public static function pathNotFound($method, $path) {
		ErrorPage::display("404", $method, "Endpoint Not Found", $path);
	}
	
	public static function controllerNotFound($name) {
		ErrorPage::display("404", "INTERNAL", "Controller Not Found", $name);
	}
	
	public static function methodNotFound($name) {
		ErrorPage::display("404", "INTERNAL", "Method Not Found", $name);
	}
	
	public static function viewNotFound($name) {
		ErrorPage::display("404", "INTERNAL", "View Not Found", $name);
	}
	
	private static function display($code, $http, $msg, $path) {
		$obj = new stdClass();
		$obj->status = $code;
		$obj->method = $http;
		$obj->path = $path;
		$obj->msg = $msg;
		
		echo json_encode($obj);
	}
}
?>
