<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
/* Gaya untuk dark mode */
.dark-mode {
    background-color: #222; /* Warna latar belakang */
    color: #fff; /* Warna teks */
}

/* Gaya untuk tombol dark mode */
#dark-mode-toggle {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 9999;
}

.container {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.card {
    background-color: #fff; /* Warna latar belakang kartu */
    color: #333; /* Warna teks pada kartu */
}

.card-header {
    background-color: #fff; /* Warna latar belakang header kartu */
}

.card-body {
    background-color: #fff; /* Warna latar belakang body kartu */
}

.form-control {
    background-color: #fff; /* Warna latar belakang input */
    color: #000; /* Warna teks input */
}

.dark-mode .card {
    background-color: #333; /* Warna latar belakang kartu */
    color: #fff; /* Warna teks pada kartu */
}

.dark-mode .card-header {
    background-color: #555; /* Warna latar belakang header kartu */
}

.dark-mode .card-body {
    background-color: #333; /* Warna latar belakang body kartu */
}

.dark-mode .form-control {
    background-color: #444; /* Warna latar belakang input */
    color: #fff; /* Warna teks input */
}

.btn {
    background-color: #444; /* Warna latar belakang tombol */
    color: #fff; /* Warna teks tombol */
}

.btn-primary {
    background-color: #007bff; /* Warna latar belakang tombol utama */
}

.btn-link {
    color: #007bff; /* Warna teks tombol link */
}
/* CSS untuk posisi timer */
#timer-container {
  position: fixed;
  bottom: 2%;
  left: 50%;
  transform: translate(-50%, 0%);
  /* background-color: #f0f0f0; */
  padding: 2px 10px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

#timer {
  font-size: 12px;
}
    </style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><center><strong><h4>SCAN QR CODE USER UNTUK LOGIN</h4></center></strong></div>
                    <div class="card-body">
                        <form id="loginForm" action="login_process.php" method="post">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="register.php" class="btn btn-link">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="dark-mode-toggle" class="btn"><i class="fas fa-moon" title="Dark Mode"></i></button>
    <button id="fullscreen-toggle" class="btn" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"
        title="FullScreen Mode"><i class="fas fa-expand"></i></button>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        const isDarkMode = body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
        updateDarkModeButton(isDarkMode);
    });

    // Cek apakah dark mode telah diaktifkan sebelumnya
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    body.classList.toggle('dark-mode', isDarkMode);
    updateDarkModeButton(isDarkMode);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fullscreenToggle = document.getElementById('fullscreen-toggle');

    // Fungsi untuk meminta mode fullscreen
    function toggleFullScreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    fullscreenToggle.addEventListener('click', toggleFullScreen);
    
});
</script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var inputField1 = document.getElementById('email');
    var inputField2 = document.getElementById('password');
    
    inputField1.focus(); // Focus on the first input field
    
    // Event listener to check if the value of inputField1 ends with ".com" and focus on inputField2
    inputField1.addEventListener('input', function() {
        if (inputField1.value.endsWith('.com')) {
            inputField2.focus(); // Focus on the second input field
        }
    });

    // Event listener to handle clicks outside the input fields
    document.addEventListener('click', function(event) {
        if (event.target !== inputField1 && event.target !== inputField2) {
            // If clicked outside both input fields
            inputField1.focus(); // Focus back on the first input field
        }
    });
});
</script>
<div id="timer-container">
  <div id="timer">timer</div>
</div>

<script>
// Waktu awal dalam detik
let timeLeft = 60; // 1 menit

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
  timerElement.innerHTML = 'Screensaver Dashboard akan muncul dalam: '+ minutes + ':' + seconds;
}

// Fungsi untuk mengurangi waktu
function countdown() {
  timeLeft--;

  // Perbarui tampilan timer
  updateTimer();

  // Jika waktu habis
  if (timeLeft <= 0) {
    // Redirect ke logout.php
    window.location.href = 'screensaver.php';
  }
}

// Mulai hitung mundur setiap detik
const timerInterval = setInterval(countdown, 1000);

// Memastikan tampilan timer terupdate pertama kali
updateTimer();
</script>
</body>
</html>
