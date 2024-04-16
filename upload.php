<?php
// Atur batas waktu eksekusi skrip menjadi 1 menit (60 detik)
set_time_limit(60);

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
        $allowedExtensions = ['xls', 'xlsx'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (in_array($fileExtension, $allowedExtensions)) {
            // Pindahkan file ke direktori yang ditentukan
            $uploadPath = 'uploads/' . $fileName;
            move_uploaded_file($fileTmpName, $uploadPath);

            // Load file Excel
            $spreadsheet = IOFactory::load($uploadPath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // Mulai dari baris kedua (karena baris pertama adalah header)
            $rowCount = 0;
            $batchData = [];
            $batchSize = 100; // Ukuran batch untuk batch insert

            // Mulai transaksi
            $conn->begin_transaction();

            try {
                foreach ($sheetData as $row) {
                    // Skip header row
                    if ($rowCount == 0) {
                        $rowCount++;
                        continue;
                    }

                    // Ambil data dari baris
                    $model = $row['O'];
                    $nomor_asset = $row['B'];
                    $sn = $row['M'];
                    $pic_sample = $row['S'];
                    $Label = $row['B'];
                    $Barcode = $row['C']; // Gunakan kolom yang sesuai di array $row
                    $Unrec_Asset = $row['D']; // Gunakan kolom yang sesuai di array $row
                    $Type = $row['E'];
                    $Manufacture_Date = $row['F'];
                    $Asset_Class = $row['G'];
                    $Category = $row['H'];
                    $SET_PBA = $row['I'];
                    $Purpose = $row['J'];
                    $Purpose_Detail = $row['K'];
                    $Status = $row['L'];
                    $IMEI_Original_Serial_No = $row['M'];
                    $Cost_Center = $row['N'];
                    $Model_SKU = $row['O'];
                    $Model_Desc = $row['P'];
                    $Qty = $row['Q'];
                    $Submitter = $row['R'];
                    $Controller = $row['S'];
                    $Location = $row['T'];
                    $Dept = $row['U'];
                    $Holder = $row['V'];
                    $Business_Area = $row['W'];
                    $Plant = $row['X'];
                    $Manufacture_Sources = $row['Y'];
                    $Expired_Date = $row['Z'];
                    $Abolish_Status = $row['AA'];
                    $Create_By = $row['AB'];
                    $Create_Date = $row['AC'];
                    $Updated_By = $row['AD'];
                    $Updated_Date = $row['AE'];

                    // Kumpulkan data ke dalam batch
                    $batchData[] = [
                        $model, $nomor_asset, $row['M'], $row['S'], $row['B'], $row['C'], $row['D'],
                        $row['E'], $row['F'], $row['G'], $row['H'], $row['I'], $row['J'], $row['K'], $row['L'],
                        $row['M'], $row['N'], $row['O'], $row['P'], $row['Q'], $row['R'], $row['S'],
                        $row['T'], $row['U'], $row['V'], $row['W'], $row['X'], $row['Y'], $row['Z'], 
                        $row['AA'], $row['AB'], $row['AC'], $row['AD'], $row['AE']
                    ];

                    // Jika batch data mencapai ukuran batch yang ditentukan, lakukan batch insert
                    if (count($batchData) == $batchSize) {
                        // Persiapkan statement batch insert
                        $placeholders = implode(',', array_fill(0, count($batchData), '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'));
                        $stmt = $conn->prepare("INSERT INTO $table (
                            model, nomor_asset, sn, pic_sample, Label, Barcode, Unrec_Asset, Type, Manufacture_Date, Asset_Class, Category, SET_PBA, Purpose, Purpose_Detail, Status, IMEI_Original_Serial_No,
                            Cost_Center, Model_SKU, Model_Desc, Qty, Submitter, Controller, Location, Dept, Holder, Business_Area, Plant, Manufacture_Sources,
                            Expired_Date, Abolish_Status, Create_By, Create_Date, Updated_By, Updated_Date
                        ) VALUES $placeholders");
                        
                        // Ubah data batch menjadi satu array untuk bind
                        $bindData = [];
                        foreach ($batchData as $rowData) {
                            $bindData = array_merge($bindData, $rowData);
                        }
                        
                        // Bind data batch dan eksekusi statement
                        $stmt->bind_param(str_repeat('s', count($bindData)), ...$bindData);
                        $stmt->execute();
                        
                        // Kosongkan batch data untuk batch berikutnya
                        $batchData = [];
                    }

                    $rowCount++;
                }

                // Jika ada data tersisa dalam batchData, lakukan batch insert terakhir
                if (!empty($batchData)) {
                    $placeholders = implode(',', array_fill(0, count($batchData), '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'));
                    $stmt = $conn->prepare("INSERT INTO $table (
                        model, nomor_asset, sn, pic_sample, Label, Barcode, Unrec_Asset, Type, Manufacture_Date, Asset_Class, Category, SET_PBA, Purpose, Purpose_Detail, Status, IMEI_Original_Serial_No,
                        Cost_Center, Model_SKU, Model_Desc, Qty, Submitter, Controller, Location, Dept, Holder, Business_Area, Plant, Manufacture_Sources,
                        Expired_Date, Abolish_Status, Create_By, Create_Date, Updated_By, Updated_Date
                    ) VALUES $placeholders");
                    
                    // Ubah data batch menjadi satu array untuk bind
                    $bindData = [];
                    foreach ($batchData as $rowData) {
                        $bindData = array_merge($bindData, $rowData);
                    }
                    
                    // Bind data batch dan eksekusi statement
                    $stmt->bind_param(str_repeat('s', count($bindData)), ...$bindData);
                    $stmt->execute();
                }

                // Komit transaksi
                $conn->commit();
                header("location:index.php");
                echo "Data berhasil diimpor.";
            } catch (Exception $e) {
                // Jika ada kesalahan, batalkan transaksi
                $conn->rollback();
                echo "Terjadi kesalahan: " . $e->getMessage();
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
