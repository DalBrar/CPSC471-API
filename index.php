<?php
// for use in development mode
//		0 = off		1 = on
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// include all neccessities for the app
require_once 'app.env.php';

// Find Endpoint and reroute
//	Generic Controller
Router::get ('/', 'GenericController@index');
Router::get ('/shows', 'GenericController@shows');
Router::get ('/show/{showid}/actors', 'GenericController@actors');
Router::get ('/show/{showid}/seasons', 'GenericController@seasons');
Router::get ('/show/{showid}/episodes/{seasonid}', 'GenericController@episodes');
Router::get ('/episode/{showid}/{seasonid}/{episodeid}', 'GenericController@episode');
// User Controller
Router::get ('/user/{userid}/shows', 'UserController@shows');
Router::get ('/user/{userid}/episode/{showid}/{seasonid}/{episodeid}', 'UserController@episode');
Router::put ('/user/{userid}/trackshow/{showid}', 'UserController@toggleShow');
Router::post ('/user/{userid}/trackepisode', 'UserController@toggleEpisode');
// Admin Controller
Router::post ('/admin/{adminid}/add/user', 'AdminController@addUser');
Router::post ('/admin/{adminid}/remove/user', 'AdminController@removeUser');
Router::post ('/admin/{adminid}/show', 'AdminController@show');
Router::post ('/admin/{adminid}/season', 'AdminController@season');
Router::post ('/admin/{adminid}/episode', 'AdminController@episode');

Router::run();
?>