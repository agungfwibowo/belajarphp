<?php
  //koneksi database
  $conn = mysqli_connect("localhost","root","","belajarphp");

  //mengambil data table bukuperpus dari database
  // $result = mysqli_query($conn, "SELECT * FROM bukuperpus");

  //check koneksi database
  // if (!$result) {
  //     echo mysqli_error($conn);
  // }

  // mysqli_fetch_row(); --> return array numeric
  // mysqli_fetch_assoc(); --> return array associative
  // mysqli_fetch_array(); --> return array both (numeric & associative)
  // mysqli_fetch_object(); --> return object

  // menguraikan isi table dan harus melakukan looping untuk menampilkan semua isi data dalam table dengan menggunakan "while" seperti dibawah ini
  // while($books = mysqli_fetch_object($result)){
  //     var_dump($books);
  // }
  //functions
  function query($query) {
    global $conn;
      
    echo (mysqli_error($conn));
    $result = mysqli_query($conn, $query);
    $row = [];
    if (!$result) {
      echo mysqli_error($conn);
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
          }
        return $rows;
      }
  }

  function tambah($data) {
    global $conn;

    
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    
    $gambar = upload();

    if(!$gambar) {

      return false;

    }

    
    $query = "INSERT INTO bukuperpus
                VALUES (0,
                    '$gambar',
                    '$judul',
                    '$pengarang',
                    '$penerbit',
                    '$jumlah')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function hapus($data) {
    global $conn;

    mysqli_query($conn, "DELETE FROM bukuperpus WHERE id = $data");

      return mysqli_affected_rows($conn);
    }

  function edit($data) {
    global $conn;
        
    $id = ($data["id"]);
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $gambarLama = ($data["gambarLama"]);

    if($_FILES["gambar"]["error"] === 4 ) {
      $gambar = $gambarLama;
    } else {
      $gambar = upload();
    }

    $query = "UPDATE bukuperpus 
                SET
                  gambar='$gambar',
                  judul='$judul',
                  pengarang='$pengarang',
                  penerbit='$penerbit',
                  jumlah='$jumlah'
                  WHERE id=$id";

      mysqli_query($conn, $query);

      return mysqli_affected_rows($conn);
    }

    function cari($keyword) {
      $query = "SELECT * FROM bukuperpus
                  WHERE
                  judul LIKE '%$keyword%' OR
                  pengarang LIKE '%$keyword%' OR
                  penerbit LIKE '%$keyword%' OR
                  jumlah LIKE '%$keyword%'
                ";
      
      return query($query);
    }

    function upload() {

      $file = $_FILES["gambar"];

      $fileName = $file["name"];
      $tmpName = $file["tmp_name"];
      $error = $file["error"];
      $fileSize = $file["size"];

      //cek apakah gambar sudah diupload
      if ($error === 4) {
        echo"<script>
              alert('Pilih Gambar Terlebih Dahulu!');
            </script>";
          return false;
      }

      //cek apakah yang diupload adalah gambar
      $validFileTypes = ['jpg','jpeg','png','ico'];
      $fileType = explode('.', $fileName);
      $fileType = strtolower(end($fileType));

      if(!in_array($fileType, $validFileTypes)) {
        echo "<script>
                alert('Yang Anda Upload Bukan Gambar!');
              </script>";
        return false;
      }

      //cek ukuran gambar dalam satuan byte
      if ($fileSize > 1000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar!');
              </script>";
        return false;
      }

      //lolos validasi

      //generate nama file baru
      $newFileName = uniqid();
      $newFileName .= '.'.$fileType;

      move_uploaded_file($tmpName, 'src/img/'.$newFileName);

      return $newFileName;

    }
?>