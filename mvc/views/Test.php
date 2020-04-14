@include VIEWS.'layouts/main/header.php' @endinclude
<div>
	<div id="header" align="center">
		<h1>Dumping of $test</h1>
	</div>
	
	<div class="fog"><pre>
		@@{ if(isset($test)) var_dump($test); }@@
	</pre></div>
</div>