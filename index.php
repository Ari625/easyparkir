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
         document.location.href = 'index.php#masuk';
      </script>
      ";
   } else {
      echo "
      <script>
         alert('Data Gagal Ditambahkan');
         document.location.href = 'index.php#masuk';
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

$listKendaraanMasuk = query("SELECT * FROM k_masuk ORDER BY waktu_masuk ASC");
$jumlahKendaraanMasuk = count($listKendaraanMasuk);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset='utf-8'>
   <meta http-equiv='X-UA-Compatible' content='IE=edge'>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?= $icon ?>
   <?= $title ?>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <style>
   </style>
</head>

<body onload="displayTime()">

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
               <a href="history.php" name="history" class="btn text-success fw-bold">
                  History
               </a>
            </span>
         </div>
      </div>
   </nav>
   </div>
   <!-- navbar end -->


   <div class=" position-absolute top-50 start-50 translate-middle">
      <div class="card" style="height : 350px; width: auto;">
         <!-- card header -->
         <div class="card-header bg-success">
            <ul class="nav justify-content-center">
               <li class="nav-item">
                  <a href="#masuk" class="btn nav-item text-white fw-bold ">Masuk</a>
               </li>
               <li class="nav-item">
                  <a href="#kendaraanmasuk" class="btn nav-item text-white fw-bold ">Kendaraan Masuk</a>
               </li>
               <li class="nav-item">
                  <a href="#keluar" class="btn nav-item text-white fw-bold ">Keluar</a>
               </li>
            </ul>
         </div>
         <!-- card header end -->

         <div class="card-body overflow-y-scroll">
            <div id="masuk" class="content">
               <!-- Konten untuk tombol masuk -->
               <h4 class="text-center">Masuk Parkir</h4>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="waktuMasuk" value="<?= date("Y-m-d H:i:s"); ?>">
                  <input type="text" name="platNo" id="platNo" class="form-control" placeholder="Masukan Plat Nomor"
                     required>
                  <select class="form-select mt-2 mb-2" aria-label="Default select example" name="merk" id="merk"
                     required>
                     <option selected>Pilih Merk</option>
                     <option value="1">Yamaha</option>
                     <option value="2">Honda</option>
                     <option value="3">Kawasaki</option>
                     <option value="4">Suzuki</option>
                     <option value="5">Lainnya</option>
                  </select>
                  <input type="file" name="gambar" id="gambar" class="mb-2">
                  <br>
                  <input type="submit" value="Kirim" name="kirimDataMasuk" class="btn btn-success w-100">
               </form>
            </div>

            <div id="keluar" class="content" style="width: 300px;">
               <!-- Konten untuk tombol keluar -->
               <h4 class="text-center">Keluar Parkir</h4>
               <form action="" method="post">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Masukan Plat Nomor"
                        aria-label="Masukan Plat Nomor " aria-describedby="button-addon2" name="keyword" autofocus>
                     <button class="btn btn-outline-primary" type="submit" id="button-addon2" name="btnCari">Cari!</button>
                  </div>
               </form>
               <?php if (isset($_POST["btnCari"])): ?>
                  <?php if ($dataKendaraanMasuk > 0): ?>
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
                     <div class="container">
                        <form action="" method="post" class="mt-3" enctype="multipart/form-data">
                           <input type="hidden" name="merk" id="merk" value="<?= $dataKendaraanMasuk['merk']; ?>"
                              class="form-control">
                           <div class="row">
                              <div class="col">
                                 <label for="platNo">Plat Nomor</label>
                                 <input type="text" name="platNo" class="form-control mb-1" id="platNo"
                                    value='<?= $dataKendaraanMasuk["plat_no"] ?>' readonly>
                              </div>
                              <div class="col">
                                 <label for="namaMerk">Merk</label>
                                 <input type="text" id="namaMerk" value="<?= $namaMerk; ?>" readonly class="form-control">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col">
                                 <label for="waktuMasuk">Waktu Masuk</label>
                                 <input type="text" name="waktuMasuk" class="form-control mb-1" id="waktuMasuk"
                                    value='<?= $dataKendaraanMasuk["waktu_masuk"] ?>' readonly>
                              </div>
                              <div class="col">
                                 <label for="waktuKeluar">Waktu Keluar</label>
                                 <input type="text" value="-" readonly id="waktuKeluar" class="form-control mb-1">
                                 <input type="hidden" name="waktuKeluar" value="<?= date("Y-m-d H:i:s"); ?>">
                              </div>
                           </div>
                           <br>
                           <img src="img/<?= $dataKendaraanMasuk['ket']; ?>" width="70" alt="" class="">
                           <input type="hidden" name="gambar" id="gambar" value="<?= $dataKendaraanMasuk["ket"] ?>">
                           <input type="submit" value="Keluar" name="submitKeluar" class="btn btn-success">
                        </form>
                     </div>
                  <?php else: ?>
                     <h6 class="mt-3">
                        Plat Nomor tidak ditemukan
                     </h6>
                  <?php endif ?>
               <?php else: ?>

               <?php endif ?>
            </div>

            <div id="kendaraanmasuk" class="content" ">
               <!-- Konten untuk tombol list kendaraan -->
               <h4 class=" text-center">Kendaraan masuk</h4>
               <div class="p-1 bg-secondary mb-2 d-inline-flex rounded-1  ">
                  <h6 class=" text-white m-1">Jumlah kendaraan yang parkir :
                     <?= $jumlahKendaraanMasuk; ?>
                  </h6>
               </div>
               <div class="">
                  <table class="table-bordered">
                     <tr>
                        <th class="p-2">No.</th>
                        <th class="p-2">Plat Nomor</th>
                        <th class="p-2">Waktu Masuk</th>
                        <th class="p-2">Merk</th>
                        <th class="p-2">Keterangan</th>
                     </tr>

                     <?php
                     $i = 1;
                     foreach ($listKendaraanMasuk as $row):
                        ?>
                        <tr>
                           <td class="p-1 text-center">
                              <?= $i ?>
                           </td>
                           <td class="p-1">
                              <?= $row["plat_no"] ?>
                           </td>
                           <td class="p-1">
                              <?= $row["waktu_masuk"] ?>
                           </td>
                           <td class="p-1">
                              <?php if ($row["merk"] == 1) {
                                 echo "Yamaha";
                              } elseif ($row["merk"] == 2) {
                                 echo "Honda";
                              } elseif ($row["merk"] == 3) {
                                 echo "Kawasaki";
                              } elseif ($row["merk"] == 4) {
                                 echo "Suzuki";
                              } else {
                                 echo "Lainnya";
                              }
                              ?>
                           </td>
                           <td class="text-center">
                              <a class="btn  " href="img.php?img=<?= $row['ket'] ?>">
                                 <img src="img/<?= $row['ket']; ?>" width="70" alt="" class="">
                              </a>
                           </td>
                        </tr>
                        <?php $i++; ?>
                     <?php endforeach ?>
                  </table>
               </div>
            </div>
         </div>

      </div>
   </div>

   <footer>
      <div class="position-absolute bottom-0 start-0 p-1">
         <text class="text-secondary">
            &copy;2024
         </text>
      </div>
   </footer>
   <script>
      function handleHashChange() {
         const hash = window.location.hash;
         const contentId = hash.slice(1);
         const contentElements = document.querySelectorAll('.content');

         contentElements.forEach(element => {
            element.style.display = 'none';
         });

         const selectedContent = document.getElementById(contentId);
         if (selectedContent) {
            selectedContent.style.display = 'block';
         }
      }

      window.addEventListener('DOMContentLoaded', handleHashChange);
      window.addEventListener('hashchange', handleHashChange);
   </script>
   <script src="lib/js/script.js"></script>
</body>

</html>