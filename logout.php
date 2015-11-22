<?php
  ob_start();
  session_start();
  
  //require_once('connect.php');
  $username=$_SESSION['username'];
  
  session_destroy();
  
  $session=array();
  
  header('location:index.php');
  ob_flush();
?>