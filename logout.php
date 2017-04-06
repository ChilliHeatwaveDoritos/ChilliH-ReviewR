<?php
require_once __DIR__.'/dbcontroller.class.php';

session_start();

if(session_destroy())
{
	header("Location: landing-login.php");
}
?>