<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #295554;
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
            color: #fff;
            text-decoration: none;
            padding: 14px 16px;
            display: inline-block;
        }

        nav ul li a:hover {
            background-color: #555;
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .contact-container {
            background-color: #f2f2f2;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./admin.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600&display=swap" />
</head>
<body>
<header>
    <nav>
        <ul>
            <li class="dropdown">
                <a href="#" class="dropbtn">Pet</a>
                <div class="dropdown-content">
                    <a href="Addform.php">Add Pet</a>
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
            <li><a href="Inquiries.php">Inquires</a></li>
            <li style="float:right"><a href="index.html">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Orders</h2>
    <table>
        <tr>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Address</th>
            <th>Postal Code</th>
            <th>Address 2</th>
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "addproducts";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO orders (customerName, phoneNumber, email, productName, price, address1, postalCode, address2) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssdsss", $customerName, $phoneNumber, $email, $productName, $price, $address, $postalCode, $address2);

            // Set parameters and execute statement
            $customerName = $_POST["customerName"];
            $phoneNumber = $_POST["phoneNumber"];
            $email = $_POST["email"];
            $productName = $_POST["productName"];
            $price = $_POST["price"];
            $address = isset($_POST["address1"]) ? $_POST["address"] : '';
            $postalCode = isset($_POST["postalCode"]) ? $_POST["postalCode"] : '';
            $address2 = isset($_POST["address2"]) ? $_POST["address2"] : '';
            $stmt->execute();

            // Close statement and database connection
            $stmt->close();
            $conn->close();
        }
        
        // Fetch data from the database and display it in the table
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql_select = "SELECT * FROM orders";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["customerName"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["phoneNumber"]."</td>";
                echo "<td>".$row["productName"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td>".$row["address1"]."</td>";
                echo "<td>".$row["postalCode"]."</td>";
                echo "<td>".$row["address2"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>0 results</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

<footer>
    <div class="contact-container">
        <h2>Prefer another way to find us?</h2>
        <p class="contact-info">+977 9801022637, +977 01-5970120, +977 9801000078</p>
        <p class="contact-info">info@heraldcollege.edu.np</p>
    </div>
</footer>

</body>
</html>
