<?php
$conn = mysqli_connect("localhost", "root", "", "easyparkir");
$icon = "<link rel='shortcut icon' href='lib/icon/icon.png' type='image/x-icon'>";
$title = "<title>EASY PARKIR</title>";

function query($query)
{
   global $conn;
   $result = mysqli_query($conn, $query);
   $rows = [];
   while ($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
   }
   return $rows;
}

function tambahDataMasuk($data)
{
   global $conn;
   $platNo = htmlspecialchars($data["platNo"]);
   $merk = htmlspecialchars($data["merk"]);
   $waktuMasuk = $data["waktuMasuk"];

   $gambar = upload();
   if (!$gambar) {
      return false;
   }

   try {
      $query = "INSERT INTO k_masuk value ('$platNo','$waktuMasuk','$merk', '$gambar')";
      mysqli_query($conn, $query);
   } catch (exception $e) {
      return 0;
   }
   return mysqli_affected_rows($conn);
}

function tambahDataKeluar($data)
{
   global $conn;
   $platNo = htmlspecialchars($data["platNo"]);
   $merk = htmlspecialchars($data["merk"]);
   $waktuMasuk = $data["waktuMasuk"];
   $waktuKeluar = $data["waktuKeluar"];
   $gambar = $data["gambar"];

   try {
      $query = "INSERT INTO k_keluar value ('','$platNo','$waktuMasuk','$waktuKeluar','$merk', '$gambar')";
      mysqli_query($conn, $query);
      $query2 = "DELETE FROM `k_masuk` WHERE `k_masuk`.`plat_no` = '$platNo'";
      mysqli_query($conn, $query2);
   } catch (exception $e) {
      return 0;
   }

   return mysqli_affected_rows($conn);
}

function upload()
{
   $namaFile = $_FILES["gambar"]["name"];
   $ukuranFile = $_FILES["gambar"]["size"];
   $error = $_FILES["gambar"]["error"];
   $tmpName = $_FILES["gambar"]["tmp_name"];

   if ($error === 4) {
      echo "<script>
            alert('Pilih Gambar Terlebih Dahulu');
            </script>";
      return false;
   }
   $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode('.', $namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));
   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
            alert('Yang Anda Upload Bukan Gambar!');
            </script>";
      return false;
   }
   if ($ukuranFile > 209715200) {
      echo "<script>
            alert('Ukuran Gambar Terlalu Besar');
            </script>";
      return false;
   }

   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $ekstensiGambar;

   move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

   return $namaFileBaru;
}

function cari($keyword)
{
   $query = "SELECT * FROM k_masuk WHERE plat_no LIKE '%$keyword%'";

   return query($query);
}
?>