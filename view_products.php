<?php
session_start();

// Function to add product to cart
function addToCart($productId) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
    // Redirect to prevent form resubmission on refresh
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// Function to remove product from cart
function removeFromCart($productId) {
    unset($_SESSION['cart'][$productId]);
    // Redirect to prevent form resubmission on refresh
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addproducts";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_cart'])) {
        addToCart($_POST['product_id']);
    } elseif (isset($_POST['remove_from_cart'])) {
        removeFromCart($_POST['remove_product_id']);
    } elseif (isset($_POST['proceed_payment'])) {
        header("Location: payment.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Product Listing</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700;800&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Figma Hand:wght@700&display=swap"
    />
    <link rel="stylesheet" href="dogs.css">
    <link rel="stylesheet" href="global.css">
    
    <style>
        body {
            font-family: var(--font-epilogue);
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .container {
            
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 50px; /* Add margin at the bottom for the footer */
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px auto;
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card img {
            max-width: 100%; /* Adjust to 100% for better responsiveness */
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .adopt-btn {
            background-color: #4169e1;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: auto; /* Ensure the button is pushed to the bottom */
            width: 100%; /* Full width button */
            text-align: center;
        }

        .adopt-btn:hover {
            background-color: #1e90ff;
        }

        .buy-now-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .buy-now-btn:hover {
            background-color: #45a049;
        }

        .search-form input[type="text"],
        .search-form select,
        .search-form button {
            margin:;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-form button {
            background-color: #45a049;
            color: white;
            border: none;
            cursor: pointer;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .heading{
            margin: 150px;
        }
    </style>
</head>
<body>
    <nav class="navbar5" id="mainNavigationBar">
        <div class="rightnavigation5">
            <input class="search-bar5" name="searchBar" placeholder="e.g. japanese spitz" type="search" />
            <button class="shelter8">
                <button class="group-parent2" id="shelter" onclick="navigateToLogin()">
                    <img class="frame-child2" alt="" src="./public/group-13.svg" />
                    <div class="shelter9">Shelter?</div>
                </button>
            </button>
        </div>
        <div class="headnavigation5">
            <a class="home4" href="index.html">Home</a>
            <a class="adopt16" href="view_products.php">Adopt</a>
            <a class="products6" href="pet_items.php">Products</a>
            <a class="inquiry4" href="inquiry.php">Inquiry</a>
            <a class="contact4" href="javascript:void(0);" onclick="openOverlay()">Contact?</a> 
        </div>
        <a class="logo5" href="index.html">
          <div class="bg5"></div>
          <img class="vector-icon81" alt="" src="./public/vector51.svg" />
        </a>
    </nav> 



    <div class="heading">
    <form class="search-form" method="GET" action="">
        <input type="text" name="search" placeholder="Search for pets" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <select name="sort_by">
            <option value="">-- Sort By --</option>
            <option value="price_asc">Sort by Price: Low to High</option>
            <option value="price_desc">Sort by Price: High to Low</option>
            <option value="alpha_asc">Sort by Alphabet: A to Z</option>
            <option value="alpha_desc">Sort by Alphabet: Z to A</option>
        </select>
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    </div>

    <div class= "container">
        <?php
        // Modify your SQL query to include search functionality
        $sql = "SELECT * FROM products";
        
        if (isset($_GET['search'])) {
            $searchQuery = $_GET['search'];
            $searchQuery = $conn->real_escape_string($searchQuery);
            $sql .= " WHERE productName LIKE '%$searchQuery%' OR productDescription LIKE '%$searchQuery%'";
        }

        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            if ($sortBy == "price_asc") {
                $sql .= " ORDER BY price ASC";
            } elseif ($sortBy == "price_desc") {
                $sql .= " ORDER BY price DESC";
            } elseif ($sortBy == "alpha_asc") {
                $sql .= " ORDER BY productName ASC";
            } elseif ($sortBy == "alpha_desc") {
                $sql .= " ORDER BY productName DESC"; 
            }
        }

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            echo "<h3>" . $row['productName'] . "</h3>";
            echo "<p>Pet Description: " . $row['productDescription'] . "</p>";
            echo "<p>Pet Category: " . $row['productCategory'] . "</p>";
            echo "<p>Gender: " . $row['gender'] . "</p>";
            echo "<p>Weight: " . $row['itemsWeight'] . "</p>";
            echo "<p>Pet Price: $" . $row['price'] . "</p>";
            echo "<p>Compare Price: $" . $row['comparePrice'] . "</p>";
            echo "<img src='http://localhost/pet-adoption-system-html-css-js-php/images/" . $row['image'] . "' alt='Product Image'>";
            echo "<button onclick='redirectToPayment(\"" . $row['productName'] . "\", " . $row['price'] . ")' class='adopt-btn'>Adopt Now</button>";
            echo "</div>";
        }
        ?>
    </div>

    <div id="contactOverlay" style="display: none; position: fixed; padding: 18px; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1;">
        <div style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: var(--color-darkgray); padding: var(--padding-25xl) 9px var(--padding-25xl) var(--padding-xl); border-radius: var(--br-xl); width: 80%; max-width: auto; box-shadow: 0 0 10px rgba(0,0,0,0.25);">
            <span onclick="closeOverlay()" style="position: absolute; top: 10px; right: 15px; font-size: 24px; font-weight: bold; color: black; cursor: pointer;">&times;</span>
            <div class="contact-container" style="text-align: center; color: white;">
                <h2>Prefer another way to find us?</h2>
                <p class="contact-info" style="margin: 10px 0;">+977 9801010101, +977 01-5970120, +977 9801000078</p>
                <p class="contact-info" style="margin: 10px 0; font-weight: bold; color: var(--color-darkslategray);">info@petopia.com</p>
                <!-- You can embed a Google Map here -->
            </div>
        </div>
    </div>

    <footer>
        &copy; 2024 Petopia. All rights reserved.
    </footer>

    <script>
        function navigateToLogin() {
            window.location.href = 'login.php';
        }

        function openOverlay() {
            document.getElementById('contactOverlay').style.display = 'block';
        }

        function closeOverlay() {
            document.getElementById('contactOverlay').style.display = 'none';
        }

        function redirectToPayment(productName, price) {
            window.location.href = "payment.php?productName=" + encodeURIComponent(productName) + "&price=" + encodeURIComponent(price);
        }

        function sortProducts() {
            var sortBy = document.getElementById("sort-by").value;
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set('sort', sortBy);
            window.location.href = url.toString();
        }
    </script>
</body>
</html>
