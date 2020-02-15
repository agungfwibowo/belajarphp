<?php

  session_start();
  
  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
  }

  require 'functions.php';
  
  $id = $_GET["id"];

    if( !isset($id) ) {
      header("Location: /");
      exit;
    }

  if ( hapus($id) > 0 ) {
    echo "
        <script>
          alert('Data Berhasil dihapus!')
          document.location.href='/'
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data Gagal dihapus!')
          document.location.href='/'
        </script>
      ";
    }


?>