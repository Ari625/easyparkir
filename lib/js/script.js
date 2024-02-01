function showContent(contentId) {
   var contents = document.getElementsByClassName("content");
   for (var i = 0; i < contents.length; i++) {
     contents[i].style.display = "none"; // Sembunyikan semua konten
   }
   document.getElementById(contentId).style.display = "block"; // Tampilkan konten yang sesuai dengan tombol yang diklik
}

function displayTime() {
   var now = new Date();
   var hours = now.getHours();
   var minutes = now.getMinutes();
   var seconds = now.getSeconds();

   // Menambahkan nol di depan angka jika angka tersebut kurang dari 10
   hours = addZeroPadding(hours);
   minutes = addZeroPadding(minutes);
   seconds = addZeroPadding(seconds);

   var timeString = hours + ":" + minutes + ":" + seconds;
   document.getElementById("current-time").textContent = timeString;
}

function addZeroPadding(number) {
   if (number < 10) {
      return "0" + number;
   } else {
      return number;
   }
}

// Memperbarui waktu setiap detik
setInterval(displayTime, 1000);