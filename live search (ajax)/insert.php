<?php

  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
  }

  require 'functions.php';

  if( isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
      echo "
        <script>
          alert('Data Berhasil ditambah!')
          document.location.href='/'
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data Gagal ditambah!')
          document.location.href='/'
        </script>
      ";
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
  <title>Insert New Data</title>
</head>
<body class="insert-new-book">
  <nav class="nav-navbar">
    <div class="nav-item">
      <div class="logo">
        <a href="/"><h1>Table Buku Perpustakaan</h1></a>
      </div>
    </div>
    <div class="nav-item d-none lg-block">
      <div class="list-menu">
        <ul class="list-item">
          <!-- <li class="item">Tabel</li> -->
          <li class="item-menu">
            <a class="logout" href="logout.php">Logout<i class="fas fa-sign-out-alt" style="display:inline-block; margin-left:5px"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="form">
      <form class="form-insert" action="" method="post" enctype="multipart/form-data">
        <div class="field-list">
          <input type="text" name="judul" id="" placeholder="Judul" required>
          <input type="text" name="pengarang" id="" placeholder="Pengarang" required>
          <input type="text" name="penerbit" id="" placeholder="Penerbit" required>
          <input type="file" name="gambar" id="" placeholder="Gambar">
          <input type="text" name="jumlah" id="" placeholder="Jumlah" required>
        </div>
        <div class="button">
          <a class="back" href="/"><i class="fas fa-angle-left"></i></a>
          <button type="submit" name="submit">TAMBAH<i class="fas fa-angle-right d-none lg-block"></i></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>