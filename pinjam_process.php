<?php
// Mengatur zona waktu ke GMT +7
date_default_timezone_set('Asia/Jakarta'); // Zona waktu untuk GMT +7

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'scan');

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['nomor_asset'])) {
        $name = $_POST['name'];
        $nomor_asset = $_POST['nomor_asset'];

        // Mendapatkan data sebelum update
        $query = "SELECT * FROM database_sample WHERE nomor_asset='$nomor_asset'";
        $result = mysqli_query($conn, $query);
        
        // Memeriksa apakah query berhasil dan data tersedia
        if ($result && mysqli_num_rows($result) > 0) {
            $dataBeforeUpdate = mysqli_fetch_assoc($result);

            // Pastikan dataBeforeUpdate bukan null
            if ($dataBeforeUpdate && isset($dataBeforeUpdate['nomor_asset']) && $dataBeforeUpdate['nomor_asset'] === $nomor_asset) {
                // Mendapatkan model jika tersedia
                $model = isset($dataBeforeUpdate['model']) ? $dataBeforeUpdate['model'] : null;
                $previous_name = isset($dataBeforeUpdate['name']) ? $dataBeforeUpdate['name'] : null;
                $previous_status_pinjam = isset($dataBeforeUpdate['status_pinjam']) ? $dataBeforeUpdate['status_pinjam'] : null;

                // Jika nama yang di-post sama dengan nama sebelumnya
                if ($name === $previous_name) {
                    // Jika status_pinjam sebelumnya adalah 'PINJAM'
                    if ($previous_status_pinjam === 'PINJAM') {
                        $_SESSION['alert_message'] = "KEMBALI";
                        // Ubah status_pinjam menjadi 'KEMBALI'
                        $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini
                        $newstatus_pinjam = 'KEMBALI';
                        echo "<div class='alert alert-success' role='alert'>SAMPLE: ".$model."<br>NO. ASSET: ".$nomor_asset."<br>BERHASIL DIKEMBALIKAN <br>PIC: ".$name."</div>";
                        echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";

                        // Update data di tabel utama
                        $updateQuery = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status_pinjam='$newstatus_pinjam', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
                        mysqli_query($conn, $updateQuery);

                        // Simpan riwayat ke tabel flow_sample
                        $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status_pinjam, model, timestamp) VALUES ('$name', '$nomor_asset', '$newstatus_pinjam', '$model', '$timestamp')";
                        mysqli_query($conn, $insertQuery);
                        header("location:index.php");

                    } else {
                        $_SESSION['alert_message'] = "PINJAM";
                        // Jika status_pinjam sebelumnya bukan 'PINJAM', maka ubah status_pinjam menjadi 'PINJAM'
                        $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini
                        $newstatus_pinjam = 'PINJAM';
                        echo "<div class='alert alert-info' role='alert'>SAMPLE: ".$model."<br>NO. ASSET: ".$nomor_asset."<br>PEMINJAM: ".$name."</div>";
                        echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";

                        // Update data di tabel utama
                        $updateQuery = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status_pinjam='$newstatus_pinjam', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
                        mysqli_query($conn, $updateQuery);

                        // Simpan riwayat ke tabel flow_sample
                        $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status_pinjam, model, timestamp) VALUES ('$name', '$nomor_asset', '$newstatus_pinjam', '$model', '$timestamp')";
                        mysqli_query($conn, $insertQuery);
                        header("location:index.php");

                    }
                } else {
                    $_SESSION['alert_message'] = "BERGANTI";
                    // Jika nama yang di-post berbeda dengan nama sebelumnya
                    $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini
                    $newstatus_pinjam = 'PINJAM';
                    
                    echo "<div class='alert alert-info' role='alert'>SAMPLE: ".$model."<br>NO. ASSET: ".$nomor_asset."<br>PEMINJAM BERGANTI: ".$name."</div>";
                    echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
                    
                    // Update data di tabel utama
                    $updateQuery = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status_pinjam='$newstatus_pinjam', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
                    mysqli_query($conn, $updateQuery);

                    // Simpan riwayat ke tabel flow_sample
                    $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status_pinjam, model, timestamp) VALUES ('$name', '$nomor_asset', '$newstatus_pinjam', '$model', '$timestamp')";
                    mysqli_query($conn, $insertQuery);
                    header("location:index.php");

                            }
            } else {
                $_SESSION['alert_message'] = "TIDAK_TERSEDIA";
                // Jika dataBeforeUpdate tidak ada, tampilkan pesan
                echo "<div class='alert alert-danger' role='alert'>DATA TIDAK TERSEDIA</div>";
                echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
                header("location:index.php");

            }
        } else {
            $_SESSION['alert_message'] = "TIDAK_TERSEDIA";
            // Jika query tidak berhasil atau tidak ada data
            echo "<div class='alert alert-danger' role='alert'>DATA TIDAK TERSEDIA</div>";
            echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
            header("location:index.php");

        }
    } else {
        $_SESSION['alert_message'] = "TIDAK_TERSEDIA";
        // Jika data POST tidak tersedia
        echo "<div class='alert alert-info' role='alert'>DATA POST TIDAK TERSEDIA</div>";
        echo "<script>setTimeout(function() {document.querySelector('.alert').style.display = 'none';}, 3000);</script>";
        header("location:index.php");

    }
}


?>