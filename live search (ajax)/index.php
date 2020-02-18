<?php

  session_start();
  
  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
  }

  require "functions.php";

  $books = query("SELECT * FROM bukuperpus LIMIT $awalData, $dataPerHalaman");

  if ( isset($_POST["cari"]) ) {
    if ( $_POST["keyword"] !== '' ) {
      $keyword = $_POST["keyword"];
      $books = cari($_POST["keyword"]);
      if( $books !== 0 ) {
        $jumlahData = count(query("SELECT * FROM bukuperpus
                  WHERE
                  judul LIKE '%$keyword%' OR
                  pengarang LIKE '%$keyword%' OR
                  penerbit LIKE '%$keyword%' OR
                  jumlah LIKE '%$keyword%'"));
        $jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
      } else {
        $jumlahHalaman = 1;
      }
    } else {
      header("Location: /");
    }
  }

  $no = $awalData+1;
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
  <title>Tabel</title>
</head>
<body class="home">
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
    <div class="d-none lg-block">
      <ul class="list-item">
        <li class="item-menu">
          <form action="" method="post" class="search">
            <input type="text" id="keyword" name="keyword" placeholder="Masukan Kata Pencarian..." autocomplete="off">
            <!-- <button type="submit" id="cari" name="cari">Cari</button> -->
          </form>
        </li>
        <!-- <li class="item">Tabel</li> -->
        <li class="item-menu">
          <a class="insert" href="insert.php"><i class="fas fa-plus"></i></a>
        </li>
      </ul>
    </div>
    <div id="table">
      <div class="table-scroll">
        <table cellpadding="10">
          <tr>
            <th>No</th>
            <th colspan=2></th>
            <th>Judul Buku</th>
            <th>Nama Pengarang</th>
            <th>Penerbit</th>
            <th>Jumlah Buku</th>
          </tr>
          <!-- perulangan dengan gaya templeting!-->
          <?php if($books !== 0 ) : ?>
            <?php foreach($books as $book) :?>
            <tr>
              <td><?= $no++?></td>
              <td class="aksi">
                  <a href="edit.php?id=<?= $book["id"];?>" class="edit">Edit</a>
                  <a href="hapus.php?id=<?= $book["id"];?>" onclick="return confirm('Yakin Hapus Buku <?= $book['judul'];?> ini!')" class="hapus">Hapus</a>
              </td>
              <td><img src="src/img/<?= $book["gambar"];?>" alt="" set=""></td>
              <td><?= $book["judul"];?></td>
              <td><?= $book["pengarang"];?></td>
              <td><?= $book["penerbit"];?></td>
              <td><?= $book["jumlah"];?></td>
            </tr>
            <?php endforeach;?>
            <?php else :?>
            <tr><td colspan="7" style="text-align:center"><b>Data is Empty</b></td></tr>
          <?php endif;?>
        </table>
      </div>
      <div class="pagination">
        <a href="?halaman=<?= $halamanAktif-1?>" class="<?=$halamanAktif == 1 ? 'disabled' : '' ?>"><i class="fas fa-angle-left"></i></a>
        <?php for($i=1;$i <= $jumlahHalaman; $i++) : ?>
          <a href="?halaman=<?= $i ?>" class="<?=$i == $halamanAktif ? 'aktif' : '' ?>"><?= $i ?></a>
        <?php endfor;?>
        <a href="?halaman=<?= $halamanAktif+1?>" class="<?=$halamanAktif == $jumlahHalaman ? 'disabled' : '' ?>"><i class="fas fa-angle-right"></i></a>
      </div>
    </div>
  </div>
  <nav class="nav-navbar">
    <div class="nav-item d-none md-block">
      <div class="list-menu">
        <ul class="list-item">
          <!-- <li class="item">Tabel</li> -->
          <li class="item-menu">
            <a class="insert" href="insert.php"><i class="fas fa-plus"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="js/script.js"></script>
</body>
</html>