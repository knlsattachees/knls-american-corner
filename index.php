<div class="wrapper">
<?php
session_start();
include 'db.php';

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
$search_query = ""; // Initialize the variable

// Fetch all clients
$sql = "SELECT id, name, phone_no, id_no, check_in, check_out FROM clients";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Client Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .sec_img {
            height: 700px;
            width: 100%;
            background-image: url(images/DSC_3970-scaled.jpg);
            background-size: cover;
            background-position: center;
        }
        .fa {
            font-size: 24px;
            margin: 10px;
            color: #333;
        }
        .fa:hover {
            opacity: 0.7;
        }
        .fa-whatsapp {
            background-color: #25D366;
        }
        .fa-facebook {
            background-color: #1877F2;
        }
        .fa-google {
            background-color: #DB4437;
        }
        .fa-instagram {
            background-color: #E4405F;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #007bff; /* Bootstrap's primary blue color */
            height: 135px;
        }
        .footer a {
            color: white; /* Ensure icons and email link are visible on blue background */
        }
    </style>
</head>
<body>
    <header class="bg-warning text-white text-center py-3">
        <h1>KNLS E-RESOURCE MANAGEMENT SYSTEM</h1>
        <div class="d-flex justify-content-center">
            <a href="register_client.php" class="btn btn-light mx-2">Register Client</a>
            <a href="check_in.php" class="btn btn-light mx-2">Check In</a>
            <a href="check_out.php" class="btn btn-light mx-2">Check Out</a>
            <!-- <a href="register.php" class="btn btn-light mx-2">Sign Up</a> -->
        </div>
    </header>
    <section class="sec_img d-flex flex-column align-items-center justify-content-center">
        <div class="container text-white">
            <h2 class="mb-4">Clients List</h2>
            <!-- Search Bar -->
        <form class="form-inline mb-4" method="post" action="">
            <div class="form-group mr-2">
                <input type="text" class="form-control" id="search_query" name="search_query" placeholder="Search by Username" value="<?php echo htmlspecialchars($search_query); ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="search">Search</button>
        </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped bg-white text-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone No</th>
                            <th>ID No</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['phone_no']}</td>
                                        <td>{$row['id_no']}</td>
                                        <td>{$row['check_in']}</td>
                                        <td>{$row['check_out']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No clients registered yet.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div>
            <a href="#" class="fa fa-whatsapp"></a>
            <a href="https://www.facebook.com/KNLSKenya" class="fa fa-facebook"></a>
            <a href="mailto:knls@knls.ac.ke" class="fa fa-google"></a>
            <a href="https://www.instagram.com/knlsmedia/" class="fa fa-instagram"></a>
        </div>
        <h3><a href="mailto:knls@knls.ac.ke">EMAIL</a></h3>
        <p>&copy; <?php echo date("Y"); ?> KNLSATTACHEES</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</div>
