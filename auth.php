<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: landing-login.php");
exit(); }
?>