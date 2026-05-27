<?php
ini_set('memory_limit','512M');
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';


?>