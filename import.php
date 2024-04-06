<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Upload Excel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Tambahkan Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
        .upload-form {
            position: fixed;
            top: 20px; /* Sesuaikan dengan jarak dari atas yang diinginkan */
            right: 20px; /* Sesuaikan dengan jarak dari kanan yang diinginkan */
            z-index: 1000; /* Pastikan form ada di atas konten lain */
    }
    </style>
<body>
    <div class="upload-form">
        <!-- Konten lain di sini -->
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#importModal">
        <span class="fa fa-upload"></span>
        </button>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Form Upload Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excelFile">Pilih File Excel:</label>
                            <input type="file" class="form-control-file" id="excelFile" name="excelFile" accept=".xls,.xlsx">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
