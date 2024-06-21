<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch admin user details based on username
    $sql = "SELECT * FROM users WHERE username = '$username' AND role = 'admin'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role']; // Store user role in session

            // Redirect to the admin page
            header('Location: admin.php');
            exit;
        } else {
            $error = "Password incorrect.";
        }
    } else {
        $error = "Admin username not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .login-form {
            margin: 100px auto;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #ccc;
        }
        .login-form label {
            margin-bottom: 0.5rem;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            margin-bottom: 1rem;
        }
        .login-form button {
            width: 100%;
            padding: 8px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        footer {
            background-color: #007bff;
            height: 130px;
            text-align: center;
            color: white;
            padding: 20px 0;
        }
        section
        {
            height: 698px;
            background-color: greenyellow;
        }
    </style>
</head>
<body>
    <header
    class="bg-warning text-white text-center py-3">
        <h1>KNLS E-RESOURCE MANAGEMENT SYSTEM</h1>
        <h2>ADMIN</h2>
    </header>
    <section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="login-form">
                    <h1 class="text-center mb-4">Admin Login</h1>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    <footer>
     <p>&copy; <?php echo date("Y"); ?>
 </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
