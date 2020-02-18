<?php 
  session_start();

  require 'functions.php';

  if( isset($_COOKIE['key']) ) {
    $key = $_COOKIE['key'];

    if( $key === hash('sha256', $row['username']) ) {
      $_SESSION['login'] = true;
    }

  }

  if( isset($_SESSION["login"]) ) {
    header("Location: /");

    exit;
  }

  if( isset( $_POST["login"]) ) {

    $username = $_POST["user"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if( mysqli_num_rows($result) === 1 ) {
      
      //cek password
      $row = mysqli_fetch_assoc($result);

      if( password_verify($password, $row["password"]) ) {

        //set session
        $_SESSION["login"] = true;

        //cek remember me
        if( isset($_POST["remember"]) ) {
          //buat cookie
          setcookie('key', hash('sha256', $row['username']), time()+60);
        }

        header("Location: /");
        exit;
      }
    }
    $error = true;
  }
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
  <title>Login</title>
</head>
<body class="sign-up">
  <nav class="nav-navbar">
    <div class="nav-item">
      <div class="logo">
        <a href="/"><h1>Table Buku Perpustakaan</h1></a>
      </div>
    </div>
    <div class="nav-item d-none">Remember
            <a class="item" href="/"><i class="fas fa-angle-left"></i></a>
          </li>
        </ul> -->
      </div>
    </div>
  </nav>
  <div class="container">
    <h2 class="title">
      Login
    </h2>
    <?php if( isset($error) ) : ?>
      <p class="text-error">Username / Password Salah!</p>
    <?php endif; ?>
    <div class="form">
      <form class="form-insert" action="" method="post">
        <div class="field-list">
          <input type="text" name="user" id="" placeholder="user" autocomplete="off" required autofocus>
          <input type="password" name="password" id="" placeholder="password" autocomplete="off" required>
            <div class="checkbox">
              <input type="checkbox" name="remember" id="remember">
              <label class="small-text" for=remember>Remember me</label>
            </div>
        </div>
        <div class="button">
          <button type="submit" name="login">Login<i class="fas fa-angle-right d-none lg-block"></i></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>