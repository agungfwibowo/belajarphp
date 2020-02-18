<?php
  require "../functions.php";

  $keyword = $_GET["keyword"];

  $books = query("SELECT * FROM bukuperpus LIMIT $awalData, $dataPerHalaman");

    if ( $_GET["keyword"] !== '' ) {
      $keyword = $_GET["keyword"];
      $books = cari($_GET["keyword"]);
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
    }

  $no = $awalData+1;

?>


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