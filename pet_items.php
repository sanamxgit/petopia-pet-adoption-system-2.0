<?php
session_start();

// Function to add product to cart
function addToCart($productId, $quantity = 1) {
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] += $quantity;
  } else {
    $_SESSION['cart'][$productId] = [
      'id' => $productId, // Add product ID for easier reference
      'quantity' => $quantity,
    ];
  }
}

// Function to remove product from cart
function removeFromCart($productId) {
  if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
  }
}

// Function to update the quantity of a product in the cart
function updateCartQuantity($productId, $quantityChange) {
  if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] += $quantityChange;
    if ($_SESSION['cart'][$productId]['quantity'] <= 0) {
      unset($_SESSION['cart'][$productId]);
    }
  }
}

// Function to calculate total cart price
function calculateTotalPrice() {
  $totalPrice = 0;
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
      $totalPrice += $item['quantity'] * getItemPrice($item['id']); // Use getItemPrice function
    }
  }
  return $totalPrice;
}

// Function to get product price from database
function getItemPrice($productId) {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "addproducts";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch price from database
  $sql = "SELECT price FROM pet_items WHERE itemID = $productId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $price = $row['price'];
  } else {
    $price = 0; // Return 0 if price is not found
  }

  $conn->close(); // Close connection after fetching price
  return $price;
}

// Function to get product name from database
function getItemName($productId) {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "addproducts";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch name from database
  $sql = "SELECT itemName FROM pet_items WHERE itemID = $productId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $itemName = $row['itemName'];
  } else {
    $itemName = "Unknown"; // Default to "Unknown" if name is not found
  }

  $conn->close(); // Close connection after fetching name
  return $itemName;
}

// Function to get product image from database
function getItemImage($productId) {
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "addproducts";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch image URL from database
  $sql = "SELECT itemImage FROM pet_items WHERE itemID = $productId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $itemImage = $row['itemImage'];
  } else {
    $itemImage = "placeholder_image.jpg"; // Default image if not found
  }

  $conn->close(); // Close connection after fetching image
  return $itemImage;
}

// Handle actions (add, remove, cancel) when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['add_to_cart'])) {
    addToCart($_POST['item_id']);
  } elseif (isset($_POST['remove_quantity'])) {
    removeFromCart($_POST['item_id']);
  } elseif (isset($_POST['increase_quantity'])) {
    updateCartQuantity($_POST['item_id'], 1);
  } elseif (isset($_POST['decrease_quantity'])) {
    updateCartQuantity($_POST['item_id'], -1);
  } elseif (isset($_POST['cancel_order'])) {
    unset($_SESSION['cart']); // Clear the cart
    echo "<div class='cart-cleared'>Cart Cleared</div>"; // Display Cart Cleared message
    header("refresh:2;url=pet_items.php"); // Reload the page after 2 seconds
    exit;
  }
}

// Database connection (replace with your actual connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addproducts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM pet_items";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Items</title>
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="products.css">
  <link rel="stylesheet" href="dogs.css">
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }
    
    .maindiv{
      position: absolute;
      top: 258px;
      left: calc(50% - 667.5px);
      width: 1317px;
      height: 704px;
}
    }
    .container {
  
    }
    .cart-container {
      position: fixed;
      top: 20px;
      right: 20px;
      width: 500px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: none; /* Initially hidden */
    }
    .cart-container.show {
      display: block; /* Show when cart is not empty */
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .cart-item img {
      width: 50px;
      height: auto;
      border-radius: 5px;
    }
    .cart-item .quantity {
      display: flex;
      align-items: center;
    }
    .cart-item .quantity button {
      padding: 5px;
      border: none;
      background-color: #ddd;
      cursor: pointer;
    }
    .cart-item .remove-button {
      padding: 5px;
      background-color: #ff6347;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    .cart-total {
      font-weight: bold;
      margin-top: 10px;
    }
    .cart-buttons {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }
    .cart-buttons button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .cart-cleared {
      color: green;
      margin-top: 10px;
    }
    .navbar5{
      font:var(--font-epilogue);
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
            <button class="group-parent2" id="shelter" onClick = "navigateToLogin()">
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


      <div class="maindiv">


      <div class="productcard1-parent">
        <div class="row"> <!-- Start new row -->
            <?php
            $counter = 0; // Counter for displaying three products in a row
            while ($row = mysqli_fetch_assoc($result)) {
                if ($counter % 3 == 0 && $counter != 0) {
                    echo "</div><div class='row'>"; // Close previous row and start new row
                }
                echo "<div class='productcard3'>";
                echo "<div class='productimage3'>";
                echo "<a class='image-1-container' href='product-details.php?id=" . $row['itemID'] . "'>";
                echo "<img class='image-4-icon1' alt='' src='" . $row['itemImage'] . "' />";
                echo "</a>";
                echo "</div>";
                echo "<div class='description8'>";
                echo "<div class='reviews10'>";
                echo "<div class='reviews7'>0 reviews</div>";
                echo "</div>";
                echo "<div class='reviewstars3'>";
                // You can add stars dynamically based on your data here
                // For simplicity, I'll add five stars using the provided image
                for ($i = 0; $i < 5; $i++) {
                    echo "<img class='vector-icon40' alt='' src='./public/vector8.svg' />";
                }
                echo "</div>";
                echo "<div class='discountedprice5'>";
                echo "<div class='div7'>$ " . $row['discounted_price'] . "</div>";
                echo "</div>";
                echo "<div class='markedprice5'>";
                echo "<div class='div12'>$ " . $row['price'] . "</div>";
                echo "</div>";
                echo "<div class='productname5'>";
                echo "<a class='product-title3' href='product-details.php?id=" . $row['itemID'] . "'>";
                echo "<p class='range-bully'>" . $row['itemName'] . "</p>";
                echo "<p class='sticks'>" . $row['itemType'] . "</p>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='item_id' value='" . $row['itemID'] . "'>";
                echo "<button class='buybutton3' type='submit' name='add_to_cart'>";
                echo "<img class='lets-iconsbag3' alt='' src='./public/letsiconsbag1.svg' />";
                echo "<div class='add-to-cart3'>Add to Cart</div>";
                echo "</button>";
                echo "</form>";
                echo "</div>";

                $counter++;
            }
            ?>
        </div> <!-- Close the last row -->
    </div>
    <h1 class="browse-products style="">Browse Products</h1>
</div>

<div id="contactOverlay" style="display: none; position: fixed; padding: 18px; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1;">
        <div style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: var(--color-darkgray);padding: var(--padding-25xl) 9px var(--padding-25xl) var(--padding-xl); border-radius: var(--br-xl); width: 80%; max-width: auto; box-shadow: 0 0 10px rgba(0,0,0,0.25);">
            <span onclick="closeOverlay()" style="position: absolute; top: 10px; right: 15px; font-size: 24px; font-weight: bold; color: black; cursor: pointer;">&times;</span>
            <div class="contact-container" style="text-align: center; color: white; ">
                <h1>Prefer another way to find us?</h1>
                <p class="contact-info" style="margin: 10px 0;">+977 9801010101, +977 01-5970120, +977 9801000078</p>
                <p class="contact-info" style="margin: 10px 0; font-weight: bold; color: var(--color-darkslategray);">info@petopia.com</p>
                <!-- You can embed a Google Map here -->
            </div>
        </div>
      </div>
 
      

  </div>




      </div>



<!-- Cart Section -->
<div class="cart-container<?php echo (!empty($_SESSION['cart']) ? ' show' : ''); ?>">
    <h3>Shopping Cart</h3>
    <div class="cart-items">
      <?php
      if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
          echo "<div class='cart-item'>";
          echo "<img src='" . getItemImage($cartItem['id']) . "' alt='Cart Item Image'>";
          echo "<p>" . getItemName($cartItem['id']) . "</p>";
          echo "<div class='quantity'>";
          echo "<form method='post' style='display: inline;'>";
          echo "<input type='hidden' name='item_id' value='" . $cartItem['id'] . "'>";
          echo "<button type='submit' name='decrease_quantity'>-</button>";
          echo "</form>";
          echo "<span>" . $cartItem['quantity'] . "</span>";
          echo "<form method='post' style='display: inline;'>";
          echo "<input type='hidden' name='item_id' value='" . $cartItem['id'] . "'>";
          echo "<button type='submit' name='increase_quantity'>+</button>";
          echo "</form>";
          echo "</div>";
          echo "<form method='post' style='display: inline;'>";
          echo "<input type='hidden' name='item_id' value='" . $cartItem['id'] . "'>";
          echo "<button type='submit' name='remove_quantity' class='remove-button'>Remove</button>"; 
          echo "</form>";
          echo "</div>";
        }
        echo "<div class='cart-total'>Total: $" . calculateTotalPrice() . "</div>";
        echo "<div class='cart-buttons'>";
        echo "<form method='post' action='payment.php'>";
        echo "<input type='hidden' name='item_id' value='" . $row['itemID'] . "'>";
        echo "<input type='hidden' name='item_name' value='" . $row['itemName'] . "'>";
        echo "<input type='hidden' name='item_price' value='" . $row['price'] . "'>";
        echo "<button type='submit' name='proceed_payment'>Proceed Payment</button>";
        echo "</form>";
        
        echo "<form method='post'>";
        echo "<button type='submit' name='cancel_order'>Cancel</button>";
        echo "</form>";
        echo "</div>";
      } else {
        echo "<p>Your cart is empty.</p>";
      }
      ?>
    </div>
  </div>
  

  <?php
  // Handle Cancel Order button action
  if (isset($_POST['cancel_order'])) {
    unset($_SESSION['cart']); // Clear the cart
    echo "<div class='cart-cleared'>Cart Cleared</div>"; // Display Cart Cleared message
    header("refresh:2;url=pet_items.php"); // Reload the page after 2 seconds
    exit;
  }
  ?>

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
    // Toggle cart container visibility based on cart items
    document.addEventListener("DOMContentLoaded", function() {
      const cartContainer = document.querySelector('.cart-container');
      if (cartContainer && cartContainer.classList.contains('show')) {
        cartContainer.style.display = 'block';
      }
    });
  </script>
  

</body>
</html>
