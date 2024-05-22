<?php
session_start();

// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addproducts";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to reload the page
function reloadPage() {
    echo "<script>window.location.href = window.location.href;</script>";
}

// Delete item if delete button is clicked
if (isset($_POST['delete'])) {
    $itemID = $_POST['itemID'];
    $sql_delete = "DELETE FROM pet_items WHERE itemID = $itemID";
    mysqli_query($conn, $sql_delete);
    reloadPage();
}

// Handle form submissions for editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $itemID = $_POST['itemID'];
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemType = $_POST['itemType'];
    $price = $_POST['price'];
    $availableQuantity = $_POST['availableQuantity'];

    // Handle image upload if a new image is provided
    if (isset($_FILES['itemImage']) && $_FILES['itemImage']['size'] > 0) {
        $imageName = $_FILES['itemImage']['name'];
        $imageTmpName = $_FILES['itemImage']['tmp_name'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $uploadDirectory = 'uploads/';

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        if (in_array($imageExtension, $allowedExtensions)) {
            $imageDestination = $uploadDirectory . $imageName;
            move_uploaded_file($imageTmpName, $imageDestination);

            $sql_update = "UPDATE pet_items SET itemName='$itemName', itemDescription='$itemDescription', itemType='$itemType', price=$price, available_quantity=$availableQuantity, itemImage='$imageDestination' WHERE itemID=$itemID";
        } else {
            echo "<script>alert('Invalid file format. Only JPG, JPEG, PNG, and GIF images are allowed.');</script>";
        }
    } else {
        $sql_update = "UPDATE pet_items SET itemName='$itemName', itemDescription='$itemDescription', itemType='$itemType', price=$price, available_quantity=$availableQuantity WHERE itemID=$itemID";
    }

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Item updated successfully.');</script>";
        reloadPage();
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}

// Fetch data from database
$sql = "SELECT itemID, itemName, itemDescription, itemType, price, available_quantity, itemImage FROM pet_items";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet Items</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .item-image {
            max-width: 100px;
            max-height: 100px;
        }
        .form-container {
            display: none;
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }
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
    </nav>

  
    <div class="container">

        <h2>Edit Pet Items</h2>
        <table>
            <tr>
                <th>Item Name</th>
                <th>Item Description</th>
                <th>Item Type</th>
                <th>Price</th>
                <th>Available Quantity</th>
                <th>Item Image</th>
                <th>Action</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['itemName'] . "</td>";
                    echo "<td>" . $row['itemDescription'] . "</td>";
                    echo "<td>" . $row['itemType'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['available_quantity'] . "</td>";
                    echo "<td><img src='" . $row['itemImage'] . "' class='item-image'></td>";
                    echo "<td>
                            <form action='' method='POST' style='display: inline;'>
                                <input type='hidden' name='itemID' value='" . $row['itemID'] . "'>
                                <button class='btn' type='button' onclick='editItem(" . json_encode($row) . ")'>Edit</button>
                            </form>
                            <form action='' method='POST' style='display: inline;'>
                                <input type='hidden' name='itemID' value='" . $row['itemID'] . "'>
                                <button class='btn' type='submit' name='delete'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No items found</td></tr>";
            }
            ?>
        </table>

        <div class="form-container" id="editFormContainer">
            <h2>Edit Item</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="itemID" id="itemID">
                <label for="itemName">Item Name:</label>
                <input type="text" name="itemName" id="itemName" required>
                <label for="itemDescription">Item Description:</label>
                <textarea name="itemDescription" id="itemDescription" required></textarea>
                <label for="itemType">Item Type:</label>
                <input type="text" name="itemType" id="itemType" required>
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" required>
                <label for="availableQuantity">Available Quantity:</label>
                <input type="text" name="availableQuantity" id="availableQuantity" required>
                <label for="itemImage">Item Image:</label>
                <input type="file" name="itemImage" id="itemImage">
                <input type="submit" name="update" value="Update">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>

    <script>
        function editItem(item) {
            document.getElementById('itemID').value = item.itemID;
            document.getElementById('itemName').value = item.itemName;
            document.getElementById('itemDescription').value = item.itemDescription;
            document.getElementById('itemType').value = item.itemType;
            document.getElementById('price').value = item.price;
            document.getElementById('availableQuantity').value = item.available_quantity;
            document.getElementById('editFormContainer').style.display = 'block';
        }
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>
