<?php
$conn = mysqli_connect('localhost', 'root', '', 'scan');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $nomor_asset = $_POST['nomor_asset'];
    $status = $_POST['status'];

    // Mendapatkan data sebelum update
    $query = "SELECT * FROM database_sample WHERE nomor_asset='$nomor_asset'";
    $result = mysqli_query($conn, $query);
    $dataBeforeUpdate = mysqli_fetch_assoc($result);
    $model = $dataBeforeUpdate['model']; // Tambahkan variabel model


    // Jika nama sama dengan sebelumnya
    if ($name == $dataBeforeUpdate['name']) {
        // Jika status sebelumnya "pinjam", set status baru menjadi "kembali"
        if ($dataBeforeUpdate['status'] == 'PINJAM') {
            $newStatus = 'KEMBALI';
        } else {
            $newStatus = 'PINJAM';
        }
    } else {
        // Jika nama berbeda dengan sebelumnya, gunakan status yang di-post dari form
        // $newStatus = $status;
        $newStatus = 'PINJAM';
    }

    $timestamp = date('Y-m-d H:i:s'); // Timestamp saat ini

    // Menyimpan riwayat timestamp ke dalam 1 kolom database
    // $history = array($timestamp, $name);
    // $historyImploded = implode(',', $history);

    // Update data di tabel utama
    $query = "UPDATE database_sample SET name='$name', nomor_asset='$nomor_asset', status='$newStatus', timestamp='$timestamp' WHERE nomor_asset='$nomor_asset'";
    mysqli_query($conn, $query);

    // Simpan riwayat timestamp ke dalam tabel sample
    $insertQuery = "INSERT INTO flow_sample (name, nomor_asset, status, model, timestamp) VALUES ('$name', '$nomor_asset', '$newStatus', '$model', '$timestamp')"; // Perbarui query INSERT
    mysqli_query($conn, $insertQuery);
    header("Location: index.php"); // Redirect kembali ke halaman tampilan
}
?>
