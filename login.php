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
                            <a href="register.php" class="btn btn-link">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var inputField1 = document.getElementById('email');
    var inputField2 = document.getElementById('password');
    
    inputField1.focus(); // Focus on the first input field
    
    // Event listener to check if the value of inputField1 ends with ".com" and focus on inputField2
    inputField1.addEventListener('input', function() {
        if (inputField1.value.endsWith('.com')) {
            inputField2.focus(); // Focus on the second input field
        }
    });

    // Event listener to handle clicks outside the input fields
    document.addEventListener('click', function(event) {
        if (event.target !== inputField1 && event.target !== inputField2) {
            // If clicked outside both input fields
            inputField1.focus(); // Focus back on the first input field
        }
    });
});
</script>

</body>
</html>
