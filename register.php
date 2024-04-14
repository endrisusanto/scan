<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    </style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><center><h4>REGISTER AKUN TKDN SW PORTAL</h3></center></div>
                    <div class="card-body">
                        <form id="registerForm" action="register_process.php" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" onkeyup="convertToUppercase(this)" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" onkeyup="convertToLowercase(this)" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                            <label for="terms" class="form-label">Syarat dan Ketentuan</label>
                            <textarea class="form-control" id="terms" rows="6" disabled>
**Syarat dan Ketentuan Penggunaan Sistem Inventory Peminjaman Sample Development TKDN SW**

Mohon diperhatikan dengan seksama syarat dan ketentuan penggunaan yang tercantum di sini.

1. Penerimaan Syarat dan Ketentuan
   Dengan mengakses atau menggunakan sistem inventory peminjaman sample development TKDN SW ini, Anda secara tegas menyetujui untuk terikat dengan syarat dan ketentuan penggunaan yang tercantum di sini. Jika Anda tidak setuju dengan syarat dan ketentuan ini, mohon untuk tidak menggunakan sistem ini.

2. Tujuan Penggunaan
   Sistem ini dirancang untuk keperluan pengelolaan inventaris dan peminjaman sample development TKDN SW. Penggunaan sistem ini harus sesuai dengan tujuan tersebut dan tidak boleh digunakan untuk kegiatan yang melanggar hukum atau melanggar hak kekayaan intelektual pihak lain.

3. Pendaftaran dan Keamanan Akun
   Untuk menggunakan sistem ini, Anda mungkin perlu mendaftar dan membuat akun pengguna. Anda bertanggung jawab penuh untuk menjaga kerahasiaan informasi akun Anda, termasuk kata sandi. Anda juga bertanggung jawab atas semua aktivitas yang terjadi di bawah akun Anda.

4. Kewajiban Pengguna
   Anda setuju untuk menggunakan sistem ini hanya untuk tujuan yang sah dan sesuai dengan hukum yang berlaku. Anda juga setuju untuk tidak mengganggu atau merusak sistem, infrastruktur, atau keamanan sistem ini, termasuk tetapi tidak terbatas pada mencoba mengakses informasi yang tidak sah atau mencoba meretas sistem.

5. Pembaruan dan Perubahan
   Syarat dan ketentuan penggunaan sistem ini dapat diperbarui atau diubah dari waktu ke waktu tanpa pemberitahuan sebelumnya. Dengan terus menggunakan sistem ini setelah perubahan tersebut, Anda secara tegas menyetujui versi terbaru dari syarat dan ketentuan.

6. Pemeliharaan dan Dukungan
   Kami berhak melakukan pemeliharaan atau perbaikan sistem yang mungkin mengakibatkan gangguan atau tidak tersedianya layanan untuk sementara waktu. Kami akan berupaya memberikan pemberitahuan sebelumnya jika memungkinkan.

7. Penutup
   Penggunaan sistem ini sepenuhnya menjadi tanggung jawab pengguna. Kami tidak bertanggung jawab atas kerugian atau kerusakan yang disebabkan oleh penggunaan sistem ini, termasuk tetapi tidak terbatas pada kerugian data atau gangguan layanan.

Dengan menyetujui syarat dan ketentuan penggunaan ini, Anda setuju untuk mematuhi semua ketentuan yang tercantum di atas. Jika Anda memiliki pertanyaan atau kekhawatiran mengenai syarat dan ketentuan ini, silakan hubungi kami untuk klarifikasi lebih lanjut.
</textarea>
                            </div>
                            <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agree" disabled>
                            <label class="form-check-label" for="agree">Saya setuju dengan syarat dan ketentuan</label>
                            </div>
                            <button type="submit" class="btn btn-primary" id="registerBtn">Register</button>
                            <a href="login.php" class="btn btn-link">Login</a>
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
    // Mendapatkan elemen form, textarea, checkbox, dan tombol
    const form = document.getElementById('registerForm');
    const termsTextarea = document.getElementById('terms');
    const agreeCheckbox = document.getElementById('agree');
    const registerBtn = document.getElementById('registerBtn');

    // Menambahkan event listener ketika textarea discroll
    termsTextarea.addEventListener('scroll', function(event) {
      // Mencegah default behavior scroll
      event.preventDefault();

      // Memeriksa apakah textarea sudah discroll hingga ke bawah
      if (this.scrollHeight - this.scrollTop === this.clientHeight) {
        // Jika sudah discroll hingga ke bawah, aktifkan checkbox dan tombol
        agreeCheckbox.disabled = false;
        registerBtn.disabled = false;
      } else {
        // Jika belum discroll hingga ke bawah, nonaktifkan checkbox dan tombol
        agreeCheckbox.disabled = true;
        registerBtn.disabled = true;
      }
    });

    // Menambahkan event listener ketika form disubmit
    form.addEventListener('submit', function(event) {
      // Mencegah default behavior submit
      event.preventDefault();

      // Memeriksa apakah checkbox dicentang
      if (!agreeCheckbox.checked) {
        alert('Anda harus menyetujui syarat dan ketentuan.');
      } else {
        // Jika checkbox dicentang, form akan disubmit
        this.submit();
      }
    });
  </script>
  <script>
function convertToUppercase(input) {
  input.value = input.value.toUpperCase();
}
function convertToLowercase(input) {
  input.value = input.value.toLowerCase();
}
</script>
</body>
</html>
