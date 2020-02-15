<?php

  session_start();

  if( isset($_COOKIE['key']) ) {
    setcookie('key', false);
  }

  $_SESSION = [];
  session_unset();
  session_destroy();

  header("Location: login.php");

  exit;

?>