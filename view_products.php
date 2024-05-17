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
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card img {
            max-width: 40%;
            height:40%;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .adopt-btn {
            background-color: #4169e1;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
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
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 200px;
        }

        .search-form button {
            background-color: #45a049;
            color: white;
            border: none;
            cursor: pointer;
        }

        
    </style>
</head>
<body>
      <nav class="navbar5" id="mainNavigationBar">
        <div class="rightnavigation5">
          <input
            class="search-bar5"
            name="searchBar"
            placeholder="e.g. japanese spitz"
            type="search"
          />

          <button class="shelter8">
            <button class="group-parent2" autofocus="{true}" id="shelter">
              <img class="frame-child2" alt="" src="./public/group-13.svg" />

              <div class="shelter9">Shelter?</div>
            </button>
          </button>
        </div>
        <div class="headnavigation5">
          <a class="home4" href="/home.html">Home</a>
          <a class="adopt16" href="/adopt.html">Adopt</a>
          <a class="products6" href="/products.html">Products</a>
          <a class="inquiry4" href="/inquire.html">Inquiry</a>
          <a class="contact4" href="/contacts.html">Contact?</a>
        </div>
        <a class="logo5" href="index.html">
          <div class="bg5"></div>
          <img class="vector-icon81" alt="" src="./public/vector51.svg" />
        </a>
      </nav> 
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

    <div class="container">
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

        // Your existing product display loop
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
            // Modify the button to include an onclick event
           echo "<button onclick='redirectToPayment(\"" . $row['productName'] . "\", " . $row['price'] . ")' class='adopt-btn'>Adopt Now!!!</button>";            echo "</div>";
        }
        ?>
    </div>

    <script>
      function redirectToPayment(productName, price) {
            // Redirect to payment.php with the product name and price as query parameters
            window.location.href = "payments.php?productName=" + encodeURIComponent(productName) + "&price=" + encodeURIComponent(price);
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
