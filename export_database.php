<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=export.xls");
//inisialisasi session
session_start();
//mengecek username pada session
if( !isset($_SESSION['name']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel</title>
</head>
<body>
<table  border="1">
		<thead>
			<tr>
                <th>Nomor</th>
                <th>Model</th>
                <th>Nomor Asset</th>
                <th>Serial Number</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Timestamp</th>
			</tr>
		</thead>	
		<?php 



$koneksi = mysqli_connect("localhost","root","","scan");
$pengguna = $_SESSION['name'];
$query_mysql = mysqli_query($koneksi,"SELECT * FROM `database_sample` WHERE 1 ORDER BY `database_sample`.`id` DESC ");
$nomor = 1;
while($data = mysqli_fetch_array($query_mysql)){
	$kodewarna = $data['status'];
	

if(strpos($kodewarna,'PINJAM')!==false){
	$warna='#F6635C';
  }
  elseif(strpos($kodewarna,'KEMBALI')!==false){
	$warna='#428bca';
  }	
  else{
	$warna= '#fff';
  }		
		echo "<tbody>";
		echo "<tr>";
		echo "<td style='text-align:center;'>".$nomor++."</td>";
        echo "<td>".$data['model']."</td>";
        echo "<td>".$data['nomor_asset']."</td>";
        echo "<td>".$data['sn']."</td>";
        echo "<td>".$data['name']."</td>";
		echo "<td style='text-align:center;' bgcolor=$warna>".$data['status']."</td>";
        echo "<td>".$data['timestamp']."</td>";
		echo "</tr>";		
		echo "</tbody>";
		?>
		<?php } ?>
	</table>
</body>
</html>