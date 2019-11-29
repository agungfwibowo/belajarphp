  <?php 
  
  if( isset($_GET["submit"]) ) { 
    if ( $_GET["judul"] !== '' && $_GET["pengarang"] !== '' && $_GET["penerbit"] !== '' && $_GET["jumlah"] !== '' ) {
      header("Location: detail.php/?judul=".$_GET["judul"]."&pengarang=".$_GET["pengarang"]."&penerbit=".$_GET["penerbit"]."&jumlah=".$_GET["jumlah"]."&submit=");
      exit;
    } else {
      $error = true;
    }
  }
  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>form php</title>
  <style>
    ul.wrapper {
      padding:0;
    }
    li {
      list-style: none;
      margin-bottom: 5px;
    }
    input, button {
      padding: 8px;
    }
    .wrapper {
      width: 80%;
      margin: auto;
      display: flex;
      justify-content: center;
    }
    .error {
      text-align: center;
      color: red;
    }
  </style>
</head>
<body>


  <?php if ( isset($error) ) : ?>
    <div class="wrapper">
      <h3><i class="error">Harap isi semua field sebelum dikirim</i></h3>
    </div>
  <?php endif;?>

  <ul class="wrapper">
    <form action="" method="get">
      <li>
        <input type="text" name="judul" id="judul" placeholder="Judul Buku">
      </li>
      <li>
        <input type="text" name="pengarang" id="pengarang" placeholder="Nama Pengarang">
      </li>
      <li>
        <input type="text" name="penerbit" id="penerbit" placeholder="Penerbit">
      </li>
      <li>
        <input type="number" name="jumlah" id="jumlah" placeholder="Jumlah Buku">
      </li>
      <li>
        <button type="submit" name="submit">kirim</button>
      </li>
    </form>
  </ul>
</body>
</html>