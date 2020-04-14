<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="/tv/trakttv.js"></script>
	<title>TV Tracker@@{ if (isset($title)) echo " - ".$title }@</title>
	<meta name="description" content="Easily track which episodes and seasons of your favorite shows you've seen and when new episodes are available!">
	<meta name="keywords" content="tv, tracker, trakt, trakttv, trakt.tv, shows, episodes, seasons, unwatched, next, episode, aired">
	<link rel="icon" sizes="16x16 32x32 48x48 256x256" href="//watch.dstealth.com/tv/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	<link href="//watch.dstealth.com/tv/style_tv.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Snackbar/Toast -->
<div id="snackbar"><span id="snackbarText"></span></div>
@include VIEWS.'layouts/Titlebar.blade.php' @endinclude
