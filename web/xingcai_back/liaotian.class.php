<?php
class liaotian extends WebLoginBase{
	
	public final function chat(){
		$this->display('liaotian/index.php');
	}
	public final function nicheng(){
		$this->display('liaotian/nicheng.php');
	}
	public final function php(){
		$this->display('liaotian/php.php');
	}
	public final function send(){
		$this->display('liaotian/send.php');
	}	
	public final function check(){
		$this->display('liaotian/check.php');
	}		
}
