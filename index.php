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
   </style>
</head>

<body>

   <nav class="navbar bg-body-secondary shadow-sm">
      <div class="container-fluid">
         <span class="navbar-brand mb-0 h1">
            <text class="bg-success text-white p-1 rounded-2">
               EASY PARKIR
            </text>
         </span>
      </div>
   </nav>

   <div class="p-3 position-absolute top-50 start-50 translate-middle">
      <div class="card" style="height : 25rem; width: 25rem;">
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
               <form action="" method="post">
                  <input type="text" name="platNo" id="platNo" class="form-control" placeholder="Masukan Plat Nomor">
                  <select class="form-select mt-2" aria-label="Default select example" name="merk" id="merk">
                     <option selected>Pilih Merk</option>
                     <option value="1">Yamaha</option>
                     <option value="2">Honda</option>
                     <option value="3">Kawasaki</option>
                     <option value="4">Suzuki</option>
                     <option value="5">Lainnya</option>
                  </select>
                  <input type="hidden" name="waktuMasuk" value="">
               </form>
            </div>

            <div id="keluar" class="content">
               <!-- Konten untuk tombol keluar -->
               <h4>Keluar Parkir</h2>
               <form action="" method="post">

               </form>
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

   <script>
      function showContent(contentId) {
         var contents = document.getElementsByClassName("content");
         for (var i = 0; i < contents.length; i++) {
            contents[i].style.display = "none"; // Sembunyikan semua konten
         }
         document.getElementById(contentId).style.display = "block"; // Tampilkan konten yang sesuai dengan tombol yang diklik
      }
   </script>
</body>

</html>