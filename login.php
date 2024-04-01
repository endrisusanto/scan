<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><center><strong>Login Sample Management TKDN SW</center></strong></div>
                    <div class="card-body">
                        <form id="loginForm" action="login_process.php" method="post">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to parse QR code value and auto-fill form fields
        function parseQRCodeValue(value) {
            // Split the value by tab character
            var parts = value.split('/');

            // Fill the email and password fields
            document.getElementById('email').value = parts[0];
            document.getElementById('password').value = parts[1];

            // Submit the form
            document.getElementById('loginForm').submit();
        }

        // Function to check if the QR code value is received
        function checkQRCode() {
            // Replace this with your actual QR scanning logic
            var scannedQRValue = prompt("SCAN QR CODE USER UNTUK LOGIN");
            if (scannedQRValue != null) {
                parseQRCodeValue(scannedQRValue);
            }
        }

        // Event listener to submit the form when Enter is pressed after filling both inputs
        document.addEventListener('DOMContentLoaded', function() {
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');

            emailInput.addEventListener('keyup', function(event) {
                if (event.keyCode === 13 && passwordInput.value !== '') {
                    event.preventDefault();
                    document.getElementById('loginForm').submit();
                }
            });

            passwordInput.addEventListener('keyup', function(event) {
                if (event.keyCode === 13 && emailInput.value !== '') {
                    event.preventDefault();
                    document.getElementById('loginForm').submit();
                }
            });
        });
        // Function to check QR code after 5 seconds
        setTimeout(function() {
        checkQRCode();
        }, 2000);

        // Call the function to check QR code when the page loads
        // window.onload = checkQRCode;
    </script>
</body>
</html>
