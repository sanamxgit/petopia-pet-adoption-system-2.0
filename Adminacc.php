<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch admin information by ID
function getAdminInfo($conn, $id) {
    $adminInfo = [];
    $sql = "SELECT id, username, name, email, phone FROM admin_credentials WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $adminInfo = $result->fetch_assoc();
    }
    return $adminInfo;
}

// Function to fetch all admins
function getAllAdmins($conn) {
    $allAdmins = [];
    $sql = "SELECT id, username, email, phone FROM admin_credentials";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $allAdmins[] = $row;
        }
    }
    return $allAdmins;
}

// Function to register a new admin
function registerAdmin($conn, $formData) {
    $username = $formData['username'];
    $password = $formData['password'];
    $name = $formData['name'];
    $email = $formData['email'];
    $phone = $formData['phone'];
    $confirm_password = $formData['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match";
        return;
    }

    $check_username_query = "SELECT * FROM admin_credentials WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($check_username_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Error: Username already exists";
        return;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin_credentials (username, password, name, email, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $name, $email, $phone);

    if ($stmt->execute()) {
        echo "New admin registered successfully";
    } else {
        echo "Error registering admin: " . $stmt->error;
    }
}

// Function to delete admin by ID
function deleteAdmin($conn, $id) {
    $sql = "DELETE FROM admin_credentials WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Admin deleted successfully";
    } else {
        echo "Error deleting admin: " . $stmt->error;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        editAdminInfo($conn, $_POST);
    } elseif (isset($_POST['register'])) {
        registerAdmin($conn, $_POST);
    } elseif (isset($_POST['delete'])) {
        $idToDelete = $_POST['id'];
        deleteAdmin($conn, $idToDelete);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}

// Fetch admin information for ID 1
$adminInfo = getAdminInfo($conn, 1);

// Fetch all admins
$allAdmins = getAllAdmins($conn);

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }

        .hidden {
            display: none;
        }

        .admin-list {
            margin-bottom: 20px;
        }

        .admin-list table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .admin-list th, .admin-list td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .admin-list th {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
             <header>
    <nav>
      <ul>
        <li class="dropdown">
          <a href="#" class="dropbtn">Pet</a>
          <div class="dropdown-content">
            <a href="addform.php">Add Pet</a>
            <a href="view_products2.php">Update Pet</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#" class="dropbtn">Product</a>
          <div class="dropdown-content">
            <a href="additem.php">Add Product</a>
            <a href="view_petitemsadmin.php">Edit Product</a>
          </div>
        </li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="Adminacc.php">Admin Account</a></li>
        <li><a href="Inquiries.php">Inquiries</a></li>
        <li style="float:right">
        <a class="logo4" href="index.html">
        <div class="bg4"></div>
        <img class="vector-icon74" alt="" src="./public/vector51.svg" />
    </a>
      </li>
      </ul>

      <div class="rightnavigation4">
        <button class="shelter7">
            <a href="index.html">
                <button
                    class="material-symbolslogout-parent"
                    id="shelter"
                >
                    <img
                        class="material-symbolslogout-icon"
                        alt=""
                        src="./public/materialsymbolslogout.svg"
                    />
                    <div class="logout">Logout</div>
                </button>
            </a>
        </button>
    </div>
    </nav>

  
  <nav class="frame-parent" id="sideNav">
    <div class="admin-wrapper">
      <div class="admin">
        <h1>
        Admin
        </h1>
      </div>
    </div>
    <div class="petopia-parent" id="logo">
      <div class="petopia">petopia</div>
      <div class="frame-child"></div>
      <div class="frame-item"></div>
      <div class="frame-inner"></div>
      <img class="vector-icon" alt="" src="./public/vector.svg" />
      <img class="vector-icon1" alt="" src="./public/vector.svg" />
      <img class="vector-icon2" alt="" src="./public/vector.svg" />
    </div>
  </nav>


    <div class="container">
        <h1>Admin Settings</h1>

        <div class="admin-info-box">
            <h2>Admin Information</h2>
            <?php if (isset($adminInfo) && !empty($adminInfo)) { ?>
                <p>ID: <?php echo $adminInfo['id']; ?></p>
                <p>Username: <?php echo $adminInfo['username']; ?></p>
                <p>Name: <?php echo $adminInfo['name']; ?></p>
                <p>Email: <?php echo $adminInfo['email']; ?></p>
                <p>Phone: <?php echo $adminInfo['phone']; ?></p>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="id" value="<?php echo $adminInfo['id']; ?>">
                    <input type="submit" name="edit" value="Edit Information">
                </form>
            <?php } else { ?>
                <p>No admin information available</p>
            <?php } ?>
        </div>

        <div class="admin-list">
            <h2>All Admins</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                <?php if (isset($allAdmins) && is_array($allAdmins)) {
                    foreach ($allAdmins as $admin) { ?>
                        <tr>
                            <td><?php echo $admin['id']; ?></td>
                            <td><?php echo $admin['username']; ?></td>
                            <td><?php echo $admin['email']; ?></td>
                            <td><?php echo $admin['phone']; ?></td>
                            <td>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                                    <input type="submit" name="delete" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5">No admins found</td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="action-buttons">
            <button id="registerBtn">Register Admin</button>
        </div>

        <form id="registerForm" class="hidden" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Register Admin</h2>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" required>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" placeholder="Phone" required>
            
            <input type="submit" name="register" value="Register">
        </form>
    </div>

    <script>
        document.getElementById('registerBtn').addEventListener('click', function() {
            document.getElementById('registerForm').classList.toggle('hidden');
        });
    </script>
</body>
</html>
