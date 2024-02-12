<?php
session_start();
require "functions.php";
if (!isset($_SESSION["login"])) {
   header("location: login.php");
   exit;
}
$img = $_GET["img"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <?= $icon ?>
   <?= $title ?>
</head>

<body onload="displayTime()">
   <nav class="navbar bg-body-secondary shadow-sm">
      <div class="container-fluid">
         <span class="navbar-brand mb-0 h1">
            <text class="bg-success text-white p-1 rounded-2">
               EASY PARKIR
            </text>
         </span>
         <span id="current-time" class="justify-content-center"></span>
      </div>
   </nav>
   <div class="p-2">
      <a href="index.php#masuk" class="">
         <i class="bi bi-arrow-left-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
               class="bi bi-arrow-left-circle " viewBox="0 0 16 16">
               <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
            </svg>
         </i>
      </a>
   </div>

   <div class="p-3 position-absolute top-50 start-50 translate-middle">
      <div class="card" style="height : auto; width: auto;">
         <div class="card-header bg-success">
            <h4 class="fw-bold text-white text-center">Keterangan Gambar</h4>
         </div>

         <div class="card-body ">
            <div id="masuk" class="content">
               <!-- Konten untuk tombol masuk -->

               <img src="img/<?= $img; ?>" width="340px">
               <h4 class="text-center"></h4>

            </div>

         </div>
         <div class="card-footer">
            <text class="text-secondary">
               &copy2024
            </text>
         </div>
      </div>
   </div>

   <script src="lib/js/script.js"></script>
</body>

</html>