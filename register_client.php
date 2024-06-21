<?php
session_start();
include 'db.php'; // Ensure this includes your database connection script

// Check if the user is logged in and is authorized to register clients
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    // Redirect to login if not logged in or not authorized
    header('Location: login.php');
    exit;
}

if (isset($_POST['register_client'])) {
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];
    $id_no = $_POST['id_no'];
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null; // Check if 'id' key is set in $_SESSION array

     // Check if client already exists
     $check_sql = "SELECT * FROM clients WHERE name = '$name' AND phone_no = '$phone_no' AND id_no = '$id_no'";
     $check_result = $conn->query($check_sql);
 
     if ($check_result->num_rows > 0) {
         echo "Client already exists.";
     } else {
         $sql = "INSERT INTO clients (name, phone_no, id_no) VALUES ('$name', '$phone_no', '$id_no')";
         if ($conn->query($sql) === TRUE) {
             echo "Client added successfully.";
             echo '<script>window.setTimeout(function(){ window.location = "index.php"; }, 2000);</script>'; // Redirect after 2 seconds
         } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
         }
     }
 }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register Client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .reg {
            height: 750px;
            background-color: #2df97ca1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        header {
            background-color: #d76620;
            padding: 20px;
            text-align: center;
            color: white;
        }
        footer {
            background-color: #007bff;
            height: 100px;
            text-align: center;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>KNLS E-RESOURCE MANAGEMENT SYSTEM</h1>
    </header>
    <section class="reg">
        <div class="form-container">
            <h2 class="text-center">Register Client</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="name">Client Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_no" name="phone_no" required>
                </div>
                <div class="form-group">
                    <label for="id_no">ID Number:</label>
                    <input type="text" class="form-control" id="id_no" name="id_no" required>
                </div>
                <button type="submit" name="register_client" class="btn btn-primary btn-block">Register Client</button>
            </form>
        </div>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> KNLSATTACHEES</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
