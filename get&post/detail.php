<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail Buku</title>
  <style>
    li {
      list-style: none;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <table>
    <tr>
      <td>Judul Buku  </td>
      <td> : <?= $_GET["judul"];?></td>
    </tr>
    <tr>
      <td>Nama Pengarang </td>
      <td> : <?= $_GET["pengarang"];?></td>
    </tr>
    <tr>
      <td>Penerbit </td>
      <td> : <?= $_GET["penerbit"];?></td>
    </tr>
    <tr>
      <td>Jumlah Buku </td>
      <td> : <?= $_GET["jumlah"];?></td>
    </tr>
  </table>
  <a href="/">kembali</a>
</body>
</html>