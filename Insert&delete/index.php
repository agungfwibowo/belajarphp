<?php
  require "functions.php";

  $books = query("SELECT * FROM bukuperpus");

  $no = 0;
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
  <title>Connect To Database</title>
</head>
<body class="home">
  <nav class="nav-navbar">
    <div class="nav-item">
      <div class="logo">
        <a href="#"><h1>Table Buku Perpustakaan</h1></a>
      </div>
    </div>
    <div class="nav-item">
      <div class="list-menu">
        <ul class="list-item">
          <!-- <li class="item">Tabel</li> -->
          <li class="item">
            <a class="insert" href="insert.php">Insert New Book<i class="fas fa-plus"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="table-scroll">
      <table cellpadding="10">
        <tr>
          <th>No</th>
          <th></th>
          <th></th>
          <th>Judul Buku</th>
          <th>Nama Pengarang</th>
          <th>Penerbit</th>
          <th>Jumlah Buku</th>
        </tr>
        <?php foreach($books as $book) :?>
        <tr>
          <td><?= $no+=1?></td>
          <td class="aksi">
              <a href="#" class="edit">Edit</a>
              <a href="#" class="hapus">Hapus</a>
          </td>
          <td><img src="src/img/<?= $book["gambar"];?>.png" alt="" srcset=""></td>
          <td><?= $book["judul"];?></td>
          <td><?= $book["pengarang"];?></td>
          <td><?= $book["penerbit"];?></td>
          <td><?= $book["jumlah"];?></td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
  </div>
</body>
</html>