@include VIEWS.'layouts/main/header.php' @endinclude
<div>
	<div id="header" align="center">
		<h1>Welcome @{ $user->name }@!</h1>
	</div>
	<div class="fog">
		<h2>Info</h2>
		<div>
			<?php if(isset($error))  { ?>
				<span class="error">@{ $error }@</span>
			<?php } ?>
			<ul>
			<?php if(!empty($shows)) { ?>
				<h4>Unwatched Episodes</h4>
			<?php foreach($shows as $show) { if ($show->unwatched() > 0) { ?>
				<li>
					<a href="/tv/s/@{ $show->slug }@" target="_blank" title="View Show Seasons">
					<span class="num">@{ $show->unwatched()}@</span> - <strong>@{ $show->title }@</strong>@@{ if($show->status == "ended") echo "<span class=\"error\">*</span>"; }@@
					</a>
				</li>
			<?php }} ?>
			<?php } else { ?>
				<li>You are all cought up on shows!</li>
			<?php } ?>
			</ul>
		</div>
	</div>
	<div class="fog">
		<h2>My Shows</h2>
		<?php if(!empty($shows)) { foreach($shows as $show) { ?>
		<div id="@{ $show->slug }@" class="fog">
			<h3>@{ $show->title }@ @@{ if($show->status == "ended") echo "<span class=\"error\">Ended</span>"; }@@</h3>
			<p>@{ $show->getOverview() }@</p>
			<div>
				<div><strong>First Aired: </strong>@{ $show->first_aired }@ on @{ $show->network }@</div>
				<div><strong>Airs On: </strong>@{ $show->air_day }@ at @{ $show->air_time }@ (@{ $show->timezone }@)</div>
				<div><strong>Unwatched Episodes: </strong>@{ $show->unwatched() }@</div>
				<div><a href="/tv/s/@{ $show->slug }@" target="_blank">View Seasons</a></div>
			</div>
		</div>
		<?php }} else { ?>
		<div>You aren't subscribed to any shows yet.</div>
		<?php } ?>
	</div>
</div>
</body>