<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Tambahkan kode modal di luar dari loop -->
<?php
    // Tampilkan card dengan tabel-tabel yang sudah dikelompokkan
    foreach ($asset_data as $nama => $table) {
        // Buat DOMDocument untuk mem-parsing HTML
        $dom = new DOMDocument();
        // Lakukan parsing HTML dari tabel
        $dom->loadHTML($table);
        // Dapatkan jumlah elemen <tr> dalam tabel
        $total_rows = $dom->getElementsByTagName('tr')->length;

        // Kurangi satu dari jumlah baris yang dihitung
        $total_rows--;

        // Tambahkan jumlah baris data di card-footer
        echo "
        <div class='col-md-3'>
            <div class='card mb-3'>
                <div class='card-header'>
                    <h3><strong><center>$nama</center></h3></strong>
                </div>
                <div class='card-body'>$table</tbody></table></div>
                <div class='card-footer'>SEDANG PINJAM <span class='badge'>$total_rows</span></div>
            </div>
        </div>";
    }

    // Kode modal
    foreach ($asset_data as $id => $table) {
        echo "<div class='modal fade' id='deleteModal_$id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Konfirmasi Hapus</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                            <a href='index.php?delete_id=$id' class='btn btn-danger'>Hapus</a>
                        </div>
                    </div>
                </div>
            </div>";
    }
?>

<!-- Tambahkan link ke Bootstrap JavaScript dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
