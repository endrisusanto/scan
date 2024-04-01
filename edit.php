<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data</h2>
        <?php
        include 'koneksi.php';

        $id = $_GET['id'];

        $sql = "SELECT * FROM sample WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <form action="edit_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="nomor_asset">Nomor Asset:</label>
                <input type="text" class="form-control" id="nomor_asset" name="nomor_asset" value="<?php echo $row['nomor_asset']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php
        } else {
            echo "Data tidak ditemukan";
        }

        $conn->close();
        ?>
    </div>
    <!-- Tambahkan script Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
