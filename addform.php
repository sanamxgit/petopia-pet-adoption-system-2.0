<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./addform.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700;800&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Figma Hand:wght@700&display=swap"
    />
    <style>
      
        .container {
            width: 50%;
            margin: 200px auto 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
  
        h2 {
            text-align: center;
            color: #333;
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
                  <a class="products5" href="/products.html">Products</a>
                  <a class="orders" href="/adopt.html">Orders</a>
                  <a class="pet" href="/home.html">Pet</a>
                </div>
                <a class="logo4" href="index.html">
                  <div class="bg4"></div>
                  <img class="vector-icon74" alt="" src="./public/vector51.svg" />
                </a>
              </nav>
         </header>

        <div class="container">
            <h2>Add Pet</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label for="productName">Pet Name:</label>
                <input type="text" id="productName" name="productName" required>
    
                <label for="productDescription">Pet Description:</label>
                <textarea id="productDescription" name="productDescription" required></textarea>
    
                <label for="productCategory">Pet Category:</label>
                <select id="productCategory" name="productCategory">
                    <option value="Dog">Dog</option>
                    <option value="Cat">Cat</option>
                    <option value="Rabbit">Rabbit</option>
                    <option value="Other">Other</option>
                </select>
    
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
    
                <label for="itemsWeight">Pet Weight:</label>
                <input type="number" id="itemsWeight" name="itemsWeight" required>
    
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
    
                <label for="comparePrice">Compare Price:</label>
                <input type="number" id="comparePrice" name="comparePrice">
    
                <label for="image">Pet Image:</label>
                <input type="file" id="image" name="image" required>
    
                <input type="submit" value="Add Product" name="submit">
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
    <?php
    // Database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "addproducts"; // Corrected database name

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Process form data
        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $productCategory = $_POST['productCategory'];
        $gender = $_POST['gender'];
        $itemsWeight = $_POST['itemsWeight'];
        $price = $_POST['price'];
        $comparePrice = $_POST['comparePrice'];

        // Handle image upload
        $image = $_FILES['image']['name'];
        $targetDir = "C:/xampp/htdocs/PetProject/Petopia/images/";
        $targetFilePath = $targetDir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);

        // Insert data into database
        $sql = "INSERT INTO products (productName, productDescription, productCategory, gender, itemsWeight, price, comparePrice, image)
                VALUES ('$productName', '$productDescription', '$productCategory', '$gender', $itemsWeight, $price, $comparePrice, '$image')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Product added successfully.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
    ?>

  </body>
</html>
