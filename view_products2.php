<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #f4f4f4;
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

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
            flex: 0 0 23%; /* Adjusted to fit 4 items in a row with some spacing */
            box-sizing: border-box;
        }

        .product h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product p {
            margin: 5px 0;
        }

        .edit-form {
            display: none;
            margin-top: 20px;
        }

        .edit-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .edit-form input,
        .edit-form textarea,
        .edit-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .edit-form .save-button,
        .edit-form .cancel-button {
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .edit-form .cancel-button {
            background-color: #f44336;
        }

        .edit-button,
        .delete-button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .edit-button:hover,
        .delete-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #f44336;
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

    <h2>Update Pet Products</h2>

    <div class="products-container">
        <?php
        // Database connection code
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "addproducts";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle form submission
            if (isset($_POST['submit'])) {
                $productId = $_POST['productId'];
                $productName = $_POST['productName'];
                $productDescription = $_POST['productDescription'];
                $productCategory = $_POST['productCategory'];
                $gender = $_POST['gender'];
                $itemsWeight = $_POST['itemsWeight'];
                $price = $_POST['price'];
                $comparePrice = $_POST['comparePrice'];

                $sql = "UPDATE products SET productName='$productName', productDescription='$productDescription', 
                        productCategory='$productCategory', gender='$gender', itemsWeight='$itemsWeight', 
                        price='$price', comparePrice='$comparePrice' WHERE id=$productId";

                if (mysqli_query($conn, $sql)) {
                    echo "<p class='message'>Changes applied successfully.</p>";
                    echo "<meta http-equiv='refresh' content='1'>"; // Reload the page after 1 second
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } elseif (isset($_POST['delete'])) {
                $productId = $_POST['productId'];
                $sql = "DELETE FROM products WHERE id=$productId";

                if (mysqli_query($conn, $sql)) {
                    echo "<p class='message'>Product deleted successfully.</p>";
                    echo "<meta http-equiv='refresh' content='1'>"; // Reload the page after 1 second
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }

        // Fetch all products from the database
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        // Display products and their images
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product'>";
            echo "<h3>" . $row['productName'] . "</h3>";
            echo "<img src='http://localhost/pet-adoption-system-html-css-js-php/images/" . $row['image'] . "' alt='Product Image'>";
            echo "<p>Description: " . $row['productDescription'] . "</p>";
            echo "<p>Category: " . $row['productCategory'] . "</p>";
            echo "<p>Gender: " . $row['gender'] . "</p>";
            echo "<p>Weight: " . $row['itemsWeight'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Compare Price: $" . $row['comparePrice'] . "</p>";

            // Edit form
            echo "<div class='edit-form'>";
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
            echo "<input type='hidden' name='productId' value='" . $row['id'] . "'>";
            echo "<label for='productName'>Product Name:</label>";
            echo "<input type='text' id='productName' name='productName' value='" . $row['productName'] . "' required>";
            echo "<label for='productDescription'>Product Description:</label>";
            echo "<textarea id='productDescription' name='productDescription' required>" . $row['productDescription'] . "</textarea>";
            echo "<label for='productCategory'>Product Category:</label>";
            echo "<select id='productCategory' name='productCategory'>";
            echo "<option value='Dog' " . ($row['productCategory'] == 'Dog' ? 'selected' : '') . ">Dog</option>";
            echo "<option value='Cat' " . ($row['productCategory'] == 'Cat' ? 'selected' : '') . ">Cat</option>";
            echo "<option value='Rabbit' " . ($row['productCategory'] == 'Rabbit' ? 'selected' : '') . ">Rabbit</option>";
            echo "<option value='Other' " . ($row['productCategory'] == 'Other' ? 'selected' : '') . ">Other</option>";
            echo "</select>";
            echo "<label for='gender'>Gender:</label>";
            echo "<select id='gender' name='gender'>";
            echo "<option value='Male' " . ($row['gender'] == 'Male' ? 'selected' : '') . ">Male</option>";
            echo "<option value='Female' " . ($row['gender'] == 'Female' ? 'selected' : '') . ">Female</option>";
            echo "</select>";
            echo "<label for='itemsWeight'>Items Weight:</label>";
            echo "<input type='number' id='itemsWeight' name='itemsWeight' value='" . $row['itemsWeight'] . "' required>";
            echo "<label for='price'>Price:</label>";
            echo "<input type='number' id='price' name='price' value='" . $row['price'] . "' required>";
            echo "<label for='comparePrice'>Compare Price:</label>";
            echo "<input type='number' id='comparePrice' name='comparePrice' value='" . $row['comparePrice'] . "'>";
            echo "<input type='submit' class='save-button' name='submit' value='Save'>";
            echo "<input type='button' class='cancel-button' value='Cancel'>";
            echo "</form>";
            echo "</div>"; // end of edit-form

            // Edit button
            echo "<button class='edit-button'>Edit</button>";

            // Delete form
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
            echo "<input type='hidden' name='productId' value='" . $row['id'] . "'>";
            echo "<input type='submit' class='delete-button' name='delete' value='Delete'>";
            echo "</form>";

            echo "</div>"; // end of product
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </div>

    <script>
        // Script to toggle edit form visibility
        const editButtons = document.querySelectorAll('.edit-button');
        const cancelButtons = document.querySelectorAll('.cancel-button');

        editButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                const editForm = document.querySelectorAll('.edit-form')[index];
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
            });
        });

        cancelButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                const editForm = document.querySelectorAll('.edit-form')[index];
                editForm.style.display = 'none';
            });
        });
    </script>
</body>
</html>
