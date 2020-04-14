@include VIEWS.'layouts/main/header.php' @endinclude
<div>
<?php if (empty($season)) { ?>
	<div class="fog error">Unable to retrieve Season information at this time. Try again in a bit.</div>
<?php } else { ?>
	<div id="header" align="center">
		<h1>@{ $season->title }@</h1>
		<h2>Season @{ $season->number }@</h2>
	</div>
@@{ foreach($season->episodes as $episode) { }@@
@include VIEWS.'layouts/Episode.blade.php' @endinclude
@@{ } }@@
<?php } ?> 
</div>
</body>
</html>