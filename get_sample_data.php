<?php
$conn = mysqli_connect('localhost', 'root', '', 'scan');
if(isset($_GET['nomor_asset'])) {
    $nomorAsset = $_GET['nomor_asset'];
    $query = "SELECT * FROM flow_sample WHERE nomor_asset='$nomorAsset'";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Flow Sample</title>
    <!-- Memuat Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS kustom untuk warna latar belakang dan teks -->
    <style>
        .pinjam { background-color: red; color: white; }
        .kembali { background-color: green; color: white; }
        .timeline {
            list-style: none;
            padding: 20px 0;
            position: relative;
        }
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 5px;
            background-color: #676767;
            left: 50%;
            margin-left: -2px;
        }
        .timeline-item {
            margin-bottom: 50px;
            position: relative;
        }
        .timeline-item:before,
        .timeline-item:after {
            content: "";
            display: table;
        }
        .timeline-item:after {
            clear: both;
        }
        .timeline-item .timeline-content {
            position: relative;
            width: 45%;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            float: left;
        }
        .timeline-item .timeline-content.PINJAM {
            float: right;
			background-color: #D37676;
			color: white;
					 
        }
		.timeline-item .timeline-content.KEMBALI {
        background-color: #78A083;
        color: white;
		}
        .timeline-item .timeline-content .status {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .timeline-item .timeline-content.PINJAM .status {
            color: #fff;
        }
        .timeline-item .timeline-content.KEMBALI .status {
            color: #fff;
        }
        .timeline-badge {
        width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 1em;
        text-align: center;
        position: absolute;
        left: 50%;
        margin-left: -15px;
        background-color: #858585;
        color: #fff;
        border-radius: 50%;
        z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <ul class="timeline">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <li class="timeline-item">
            <div class="timeline-badge"><i class="fa fa-mobile"></i></div>

                <div class="timeline-content <?php echo $row['status'] == 'PINJAM' ? 'PINJAM' : 'KEMBALI'; ?>">
                    <div class="status"><?php echo $row['status']; ?></div>
                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="nomor-asset"><?php echo $row['nomor_asset']; ?></div>
                    <div class="timestamp"><?php echo $row['timestamp']; ?></div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!-- Memuat Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
}
?>
