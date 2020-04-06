<?php
  //koneksi database
  $conn = mysqli_connect("localhost","root","","belajarphp");

  //pagination
  //konfigurasi
  $dataPerHalaman = 2;
  $jumlahData = count(query("SELECT * FROM bukuperpus"));
  $jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
  $keyword = ( isset($_GET["keyword"]) ) ? $_GET["keyword"] : '';
  $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
  $awalData = ( $dataPerHalaman * $halamanAktif ) - $dataPerHalaman;
  
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

  function signup($user) {
    global $conn;

    $username = strtolower(stripcslashes($user["user"]));
    $password = mysqli_real_escape_string($conn, $user["password"]);
    $confirmpswd = mysqli_real_escape_string($conn, $user["confirmpswd"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  
    if (mysqli_fetch_assoc($result)) {
      echo "<script>
              alert('Username Sudah Digunakan!')
          </script>";

        return false;
    }
    
    //cek konfirmasi password
    if( $password !== $confirmpswd ) {
      echo "<script>
              alert('Konfirmasi Password Tidak Sesuai!');
            </script>";

      return false;
    }
    
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(0, '$username', '$password')");

    return mysqli_affected_rows($conn);

  }
  
  function query($query) {
    global $conn;
      
    echo mysqli_error($conn);
    $result = mysqli_query($conn, $query);
    $row = [];

    if( !$result ) {
      echo mysqli_error($conn);
    }
    elseif ( mysqli_affected_rows($conn) === 0) {
      return mysqli_affected_rows($conn);
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

  function cari($data) {
    global $conn;
    global $dataPerHalaman;
    global $awalData;

    $keyword = mysqli_real_escape_string($conn, $data);

    $query = "SELECT * FROM bukuperpus
                WHERE
                judul LIKE '%$keyword%' OR
                pengarang LIKE '%$keyword%' OR
                penerbit LIKE '%$keyword%' OR
                jumlah LIKE '%$keyword%'
                LIMIT $awalData, $dataPerHalaman";
    
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