@include VIEWS.'layouts/main/header.php' @endinclude
<div id="login-controls">
	<p>A simple way to track your favorite TV shows for new episodes and watch status!</p>
	<form method="get" action="trakt">
		<p>You must log into Trakt.TV or create an account to use this site.</p>
		<input type="submit" name="op" value="Click here to begin" />
	</form>
</div>
</body>
</html>