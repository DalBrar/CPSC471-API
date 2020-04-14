<?php

class GenericShowModel {
	public $showid = '';
	public $title = '';
	public $description = '';
	public $poster = '';
	public $rating = '';
	public $genre = '';
	public $network = '';
	
	public function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7)
	{
		$this->showid = $a1;
		$this->title = $a2;
		$this->description = $a3;
		$this->poster = $a4;
		$this->rating = $a5;
		$this->genre = $a6;
		$this->network = $a7;
	}
}

?>