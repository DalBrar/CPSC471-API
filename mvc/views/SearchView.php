@include VIEWS.'layouts/main/header.php' @endinclude
<div>
	<div id="header" align="center">
		@include VIEWS.'layouts/Toolbar.blade.php' @endinclude
	</div>
	<div class="fog search"><form>
		<input type="text" name="show" placeholder="Search for a show.." value="@{ $query }@" />
	</form></div>
	
	<div class="fog">
		@@{ foreach($shows as $show) { }@@
			@include VIEWS.'layouts/Show.blade.php' @endinclude
		@@{ } }@@
	</div>
</div>