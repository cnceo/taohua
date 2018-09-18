<?php
class about extends WebBase{
	public $title='\x51\x51\x34\x31\x30\x37\x34\x39\x39\x38\x35';

	public final function daili(){
		$this->display('about/daili.php');
	}

	public final function about(){
		$this->display('about/about.php');
	}

	public final function games(){
		$this->display('about/games.php');
	}

	public final function news(){
		$this->display('about/news.php');
	}

	public final function security(){
		$this->display('about/security.php');
	}

	public final function reg(){
		$this->display('about/reg.php');
	}

	public final function register(){
		$this->display('about/register.php');
	}
}
