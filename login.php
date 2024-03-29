<?php
session_start();
require "functions.php";
if (isset($_SESSION["login"])) {
   header("location: index.php#masuk");
   exit;
}

//kode akan dijalankan jika tombol login ditekan
if (isset($_POST["login"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '". mysqli_real_escape_string($conn, $username) ."'");
   if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"]) ) {
         $_SESSION["login"] = true;

         header("Location: index.php#masuk");
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
   <?= $icon ?>
   <?= $title ?>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

   <link href="lib/css/sign-in.css" rel="stylesheet">
   
</head>
<body>

   <main class="form-signin w-100 m-auto row h-100 jusitify-content-center align-items-center">
      <form method="post" action="">
      <div class="" >
         <h2 class="text-success text-center p-3 rounded " >
            EASY PARKIR
         </h2>
      </div>
         <!-- <h3 class="h3 mb-3 fw-normal text-center">LOGIN</h3> -->

         <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
               username atau password salah
            </div>
         <?php endif ?>
         <div class="form-floating">
            <input type="username" class="form-control mb-1" id="username" placeholder="Masukan username"
               name="username">
            <label for="username">username</label>
         </div>
         <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">password</label>
         </div>
         <button class="btn btn-success w-100 py-2" type="submit" name="login">LOGIN</button>
      </form>
   </main>

   <footer>
      <div class="position-absolute bottom-0 start-0 p-1">
         <text class="text-secondary">
            &copy;2024
         </text>
      </div>
   </footer>
</body>
</html>