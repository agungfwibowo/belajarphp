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
    // mysqli_fetch_array(); --> return both
    // mysqli_fetch_object(); --> return object

    //menguraikan isi table dan harus melakukan looping untuk menampilkan semua isi data table
    // while($books = mysqli_fetch_object($result)){
    //     var_dump($books);
    // }
    //functions
    function query($query) {
        global $conn;
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

?>