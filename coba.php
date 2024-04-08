<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Timer Real-time</title>
</head>
<body>
<div id="timer"></div>

<script>
// Waktu awal dalam detik
let timeLeft = 300; // 1 menit

// Mendapatkan elemen timer
const timerElement = document.getElementById('timer');

// Fungsi untuk memperbarui tampilan timer
function updateTimer() {
  const minutes = Math.floor(timeLeft / 60);
  let seconds = timeLeft % 60;

  // Tambahkan nol di depan jika detik kurang dari 10
  if (seconds < 10) {
    seconds = '0' + seconds;
  }

  // Perbarui tampilan timer
  timerElement.innerHTML = 'Session akan berakhir dalam: '+ minutes + ':' + seconds;
}

// Fungsi untuk mengurangi waktu
function countdown() {
  timeLeft--;

  // Perbarui tampilan timer
  updateTimer();

  // Jika waktu habis
  if (timeLeft <= 0) {
    // Redirect ke logout.php
    window.location.href = 'logout.php';
  }
}

// Mulai hitung mundur setiap detik
const timerInterval = setInterval(countdown, 1000);

// Memastikan tampilan timer terupdate pertama kali
updateTimer();
</script>
</body>
</html>
