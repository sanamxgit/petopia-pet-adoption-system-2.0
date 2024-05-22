<?php
      if(isset($_POST['signinbut'])) {
          // Database connection
          $servername = "localhost"; // Change this if your database server is different
          $username = "root"; // Change this if your database username is different
          $password = ""; // Change this if your database password is different
          $dbname = "admin"; // Change this if your database name is different
  
          // Attempt to establish connection
          $conn = new mysqli($servername, $username, $password, $dbname);
  
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
  
          // Retrieve username and password from the form
          $username = $_POST['username'];
          $password = $_POST['password'];
  
          // Prepared statement to prevent SQL injection
          $stmt = $conn->prepare("SELECT * FROM admin_credentials WHERE username = ? AND password = ?");
          $stmt->bind_param("ss", $username, $password);
          $stmt->execute();
          $result = $stmt->get_result();
  
          // Check if there is a match
          if ($result && $result->num_rows > 0) {
              // Redirect to admin panel
              header("Location: admin.php");
              exit(); // Ensure script stops execution after redirection
          } else {
              // Display JavaScript alert for incorrect credentials
              echo '<script>alert("Incorrect username or password");</script>';
              // Redirect to login.php
              echo '<script>window.location.href = "login.php";</script>';
              exit(); // Ensure script stops execution after redirection
          }
  
          $conn->close();
      }
      ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./login.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700;800&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Figma Hand:wght@700&display=swap"
    />
  </head>
  <body>
    <div class="login">
    <nav class="navbar1" id="mainNavigationBar">
        <div class="rightnavigation1">
          <input
            class="search-bar1"
            name="searchBar"
            placeholder="e.g. japanese spitz"
            type="search"
          />

          <button class="shelter2">
            <button class="group-container" id="shelter" onClick = "navigateToLogin()">
              <img class="frame-inner" alt="" src="./public/group-13.svg" />

              <div class="register">Shelter?</div>
            </button>
          </button>
        </div>
        <div class="headnavigation1">
        <a class="contact1" href="javascript:void(0);" onclick="openOverlay()">Contact?</a>
          <a class="inquiry1" href="inquiry.php">Inquiry</a>
          <a class="products1" href="pet_items.php">Products</a>
          <a class="adopt5" href="view_products.php">Adopt</a>
          <a class="home1" href="index.html">Home</a>
        </div>
        <a class="logo1" href="index.html">
          <div class="bg1"></div>
          <img class="vector-icon33" alt="" src="./public/vector51.svg" />
        </a>
      </nav>
      <footer class="footer1" id="footer">
        <div class="details1">
          <div class="petopia-pvt-ltd1">Petopia pvt. ltd</div>
          <div class="kathmandu-np1">Kathmandu, NP</div>
        </div>
        <div class="adopt3">
          <b class="adopt4">Adopt</b>
          <a class="dog1" href="dogs.html" target="_blank">Dog</a>
          <a class="all3" href="adopt.html" target="_blank">All</a>
        </div>
        <div class="shop2">
          <b class="shop3">Shop</b>
          <a class="pupsicle1" href="pupsicle.html" target="_blank">Pupsicle</a>
          <a class="all4" href="products.html" target="_blank">All</a>
        </div>
        <div class="order-support2">
          <b class="order-support3">Order & Support</b>
          <a class="support1" href="inquire.html" target="_blank">Support</a>
          <a class="faq1" href="inquire.html" target="_blank">FAQ</a>
        </div>
        <div class="info2">
          <b class="info3">Info</b>
          <a
            class="store-locator1"
            href="https://www.google.com/maps/dir//P86J%2BW8X,+Kathmandu+44600/@27.7120696,85.2483647,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39eb196de5da5741:0x652792640c70ede9!2m2!1d85.3307558!2d27.712059?entry=ttu"
            target="_blank"
            >Store Locator</a
          >
          <a class="news1" href="wordpress.com" target="_blank">News</a>
        </div>
        <div class="follow1">
          <div class="media-icon1">
            <a
              class="intagram1"
              href="https://www.instagram.com/adoptapet/?hl=en"
              target="_blank"
            >
              <img class="vector-icon27" alt="" src="./public/vector2.svg" />
            </a>
            <a
              class="facebook1"
              href="https://www.facebook.com/Adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon28" alt="" src="./public/vector3.svg" />
            </a>
            <a
              class="intagram1"
              href="https://www.pinterest.com/adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon27" alt="" src="./public/vector4.svg" />
            </a>
          </div>
          <b class="follow-along1">Follow Along</b>
        </div>
        <div class="footerlogo1">
          <div class="ellipse-div"></div>
          <div class="footerlogo-child1"></div>
          <div class="footerlogo-child2"></div>
          <img class="vector-icon30" alt="" src="./public/vector.svg" />

          <img class="vector-icon31" alt="" src="./public/vector1.svg" />

          <img class="vector-icon32" alt="" src="./public/vector.svg" />

          <div class="petopia1">petopia</div>
        </div>
      </footer>
      
      <form action="" method="post">
      <div class="container">

        <h1 class="sign-in" id="h1">Sign In</h1>
          <input class="username" id="username" placeholder="admin" type="text" name="username" required/>
          <input class="password" id="password" placeholder="*****" type="password" name="password" required/>
          <div class="forgetpass">
            <a class="forgot-password-reset" href="/reset-password.html">
              Forgot Password? Reset
            </a>
          </div>
          <button class="signinbut" name="signinbut" id="shelter" >
            <div class="sign-in1">Sign In</div>
          </button>
          <a class="inquire" href="/inquire.html">
            <div class="dont-have-an">Don’t have an account? Inquire</div>
          </a>
          
        </div>
      </form>
      <div id="contactOverlay" style="display: none; position: fixed; padding: 18px; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1;">
        <div style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: var(--color-darkgray);padding: var(--padding-25xl) 9px var(--padding-25xl) var(--padding-xl); border-radius: var(--br-xl); width: 80%; max-width: auto; box-shadow: 0 0 10px rgba(0,0,0,0.25);">
            <span onclick="closeOverlay()" style="position: absolute; top: 10px; right: 15px; font-size: 24px; font-weight: bold; color: black; cursor: pointer;">&times;</span>
            <div class="contact-container" style="text-align: center; color: white; ">
                <h2>Prefer another way to find us?</h2>
                <p class="contact-info" style="margin: 10px 0;">+977 9801010101, +977 01-5970120, +977 9801000078</p>
                <p class="contact-info" style="margin: 10px 0; font-weight: bold; color: var(--color-darkslategray);">info@petopia.com</p>
                <!-- You can embed a Google Map here -->
            </div>
        </div>
      </div>
    </div>
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
    </script>
  </body>
</html>
