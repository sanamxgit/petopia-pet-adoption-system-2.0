<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is on a different server
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "addproducts"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Get the product ID from the URL
$productID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($productID > 0) {
    // Fetch product details from the database
    $sql = "SELECT * FROM pet_items WHERE itemID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Invalid product ID.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .product-details {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }
        .product-details img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-details h2 {
            font-size: 24px;
            margin-top: 0;
        }
        .product-details p {
            font-size: 16px;
            margin: 10px 0;
        }
        .product-details .price {
            font-size: 20px;
            font-weight: bold;
            color: #4CAF50;
        }
        .product-details .old-price {
            font-size: 16px;
            text-decoration: line-through;
            color: #888;
        }
        .buy-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="product-details">
        <img src="<?php echo htmlspecialchars($product['itemImage']); ?>" alt="<?php echo htmlspecialchars($product['itemName']); ?>">
        <h2><?php echo htmlspecialchars($product['itemName']); ?></h2>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($product['itemType']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($product['itemDescription']); ?></p>
        <p class="price">$<?php echo htmlspecialchars($product['discounted_price']); ?></p>
        <p class="old-price">$<?php echo htmlspecialchars($product['price']); ?></p>
        <p><strong>Available Quantity:</strong> <?php echo htmlspecialchars($product['available_quantity']); ?></p>
        <form method="post" action="cart.php">
            <input type="hidden" name="item_id" value="<?php echo $productID; ?>">
            <button class="buy-button" type="submit" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
</body>
</html>
