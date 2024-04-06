<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$database = "scan";
$table = "database_sample";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Load library PHPSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Periksa apakah file berhasil diupload
if (isset($_POST["submit"])) {
    // Periksa apakah file telah dipilih
    if ($_FILES["excelFile"]["error"] == 0) {
        // Mendapatkan nama file dan ekstensinya
        $fileName = $_FILES["excelFile"]["name"];
        $fileTmpName = $_FILES["excelFile"]["tmp_name"];

        // Periksa ekstensi file
        $allowedExtensions = array('xls', 'xlsx');
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (in_array($fileExtension, $allowedExtensions)) {
            // Pindahkan file ke direktori yang ditentukan
            $uploadPath = 'uploads/' . $fileName;
            move_uploaded_file($fileTmpName, $uploadPath);

            // Load file Excel
            $spreadsheet = IOFactory::load($uploadPath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // Mulai dari baris kedua (karena baris pertama adalah header)
            foreach ($sheetData as $row) {
                // Ambil data Nama dan Nomor_asset dari kolom A dan B
                $nama = $row['A'];
                $nomor_asset = $row['B'];

                // Query untuk memasukkan data ke dalam tabel product
                $sql = "INSERT INTO $table (model, nomor_asset) VALUES ('$nama', '$nomor_asset')";

                if ($conn->query($sql) === TRUE) {
                    // echo "Data berhasil diimpor: $nama, $nomor_asset<br>";
                    header("location:index.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Hanya file Excel (.xls, .xlsx) yang diperbolehkan.";
        }
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
}

// Tutup koneksi
$conn->close();
?>
