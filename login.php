<?php

session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   $result = mysqli_query($conn, "SELECT email FROM user WHERE id = $id");
   $row = mysqli_fetch_assoc($result);

   if ($key === hash('sha256', $row['email'])) {
      $_SESSION['login'] = true;

   }
}

// if (isset($_SESSION["login"])) {
//    header("location: index.php");
//    exit;
// }

if (isset($_POST["login"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
   if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
         $_SESSION["login"] = true;
         if (isset($_POST['remember'])) {

            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', $row['username']), time() + 60);
         }

         header("Location: index.php");
         exit;
      }
   }

   $error = true;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Halaman Login</title>
</head>

<body>

   <h1>Halaman Login</h1>

   <?php if (isset($error)): ?>
      <p style="color:red; font-style: italic;">username atau password salah</p>
   <?php endif ?>

   <form action="" method="post">

      <ul>
         <li>
            <label for="username">username</label>
            <input type="text" name="username" id="username">
         </li>
         <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
         </li>
         <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
         </li>
         <li>
            <a href="registrasi.php">Tidak memiliki akun? Daftar!</a>
         </li>
         <li>
            <button type="submit" name="login">Login</button>
         </li>
      </ul>
   </form>
</body>

</html>