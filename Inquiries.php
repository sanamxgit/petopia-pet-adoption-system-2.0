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
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 200px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.form-container, .contact-container {
    margin-bottom: 20px;
    padding: 20px;
}

.form-container {
    background-color: #f9f9f9;
    border-radius: 10px;
}

h2 {
    text-align: center;
    color: #333;
}

label {
    font-weight: bold;
    color: #555;
}

input[type=text], input[type=email], textarea {
    width: calc(100% - 24px);
    padding: 12px;
    margin: 6px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    height: 120px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

.contact-container {
    background-color: #f2f2f2;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
}

p {
    margin: 10px 0;
    color: #666;
}

.contact-info {
    font-size: 18px;
    font-weight: bold;
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

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    border-radius: 10px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
body {
  margin: 0;
  font-family: Arial, sans-serif;
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
                  <div class="dropdown">
                     <a class="products5" href="#">Products</a>
                     <div class="dropdown-content">
                      <a href="additem.php">Add</a>
                      <a href="viewproducts.php">Edit</a>
                    </div>
                  </div>

                  <a class="orders" href="/adopt.html">Orders</a>
                  <div class="dropdown">
                    <a class="pet" href="#">Pet</a>
                    <div class="dropdown-content">
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
         </header>

         <div class="container">
        <h2>User Inquiries</h2>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Queries</th>
                <th>Action</th>
            </tr>
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
            
            // Fetch inquiries from the database
            $sql = "SELECT * FROM inquiries";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    
                echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["query"] . "</td>";
                echo "<td><button onclick='viewInquiry(\"" . $row["id"] . "\", \"" . $row["firstname"] . " " . $row["lastname"] . "\", \"" . $row["email"] . "\", \"" . $row["phone"] . "\", \"" . $row["query"] . "\")'>View</button></td>";
                
                echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No inquiries found</td></tr>";
            }


            $conn->close();
            ?>
        </table>


        
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="inquiryDetails"></p>
        </div>
    </div>

    <script>
        // JavaScript to handle modal and view button
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        function viewInquiry(id, name, email, phone, query) {
            modal.style.display = "block";
            // Display inquiry details in the modal
            document.getElementById("inquiryDetails").innerHTML =
                "<strong>Customer Name:</strong> " + name + "<br>" +
                "<strong>Email:</strong> " + email + "<br>" +
                "<strong>Phone:</strong> " + phone + "<br>" +
                "<strong>Query:</strong> " + query;
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <nav class="frame-parent" id="sideNav">
        <div class="admin-wrapper">
          <div class="admin">Admin</div>
        </div>
        <div class="petopia-parent" id="logo">
          <div class="petopia">petopia</div>
          <div class="frame-child"></div>
          <div class="frame-item"></div>
          <div class="frame-inner"></div>
          <img class="vector-icon" alt="" src="./public/vector.svg" />

          <img class="vector-icon1" alt="" src="./public/vector.svg" />

          <img class="vector-icon2" alt="" src="./public/vector.svg" />
        </div>
      </nav>
    <div class="contact-container">
            <h2>Prefer another way to find us?</h2>
            <p class="contact-info">+977 9801022637, +977 01-5970120, +977 9801000078</p>
            <p class="contact-info">info@heraldcollege.edu.np</p>
            <!-- You can embed a Google Map here -->
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
