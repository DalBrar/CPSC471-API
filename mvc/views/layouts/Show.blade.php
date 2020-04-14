	<div class="fog center">
		<h1>@{ $show->title }@</h1>
		<div>
			<table class="center">
				<tr>
					<td width="70%">
						<div class="th">Overview</div>
						<div>@{ $show->getOverview() }@</div>
						<div><a href="@{$show->trailer}@" target="_blank">Trailer</a></div>
					</td>
					<td width="10%">
						<div class="th">Genres</div>
						<div>@@{ foreach($show->genres as $g) {
							echo $g."<br/>";
						} }@@</div>
					</td>
					<td>
						<div class="th">First Aired</div>
						<div>@{ $show->first_aired }@</div>
						<div class="th">Rating</div>
						<div>@{ $show->rating }@</div>
						<div class="th">Network</div>
						<div>@{ $show->network }@</div>
					</td>
				@@{ if(Auth::check()) { }@@ 
					<td width="10%">
					@@{ if($show->authed) { }@@
						<span class="subBtn subbed" type="shows" trakt="@{ $show->traktID }@">Unfollow</span>
					@@{ } else { }@@
						<span class="subBtn" type="shows" trakt="@{ $show->traktID }@">Follow</span>
					@@{ } }@@
					</td>
				@@{ } }@@ 
				</tr>
			</table>
		</div>
	</div>