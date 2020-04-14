<div class="fog episode horzFlex">
	<div class="sTitle">
		<span>s@{$episode->season.'e'.$episode->number}@ -&nbsp;</span>
		<span>@{ $episode->getTitle() }@</span>
	</div>
	<div class="sOverview">@{ $episode->getOverview() }@</div>
	<div class="sInfo">
		<div>
			<div class="th">First Aired</div>
			<div>@{ $episode->first_aired }@</div>
		</div>
		<div>
			<div class="th">Runtime</div>
			<div>@{ $episode->runtime }@</div>
		</div>
	</div>
	<div class="sActions">
	@@{ if($episode->authed && $episode->aired()) { }@@
		@@{ if($episode->unwatched()) { }@@
		<span class="statusBtn" type="episodes" trakt="@{ $episode->traktID }@" show="@{ $season->traktID }@">Watch</span>
		@@{ } else { }@@
		<span class="statusBtn watched" type="episodes" trakt="@{ $episode->traktID }@" show="@{ $season->traktID }@">Forget</span>
		@@{ } }@@
	@@{ } }@@
	</div>
</div>