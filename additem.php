<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "addproducts"; // Corrected database name

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Process form data
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemType = $_POST['itemType'];
    $price = $_POST['price'];
    $discounted_price = $_POST['discounted_price'];
    $availableQuantity = $_POST['availableQuantity'];

    // Handle image upload
    if(isset($_FILES['itemImage'])) {
        $imageName = $_FILES['itemImage']['name'];
        $imageTmpName = $_FILES['itemImage']['tmp_name'];
        $imageType = $_FILES['itemImage']['type'];

        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Create "uploads" directory if it doesn't exist
        $uploadDirectory = 'uploads/';
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true); // Create directory with full permissions
        }

        if (in_array($imageExtension, $allowedExtensions)) {
            $imageDestination = $uploadDirectory . $imageName;
            move_uploaded_file($imageTmpName, $imageDestination);
        } else {
            echo "<script>alert('Invalid file format. Only JPG, JPEG, PNG, and GIF images are allowed.');</script>";
        }
    }
    // Insert data into database
    if(isset($imageDestination)) {
        $sql = "INSERT INTO pet_items (itemName, itemDescription, itemType, price, discounted_price, available_quantity, itemImage)
                VALUES ('$itemName', '$itemDescription', '$itemType', $price, $discounted_price, $availableQuantity, '$imageDestination')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Item added successfully.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./additem.css" />
    <link rel="stylesheet" href="admin.css">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700;800&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Figma Hand:wght@700&display=swap"
    />
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
      
        .container {
            width: 50%;
            font-family: var(--font-epilogue);
            margin: 200px auto 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
  
        h2 {
            text-align: center;
            letter-spacing: 0.1em;
            font-weight: 800;
            text-align: center;
            color: var(--color-darkslategray);
        }
  
        form {
            margin-top: 50px;
        }
  
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
  
        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
  
        input[type="submit"],
input[type="reset"] {
    width: 100%; /* Full width */
    background-color: var(--color-darksalmon);
    color: white;
    padding: 15px; /* Increase padding for better appearance */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px; /* Increase top margin for spacing */
    display: block; /* Make the buttons block-level elements */
    transition: background-color 0.3s ease; /* Smooth transition */
}

input[type="submit"]:hover{
  background-color: #45a049
}
input[type="reset"]:hover {
    background-color: #C41E3A;
}

input[type="reset"] {
    background-color: var(--color-darksalmon);
    margin-left: 0; /* Remove left margin */
}

  
        @media screen and (max-width: 768px) {
            .container {
                width: 80%;
            }
  
            input[type="submit"],
            input[type="reset"] {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
  </head>
  <body>
    <div class="admin">
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
            <h2>Add Pet Items</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <label for="itemName">Item Name:</label>
                    <input type="text" id="itemName" name="itemName" required>

                    <label for="itemDescription">Item Description:</label>
                    <textarea id="itemDescription" name="itemDescription" required></textarea>

                    <label for="itemType">Item Type:</label>
                    <select id="itemType" name="itemType" required>
                        <option value="food">Food</option>
                        <option value="accessory">Accessory</option>
                        <option value="medical">Medical</option>
                    </select>

                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" required>

                    <label for="discounted_price">Discounted Price:</label>
                    <input type="text" id="discounted_price" name="discounted_price">

                    <label for="availableQuantity">Available Quantity:</label>
                    <input type="text" id="availableQuantity" name="availableQuantity" required>

                    <label for="itemImage">Item Image:</label>
                    <input type="file" id="itemImage" name="itemImage" accept="image/*">

                    <input type="submit" name="submit" value="Add Item">
                    <input type="reset" value="Cancel">
                </form>
        </div>
      <footer class="footer4" id="footer">
        <div class="details5">
          <div class="petopia-pvt-ltd4">Petopia pvt. ltd</div>
          <div class="kathmandu-np4">Kathmandu, NP</div>
        </div>
        <div class="adopt12">
          <b class="adopt13">Adopt</b>
          <a class="dog4" href="dogs.html" target="_blank">Dog</a>
          <a class="all9" href="adopt.html" target="_blank">All</a>
        </div>
        <div class="shop8">
          <b class="shop9">Shop</b>
          <a class="pupsicle7" href="pupsicle.html" target="_blank">Pupsicle</a>
          <a class="all10" href="products.html" target="_blank">All</a>
        </div>
        <div class="order-support8">
          <b class="order-support9">Order & Support</b>
          <a class="support4" href="inquire.html" target="_blank">Support</a>
          <a class="faq4" href="inquire.html" target="_blank">FAQ</a>
        </div>
        <div class="info8">
          <b class="info9">Info</b>
          <a
            class="store-locator4"
            href="https://www.google.com/maps/dir//P86J%2BW8X,+Kathmandu+44600/@27.7120696,85.2483647,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39eb196de5da5741:0x652792640c70ede9!2m2!1d85.3307558!2d27.712059?entry=ttu"
            target="_blank"
            >Store Locator</a
          >
          <a class="news4" href="wordpress.com" target="_blank">News</a>
        </div>
        <div class="follow4">
          <div class="media-icon4">
            <a
              class="intagram4"
              href="https://www.instagram.com/adoptapet/?hl=en"
              target="_blank"
            >
              <img class="vector-icon68" alt="" src="./public/vector2.svg" />
            </a>
            <a
              class="facebook4"
              href="https://www.facebook.com/Adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon69" alt="" src="./public/vector3.svg" />
            </a>
            <a
              class="intagram4"
              href="https://www.pinterest.com/adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon68" alt="" src="./public/vector4.svg" />
            </a>
          </div>
          <b class="follow-along4">Follow Along</b>
        </div>
        <div class="footerlogo4">
          <div class="footerlogo-child9"></div>
          <div class="footerlogo-child10"></div>
          <div class="footerlogo-child11"></div>
          <img class="vector-icon71" alt="" src="./public/vector.svg" />

          <img class="vector-icon72" alt="" src="./public/vector1.svg" />

          <img class="vector-icon73" alt="" src="./public/vector.svg" />

          <div class="petopia4">petopia</div>
        </div>
      </footer>


    </div>
  </body>
</html>
