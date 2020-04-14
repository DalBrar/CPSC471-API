<div id="titlebar" align="center">
	<div id="title">@{ APP_NAME }@</div>
	@@{ if (Auth::check()) { }@@
	<span id="toolbar" class="dim">
		<a href="/tv/search">Search</a> |
		<a class="dim" href="/tv/logout">Logout</a>
	</span>
	@@{ } }@@
</div>