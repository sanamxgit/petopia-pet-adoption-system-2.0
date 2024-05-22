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
    <div class="admin"> 
        <!-- <header>
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
            <div class="dropdown-content products-dropdown">
                <a href="additem.php">Add</a>
                <a href="viewproducts.php">Edit</a>
            </div>
        </div>

        <a class="orders" href="/adopt.html">Orders</a>
        <div class="dropdown">
            <a class="pet" href="#">Pet</a>
            <div class="dropdown-content pets-dropdown">
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


         </header> -->
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
            <a href="add_item.php">Add Product</a>
            <a href="view_products2.php">Edit Product</a>
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
    </div>
    </nav>

  
  <nav class="frame-parent" id="sideNav">
    <div class="admin-wrapper">
      <div class="admin">
        <h1>
        Admin
        </h1>
      </div>
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
