<?php 
  require 'functions.php';

  if( isset( $_POST["signup"] ) ) {
    if( signup($_POST) > 0 ) {
      echo "<script>
              alert('User Baru Berhasil Ditambah!')
          </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="src/css/all.min.css">
  <link rel="stylesheet" href="src/css/style.css">
  <link rel="icon" type="image/png" sizes="16x16" href="src/img/favicon/favicon.ico">
  <title>Sign Up</title>
</head>
<body class="sign-up">
  <nav class="nav-navbar">
    <div class="nav-item">
      <div class="logo">
        <a href="/"><h1>Table Buku Perpustakaan</h1></a>
      </div>
    </div>
    <div class="nav-item d-none">
      <div class="list-menu">
        <!-- <ul class="list-item">
          <li class="item-menu">
            <a class="item" href="/"><i class="fas fa-angle-left"></i></a>
          </li>
        </ul> -->
      </div>
    </div>
  </nav>
  <div class="container">
    <h2 class="title">
      Sign Up
    </h2>    
    <div class="form">
      <form class="form-insert" action="" method="post">
        <div class="field-list">
          <input type="text" name="user" id="" placeholder="user" autocomplete="off" required autofocus>
          <input type="password" name="password" id="" placeholder="password" autocomplete="off" required>
          <input type="password" name="confirmpswd" id="" placeholder="konfirmasi password" autocomplete="off" required>
        </div>
        <div class="button">
          <button type="submit" name="signup">Sign Up<i class="fas fa-angle-right d-none lg-block"></i></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>