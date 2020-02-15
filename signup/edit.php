<?php
  require 'functions.php';

  if( isset($_POST["submit"])) {
    if (edit($_POST) > 0) {
      echo "
        <script>
          alert('Data Berhasil diedit!')
          document.location.href='index.php'
        </script>
      ";
    } elseif(edit($_POST) == 0 ) {
      echo "
        <script>
          const ok = confirm('Data belum dirubah, Yakin Lanjut?');
            if(ok) {
              document.location.href='index.php'
            }
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data Gagal diedit!')
          // document.location.href='index.php'
        </script>
      ";
    }
  }
 
  $id = $_GET["id"];

  $book = query("SELECT * FROM bukuperpus WHERE id = $id")[0];
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
  <title>Edit New Data</title>
</head>
<body class="edit-book">
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
    <div class="form">
      <form id="submit" class="form-insert" action="" method="post" enctype="multipart/form-data">
        <div class="field-list">
          <input type="hidden" name="id" value="<?= $book["id"];?>">
          <input type="hidden" name="gambarLama" value="<?= $book["gambar"];?>">
          <input type="text" name="judul" value="<?= $book["judul"];?>" required>
          <input type="text" name="pengarang" value="<?= $book["pengarang"];?>" required>
          <input type="text" name="penerbit" value="<?= $book["penerbit"];?>" required>
          <img src="src/img/<?= $book["gambar"];?>" alt="" width="200">
          <input type="file" name="gambar" value="">
          <input type="text" name="jumlah" value="<?= $book["jumlah"];?>" required>
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