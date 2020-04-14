<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="0; url='/tv/home'" />
	<meta name="description" content="Easily track which episodes and seasons of your favorite shows you've seen and when new episodes are available!">
	<meta name="keywords" content="tv, tracker, trakt, trakttv, trakt.tv, shows, episodes, seasons, unwatched, next, episode, aired">
	<title>@{ APP_NAME }@</title>
	<link rel="icon" sizes="16x16 32x32 48x48 256x256" href="//watch.dstealth.com/tv/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	<link href="//watch.dstealth.com/tv/style_tv.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		@keyframes lds-bars {
			0% {
				opacity: 1;
			}
			50% {
				opacity: 0.5;
			}
			100% {
				opacity: 1;
			}
		}

		@-webkit-keyframes lds-bars {
			0% {
				opacity: 1;
			}
			50% {
				opacity: 0.5;
			}
			100% {
				opacity: 1;
			}
		}

		.lds-bars {
			position: relative;
		}

		.lds-bars div {
			position: absolute;
			width: 20px;
			height: 40px;
			top: 20px;
			-webkit-animation: lds-bars 1s cubic-bezier(0.5, 0, 0.5, 1) infinite;
			animation: lds-bars 1s cubic-bezier(0.5, 0, 0.5, 1) infinite;
		}

		.lds-bars div:nth-child(1) {
			left: 30px;
			background: #1d5f8d;
			-webkit-animation-delay: -0.6s;
			animation-delay: -0.6s;
		}

		.lds-bars div:nth-child(2) {
			left: 70px;
			background: #baba00;
			-webkit-animation-delay: -0.4s;
			animation-delay: -0.4s;
		}

		.lds-bars div:nth-child(3) {
			left: 110px;
			background: #baba00;
			-webkit-animation-delay: -0.2s;
			animation-delay: -0.2s;
		}

		.lds-bars div:nth-child(4) {
			left: 150px;
			background: #1d5f8d;
		}

		.lds-bars {
			width: 200px !important;
			height: 200px !important;
			-webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
		}
	</style>
</head>
<body>
<div align="center">
	<br/>
	<div id="title">@{ APP_NAME }@</div>
	<p>Loading...</p>
	<div class="lds-css ng-scope">
		<div style="width:100%;height:100%" class="lds-bars">
			<div></div><div></div><div></div><div></div>
		</div>
	</div>
</div>
</body>
</html>