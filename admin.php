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
    global $php_message;
    $username = $formData['username'];
    $password = $formData['password'];
    $name = $formData['name'];
    $email = $formData['email'];
    $phone = $formData['phone'];
    $confirm_password = $formData['confirm_password'];

    if ($password !== $confirm_password) {
        $php_message = "Error: Passwords do not match";
        return;
    }

    $check_username_query = "SELECT * FROM admin_credentials WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($check_username_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $php_message = "Error: Username already exists";
        return;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin_credentials (username, password, name, email, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $hashed_password, $name, $email, $phone);

    if ($stmt->execute()) {
        $php_message = "New admin registered successfully";
    } else {
        $php_message = "Error registering admin: " . $stmt->error;
    }
}

// Function to delete admin by ID
function deleteAdmin($conn, $id) {
    global $php_message;
    $sql = "DELETE FROM admin_credentials WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $php_message = "Admin deleted successfully";
    } else {
        $php_message = "Error deleting admin: " . $stmt->error;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        // editAdminInfo($conn, $_POST); // Assuming this function exists
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
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./admin.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700;800&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Figma Hand:wght@700&display=swap"
    />
    <script src="script.js"></script>
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    header {
        background-color: ;
        padding: 20px 0;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    nav ul li {
        display: inline;
    }

    nav ul li a {
        color: #295554;
        text-decoration: none;
        padding: 14px 16px;
        display: inline-block;
    }

    nav ul li a:hover {
        background-color: #fffff;
    }

    .dropdown {
        position: relative;
        display: inline-block;

    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        z-index: 1;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .dropdown-content a {
        color: #333;
        padding: 12px 16px;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
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
            background-color: var(--color-darksalmon);
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
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .overlay-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .hidden {
            display: none;
        }
    </style>
  </head>
  <body>
    <div class="admin"> 
        <!-- <header>
        <nav class="navbar4" id="mainNavigationBar">
    <div class="rightnavigation4">
        <input
            class="search-bar4"
            name="searchBar"
            placeholder="e.g. japanese spitz"
            type="search"
        />
        
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
    <div class="headnavigation4">
        <a class="inquires" href="/contacts.html">Inquires</a>
        <a class="admin-account" href="/inquire.html">Admin Account</a>
        <div class="dropdown">
            <a class="products5" href="#">Products</a>
            <div class="dropdown-content products-dropdown">
                <a href="additem.php">Add</a>
                <a href="viewproducts.php">Edit</a>
            </div>
        </div>

        <a class="orders" href="/adopt.html">Orders</a>
        <div class="dropdown">
            <a class="pet" href="#">Pet</a>
            <div class="dropdown-content pets-dropdown">
                <a href="addform.php">Add</a>
                <a href="edititems.php">Edit</a>
            </div>
        </div>
    </div>
    <a class="logo4" href="index.html">
        <div class="bg4"></div>
        <img class="vector-icon74" alt="" src="./public/vector51.svg" />
    </a>
</nav>


         </header> -->
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
    <a class="logo" href="index.html">
          <div class="bg"></div>
          <img class="vector-icon6" alt="" src="./public/vector51.svg" />
        </a>
    <li style="float:right">
      <button class="material-symbolslogout-parent" id="shelter">
        <img class="material-symbolslogout-icon" alt="" src="./public/materialsymbolslogout.svg" />
        <div class="logout">Logout</div>
      </button>
    </li>
  </ul>
</nav>

      </header>

  <div class="container">
        <h1>Admin Settings</h1>

        <div class="admin-info-box">
            <h2 style="text-align: left;">Admin Information</h2>
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
         


    <footer class="footer" id="footer">
        <div class="details">
          <div class="petopia-pvt-ltd">Petopia pvt. ltd</div>
          <div class="kathmandu-np">Kathmandu, NP</div>
        </div>
        <div class="adopt">
          <b class="adopt1">Adopt</b>
          <a class="dog" href="dogs.html" target="_blank">Dog</a>
          <a class="all" href="adopt.html" target="_blank">All</a>
        </div>
        <div class="shop">
          <b class="shop1">Shop</b>
          <a class="pupsicle" href="pupsicle.html" target="_blank">Pupsicle</a>
          <a class="all1" href="products.html" target="_blank">All</a>
        </div>
        <div class="order-support">
          <b class="order-support1">Order & Support</b>
          <a class="support" href="inquire.html" target="_blank">Support</a>
          <a class="faq" href="inquire.html" target="_blank">FAQ</a>
        </div>
        <div class="info">
          <b class="info1">Info</b>
          <a
            class="store-locator"
            href="https://www.google.com/maps/dir//P86J%2BW8X,+Kathmandu+44600/@27.7120696,85.2483647,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39eb196de5da5741:0x652792640c70ede9!2m2!1d85.3307558!2d27.712059?entry=ttu"
            target="_blank"
            >Store Locator</a
          >
          <a class="news" href="wordpress.com" target="_blank">News</a>
        </div>
        <div class="follow">
          <div class="media-icon">
            <a
              class="intagram"
              href="https://www.instagram.com/adoptapet/?hl=en"
              target="_blank"
            >
              <img class="vector-icon" alt="" src="./public/vector2.svg" />
            </a>
            <a
              class="facebook"
              href="https://www.facebook.com/Adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon1" alt="" src="./public/vector3.svg" />
            </a>
            <a
              class="intagram"
              href="https://www.pinterest.com/adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon" alt="" src="./public/vector4.svg" />
            </a>
          </div>
          <b class="follow-along">Follow Along</b>
        </div>
        <div class="footerlogo">
          <div class="footerlogo-child"></div>
          <div class="footerlogo-item"></div>
          <div class="footerlogo-inner"></div>
          <img class="vector-icon3" alt="" src="./public/vector.svg" />

          <img class="vector-icon4" alt="" src="./public/vector1.svg" />

          <img class="vector-icon5" alt="" src="./public/vector.svg" />

          <div class="petopia">petopia</div>
        </div>
      </footer>
    </div>
    </script>
    <div id="overlay" class="overlay hidden">
        <div id="overlayContent" class="overlay-content"></div>
    </div>
    <script>
              document.getElementById('registerBtn').addEventListener('click', function() {
            document.getElementById('registerForm').classList.toggle('hidden');
        });
    </script>

  </body>
</html>
