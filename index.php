<?php
session_start();
require "functions.php";
date_default_timezone_set("Asia/jakarta");

if (!isset($_SESSION["login"])) {
   header("location: login.php");
   exit;
}

if (isset($_POST["kirimDataMasuk"])) {
   if (tambahDataMasuk($_POST) > 0) {
      echo "
      <script>
         alert('Data Berhasil Ditambahkan');
         document.location.href = 'index.php';
      </script>
      ";
   } else {
      echo "
      <script>
         alert('Data Gagal Ditambahkan');
         document.location.href = 'index.php';
      </script>
      ";
   }
}

if (isset($_POST["btnCari"])) {
   $dataKendaraanMasuk = cari($_POST["keyword"]);
   // var_dump($dataKendaraanMasuk);
   // exit;
   if ($dataKendaraanMasuk == NULL) {
      $dataKendaraanMasuk = 0;
   } else {
      $dataKendaraanMasuk = cari($_POST["keyword"])[0];
   }
}

if (isset($_POST["submitKeluar"])) {
   if (tambahDataKeluar($_POST) > 0) {
      echo "
      <script>
         alert('Data Berhasil Ditambahkan');
         document.location.href = 'index.php';
      </script>
      ";
      exit;
   } else {
      echo "
      <script>
         alert('Data Gagal Ditambahkan');
         document.location.href = 'index.php';
      </script>
      ";
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset='utf-8'>
   <meta http-equiv='X-UA-Compatible' content='IE=edge'>
   <title>EASY PARKIR</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <style>
      .content {
         display: none;
         /* Sembunyikan semua konten awal */
      }

      #keluar {
         display: contents;
      }
   </style>
</head>

<body onload="displayTime()">

   <nav class="navbar bg-body-secondary shadow-sm">
      <div class="container-fluid">
         <span class="navbar-brand mb-0 h1">
            <text class="bg-success text-white p-1 rounded-2">
               EASY PARKIR
            </text>
         </span>
         <span id="current-time"></span>
         <span>
            <a name="logout" class="btn btn-danger" href="logout.php">Logout</a>
         </span>
      </div>
   </nav>

   <div class="p-3 position-absolute top-50 start-50 translate-middle">
      <div class="card" style="height : auto; width: auto;">
         <div class="card-header">
            <ul class="nav justify-content-center">
               <li class="nav-item">
                  <button onclick="showContent('masuk')" class="btn nav-item">Masuk</button>
               </li>
               <li class="nav-item">
                  <button onclick="showContent('keluar')" class="btn nav-item">Keluar</button>
               </li>
               <li class="nav-item">
                  <button onclick="showContent('listKendaraan')" class="btn nav-item">List Kendaraan</button>
               </li>
            </ul>
         </div>
         <div class="card-body ">
            <div id="masuk" class="content">
               <!-- Konten untuk tombol masuk -->
               <h4>Masuk Parkir</h2>
                  <form action="" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="waktuMasuk" value="<?= date("Y-m-d H:i:s"); ?>">
                     <input type="text" name="platNo" id="platNo" class="form-control" placeholder="Masukan Plat Nomor">
                     <select class="form-select mt-2 mb-2" aria-label="Default select example" name="merk" id="merk">
                        <option selected>Pilih Merk</option>
                        <option value="1">Yamaha</option>
                        <option value="2">Honda</option>
                        <option value="3">Kawasaki</option>
                        <option value="4">Suzuki</option>
                        <option value="5">Lainnya</option>
                     </select>
                     <input type="hidden" name="waktuMasuk" value="<?= date("Y-m-d H:i:s"); ?>">
                     <input type="file" name="gambar" id="gambar" class="mb-2">
                     <br>
                     <input type="submit" value="Kirim" name="kirimDataMasuk" class="btn btn-primary w-100">
                  </form>
            </div>

            <div id="keluar" class="content">
               <!-- Konten untuk tombol keluar -->
               <h4>Keluar Parkir</h2>
                  <form action="" method="post" class="row g-3">
                     <div class="col-auto g-3">
                        <input type="text" name="keyword" id="" placeholder="Masukan Plat Nomor"
                           class="g-col-6 form-control" autofocus>
                     </div>
                     <div class="col-auto">
                        <input type="submit" value="Cari!" name="btnCari" class=" btn btn-primary">
                     </div>
                  </form>
                  <?php if (isset($_POST["btnCari"])) : ?>
                     <?php if ($dataKendaraanMasuk > 0) : ?>
                        <?php if ($dataKendaraanMasuk["merk"] == 1) {
                           $namaMerk = "Yamaha";
                        } elseif ($dataKendaraanMasuk["merk"] == 2) {
                           $namaMerk = "Honda";
                        } elseif ($dataKendaraanMasuk["merk"] == 3) {
                           $namaMerk = "Kawasaki";
                        } elseif ($dataKendaraanMasuk["merk"] == 4) {
                           $namaMerk = "Suzuki";
                        } else {
                           $namaMerk = "Lainnya";
                        }
                        ?>
                        <form action="" method="post" class="mt-3">
                           <label for="platNo">Plat Nomor</label>
                           <input type="text" name="platNo" class="form-control mb-1" id="platNo"
                              value='<?= $dataKendaraanMasuk["plat_no"] ?>' readonly>
                           <label for="waktuMasuk">Waktu Masuk</label>
                           <input type="text" name="waktuMasuk" class="form-control mb-1" id="waktuMasuk"
                              value='<?= $dataKendaraanMasuk["waktu_masuk"] ?>' readonly>
                           <label for="waktuKeluar">Waktu Keluar</label>
                           <input type="text" name="waktuKeluar" id="waktuKeluar" class="form-control mb-1"
                              value="<?= date("Y-m-d H:i:s"); ?>">
                           <label for="namaMerk">Merk</label>
                           <input type="text" id="namaMerk" value="<?= $namaMerk; ?>" readonly class="form-control">
                           <input type="hidden" name="merk" id="merk" value="<?= $dataKendaraanMasuk['merk']; ?>" class="form-control">
                           <br>
                           <img src="img/<?= $dataKendaraanMasuk['ket']; ?>" width="70" alt="" class="">
                           <input type="file" name="gambar" id="gambar">
                           <input type="submit" value="Kirim" name="submitKeluar" class="btn btn-secondary">
                        </form>
                     <?php else : ?>
                     <h6 class="mt-3" >
                        Plat Nomor tidak ditemukan
                     </h6>
                     <?php endif ?>
                  <?php else: ?>

                  <?php endif ?>
            </div>

            <div id="listKendaraan" class="content">
               <!-- Konten untuk tombol list kendaraan -->
               <h4>List kendaraan</h4>
               <table>

               </table>
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