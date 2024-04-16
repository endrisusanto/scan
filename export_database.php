<?php
// Inisialisasi session
session_start();

// Mengecek username pada session
if (!isset($_SESSION['name'])) {
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
    exit();
}

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "scan");

// Query untuk mengambil data dari database dengan kolom-kolom yang diberikan
$query_mysql = mysqli_query($koneksi, "SELECT `model`, `nomor_asset`, `sn`, `name`, `status_pinjam`, `status_audit`, `latest_check`, `pic_sample`, `timestamp`, `Barcode`, `Unrec_Asset`, `Type`, `Manufacture_Date`, `Asset_Class`, `Category`, `SET_PBA`, `Purpose`, `Purpose_Detail`, `Status`, `IMEI_Original_Serial_No`, `Cost_Center`, `Model_SKU`, `Model_Desc`, `Qty`, `Submitter`, `Controller`, `Location`, `Dept`, `Holder`, `Business_Area`, `Plant`, `Manufacture_Sources`, `Expired_Date`, `Abolish_Status`, `Create_By`, `Create_Date`, `Updated_By`, `Updated_Date` FROM `database_sample` WHERE 1 ORDER BY `id` DESC");

// Menginisialisasi buffer output
ob_clean();

// Mengatur header Excel
header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=export.xls");

// Membuat tabel HTML
echo "<table border='1'>
        <thead>
            <tr>
                <th>Model</th>
                <th>Nomor Asset</th>
                <th>Serial</th>
                <th>Peminjam Terakhir</th>
                <th>Status Pinjam</th>
                <th>Status Audit</th>
                <th>Latest Check</th>
                <th>Pic Sample</th>
                <th>Timestamp</th>
                <th>Barcode</th>
                <th>Unrec Asset</th>
                <th>Type</th>
                <th>Manufacture Date</th>
                <th>Asset Class</th>
                <th>Category</th>
                <th>SET PBA</th>
                <th>Purpose</th>
                <th>Purpose Detail</th>
                <th>Status</th>
                <th>IMEI Original Serial No</th>
                <th>Cost Center</th>
                <th>Model SKU</th>
                <th>Model Desc</th>
                <th>Qty</th>
                <th>Submitter</th>
                <th>Controller</th>
                <th>Location</th>
                <th>Dept</th>
                <th>Holder</th>
                <th>Business Area</th>
                <th>Plant</th>
                <th>Manufacture Sources</th>
                <th>Expired Date</th>
                <th>Abolish Status</th>
                <th>Create By</th>
                <th>Create Date</th>
                <th>Updated By</th>
                <th>Updated Date</th>
            </tr>
        </thead>
        <tbody>";

// Mendapatkan data dari hasil query
while ($data = mysqli_fetch_array($query_mysql)) {

    // Menambahkan baris tabel dengan data yang diambil
    echo "<tr>";
    echo "<td>" . $data['model'] . "</td>";
    echo "<td>" . $data['nomor_asset'] . "</td>";
    echo "<td>" . $data['sn'] . "</td>";
    echo "<td>" . $data['name'] . "</td>";
    echo "<td>" . $data['status_pinjam'] . "</td>";
    echo "<td>" . $data['status_audit'] . "</td>";
    echo "<td>" . $data['latest_check'] . "</td>";
    echo "<td>" . $data['pic_sample'] . "</td>";
    echo "<td>" . $data['timestamp'] . "</td>";
    echo "<td>" . $data['Barcode'] . "</td>";
    echo "<td>" . $data['Unrec_Asset'] . "</td>";
    echo "<td>" . $data['Type'] . "</td>";
    echo "<td>" . $data['Manufacture_Date'] . "</td>";
    echo "<td>" . $data['Asset_Class'] . "</td>";
    echo "<td>" . $data['Category'] . "</td>";
    echo "<td>" . $data['SET_PBA'] . "</td>";
    echo "<td>" . $data['Purpose'] . "</td>";
    echo "<td>" . $data['Purpose_Detail'] . "</td>";
    echo "<td>" . $data['Status'] . "</td>";
    echo "<td>" . $data['IMEI_Original_Serial_No'] . "</td>";
    echo "<td>" . $data['Cost_Center'] . "</td>";
    echo "<td>" . $data['Model_SKU'] . "</td>";
    echo "<td>" . $data['Model_Desc'] . "</td>";
    echo "<td>" . $data['Qty'] . "</td>";
    echo "<td>" . $data['Submitter'] . "</td>";
    echo "<td>" . $data['Controller'] . "</td>";
    echo "<td>" . $data['Location'] . "</td>";
    echo "<td>" . $data['Dept'] . "</td>";
    echo "<td>" . $data['Holder'] . "</td>";
    echo "<td>" . $data['Business_Area'] . "</td>";
    echo "<td>" . $data['Plant'] . "</td>";
    echo "<td>" . $data['Manufacture_Sources'] . "</td>";
    echo "<td>" . $data['Expired_Date'] . "</td>";
    echo "<td>" . $data['Abolish_Status'] . "</td>";
    echo "<td>" . $data['Create_By'] . "</td>";
    echo "<td>" . $data['Create_Date'] . "</td>";
    echo "<td>" . $data['Updated_By'] . "</td>";
    echo "<td>" . $data['Updated_Date'] . "</td>";
    echo "</tr>";
}

echo "</tbody></table>";
?>
