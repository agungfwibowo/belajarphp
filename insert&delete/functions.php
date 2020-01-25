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

        $gambar = htmlspecialchars($data["gambar"]);
        $judul = htmlspecialchars($data["judul"]);
        $pengarang = htmlspecialchars($data["pengarang"]);
        $penerbit = htmlspecialchars($data["penerbit"]);
        $jumlah = htmlspecialchars($data["jumlah"]);

        $query = "INSERT INTO bukuperpus
                    VALUES (0,'$gambar','$judul','$pengarang','$penerbit','$jumlah')
        ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapus($data) {
        global $conn;
        mysqli_query($conn, "DELETE FROM bukuperpus WHERE id = $data");

        return mysqli_affected_rows($conn);
    }

?>