<?php
session_start();
require "functions.php";

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

$history = query("SELECT * FROM k_keluar");
if (isset($_POST["cari"])) {
   $keyword = $_POST["keyword"];
   $history = query("SELECT * FROM k_keluar WHERE plat_no LIKE '%$keyword%'");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title></title>
</head>

<body>

   <!-- navbar -->
   <nav class="navbar bg-body-secondary shadow-sm">
      <div class="container-fluid">
         <span class="navbar-brand mb-0 h1">
            <text class="bg-success text-white p-1 rounded-2">
               EASY PARKIR
            </text>
         </span>
         <div class="d-flex flex-row-reverse">
            <span class="p-1">
               <div class="">
                  <a name="logout" class="btn btn-danger" href="logout.php">
                     <i class="bi bi-box-arrow-in-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="currentColor"
                           class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                           <path fill-rule="evenodd"
                              d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                           <path fill-rule="evenodd"
                              d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg>
                     </i>
                     Logout
                  </a>
               </div>
            </span>
            <span class="p-1">
               <a href="index.php#masuk" name="history" class="btn fw-bold ">
                  Back
               </a>
            </span>
         </div>
      </div>
   </nav>
   </div>
   <!-- navbar end -->

   <main class="">
      <div class="card border-white   position-absolute top-50 start-50 translate-middle h-50 w-50">
         <form action="" method="post">
            <div class="input-group mb-3">
               <input type="text" class="form-control" placeholder="Masukan Plat Nomor" aria-label="Masukan Plat Nomor "
                  aria-describedby="button-addon2" name="keyword">
               <button class="btn btn-outline-primary" type="submit" id="button-addon2" name="cari">Cari!</button>
            </div>
         </form>
         <div class=" overflow-y-scroll ">
            <table class="card-header table table-bordered  table-responsive  ">
               <tr>
                  <th class="bg-secondary text-white ">No</th>
                  <th class="bg-secondary text-white ">Plat No</th>
                  <th class="bg-secondary text-white ">Waktu Masuk</th>
                  <th class="bg-secondary text-white ">Waktu Keluar</th>
                  <th class="bg-secondary text-white ">Merk</th>
                  <th class="bg-secondary text-white ">Keterangan</th>
               </tr>
               <tbody class="">


                  <?php $i = 1; ?>
                  <?php foreach ($history as $row): ?>
                     <?php if ($row["merk"] == 1) {
                        $namaMerk = "Yamaha";
                     } elseif ($row["merk"] == 2) {
                        $namaMerk = "Honda";
                     } elseif ($row["merk"] == 3) {
                        $namaMerk = "Kawasaki";
                     } elseif ($row["merk"] == 4) {
                        $namaMerk = "Suzuki";
                     } else {
                        $namaMerk = "Lainnya";
                     }
                     ?>
                     <tr>
                        <td>
                           <?= $i; ?>
                        </td>
                        <td>
                           <?= $row['plat_no'] ?>
                        </td>
                        <td>
                           <?= $row['waktu_masuk'] ?>
                        </td>
                        <td>
                           <?= $row['waktu_keluar'] ?>
                        </td>
                        <td>
                           <?= $namaMerk ?>
                        </td>
                        <td>
                           <img src="img/<?= $row['ket'] ?>" alt="" srcset="" width="70px" height="70px">
                        </td>
                     </tr>
                     <?php $i++; ?>
                  <?php endforeach ?>
               </tbody>
            </table>
         </div>
      </div>
   </main>


</body>

</html>