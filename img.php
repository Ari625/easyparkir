<?php
session_start();
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
   <title>Image</title>
</head>

<body>
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

   <?= $img ?>
   <img src="img/<?= $img; ?>png" width="70" alt="" class="">
</body>

</html>