<?php

  session_start();
  
  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
  }

  require "functions.php";

  // var_dump(isset($_GET['keyword'])); die;
  
  if ( isset($keyword) ) {
    if ( $keyword !== '' ) {
      $data = $keyword;
      $books = cari($keyword);
      if( $books !== 0 ) {
        $jumlahData = count(query("SELECT * FROM bukuperpus
                  WHERE
                  judul LIKE '%$data%' OR
                  pengarang LIKE '%$data%' OR
                  penerbit LIKE '%$data%' OR
                  jumlah LIKE '%$data%'"));
        $jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
      } else {
        $books = query("SELECT * FROM bukuperpus LIMIT $awalData, $dataPerHalaman");
        $jumlahHalaman = 1;
      }
    } else {
      $books = query("SELECT * FROM bukuperpus LIMIT $awalData, $dataPerHalaman");
      header('Location : index.php');
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
  <title>Tabel Buku</title>
</head>
<body class="home">
  <nav id="nav" class="nav-navbar">
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
    <div class="lg-block">
      <ul class="list-item">
        <li class="item-menu">
          <form action="" method="get" class="search">
            <input type="text" id="keyword" name="keyword" placeholder="Masukan Kata Pencarian..." autocomplete="off">
            <button type="submit" id="cari" name="cari">Cari</button>
            <div class="loader" id="loader"></div>
          </form>
        </li>
        <!-- <li class="item">Tabel</li> -->
        <li class="d-none lg-block item-menu">
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
      <div class="row space-between">
        <div class="col auto">
          <?php if( isset($data) &&  $data !== '') :?>
            <div class="total-data"><h4><strong><i>Total Data = <?=$jumlahData?></i></strong></h4></div>
          <?php endif;?>
        </div>
        <div class="col auto">
          <div class="pagination">
            <a href="?keyword=<?=$keyword?>&halaman=<?= $halamanAktif-1?>" class="<?=$halamanAktif == 1 ? 'disabled' : '' ?>"><i class="fas fa-angle-left"></i></a>
            <?php for($i=1;$i <= $jumlahHalaman; $i++) : ?>
              <a href="?keyword=<?=$keyword?>&halaman=<?= $i ?>" class="<?=$i == $halamanAktif ? 'aktif' : '' ?>"><?= $i ?></a>
            <?php endfor;?>
            <a href="?keyword=<?=$keyword?>&halaman=<?= $halamanAktif+1?>" class="<?=$halamanAktif == $jumlahHalaman ? 'disabled' : '' ?>"><i class="fas fa-angle-right"></i></a>
          </div>
        </div>
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
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/script-jQuery.js"></script>
</body>
</html>