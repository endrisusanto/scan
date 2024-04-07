<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

            /* Gaya untuk dark mode */
    .dark-mode {
        background-color: #222;
        color: #fff;
    }
/* Gaya untuk tombol dark mode */
#dark-mode-toggle {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 9999;
}
.btn {
    background-color: #444; /* Warna latar belakang tombol */
    color: #fff; /* Warna teks tombol */
}
</style>
</head>
<body>
    <div class="container mt-5">
        <h2>Update Data</h2>
        <?php
            $id = $_GET['id']; // Mendapatkan ID data yang akan diupdate
            // Mendapatkan data dari database berdasarkan ID
            $conn = mysqli_connect('localhost', 'root', '', 'scan');
            $query = "SELECT * FROM database_sample WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);
        ?>
        <form action="update_process.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name']; ?>">
            </div>
            <div class="form-group">
                <label for="nomor_asset">Nomor Asset:</label>
                <input type="text" class="form-control" id="nomor_asset" name="nomor_asset" value="<?php echo $data['nomor_asset']; ?>">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" disabled>
                    <option value="PINJAM" <?php if($data['status'] == 'PINJAM') echo 'selected'; ?>>PINJAM</option>
                    <option value="KEMBALI" <?php if($data['status'] == 'KEMBALI') echo 'selected'; ?>>KEMBALI</option>
                </select>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
</body>
</html>
