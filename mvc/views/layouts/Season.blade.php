<div class="season horzFlex">
	<div class="sTitle">@{ $season->getTitle() }@</div>
	<div class="sOverview">@{ $season->getOverview() }@</div>
	<div class="sInfo">
		<div>
			<div class="th">First Aired</div>
			<div>@{ $season->first_aired }@</div>
		</div>
		<div>
			<div class="th">Episodes</div>
			<div>@@{ if(Auth::check()) echo $season->watched."/"; }@@ @{ $season->aired }@</div>
		</div>
	</div>
	<div class="sActions">
	@@{ if($season->authed && $season->aired()) { }@@
		@@{ if($season->unwatched()) { }@@
		<span class="statusBtn" type="seasons" trakt="@{ $season->traktID }@" show="@{ $show->slug }@">Watch</span>
		@@{ } else { }@@
		<span class="statusBtn watched" type="seasons" trakt="@{ $season->traktID }@" show="@{ $show->slug }@">Forget</span>
		@@{ } }@@
	@@{ } }@@
		<a class="btn" href="/tv/s/@{$show->slug}@/@{$season->number}@" target="_blank">Episodes</a>
	</div>
</div>