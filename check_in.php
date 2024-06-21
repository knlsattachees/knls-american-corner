<?php
session_start();
include 'db.php'; // Ensure this includes your database connection script

// Check if the user is logged in and authorized to check in clients
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    // Redirect to login if not logged in or not authorized
    header('Location: login.php');
    exit;
}

// Handle form submission for check-in
if (isset($_POST['check_in'])) {
    $client_name = $_POST['name'];

    // Insert check-in entry into database
    $sql = "INSERT INTO check_ins (client_name, check_in_time) VALUES ('$client_name', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "Client checked in successfully";
        // Redirect to index.php after a short delay
        echo '<script>window.setTimeout(function(){ window.location = "index.php"; }, 2000);</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all clients
$sql = "SELECT id, name FROM clients";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Client Check-In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .check {
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
    <section class="check">
        <div class="form-container">
            <h2 class="text-center">Client Check-In</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="name">Select Client:</label>
                    <select id="name" name="name" class="form-control" required>
                        <option value="">--Select Client--</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['name']}'>{$row['name']}</option>";
                            }
                        } else {
                            echo "<option value=''>No clients available</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="check_in" class="btn btn-primary btn-block">Check In</button>
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
