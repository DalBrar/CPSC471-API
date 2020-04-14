@include VIEWS.'layouts/main/header.php' @endinclude
<div>
<?php if(empty($show->title)) { ?> 
	<div class="fog">
		@{ $show->slug }@ is not a valid show. Please check your link and try again.
	</div>
<?php } else { ?>
	@include VIEWS.'layouts/Show.blade.php' @endinclude
	
	<?php if (empty($show->seasons)) { ?> 
	<div class="fog">No seasons listed for this show.</div>
	<?php } else { ?> 
	@@{ foreach($show->seasons as $season) { }@@
	<div class="fog">
	@include VIEWS.'layouts/Season.blade.php' @endinclude
	</div>
	@@{ } }@@
	<?php } ?> 
	
<?php } ?> 
</div>
</body>
</html>