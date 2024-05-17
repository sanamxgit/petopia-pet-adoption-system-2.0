<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
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
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .order-details {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }

        .order-details h4 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .order-details p1 {
            margin: 5px 0;
        }

        .view-details-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .search-bar {
  border: 0;
  outline: 0;
  background-color: var(--color-darkgray);
  width: 230px;
  box-shadow: 0 4px 8.4px -6px rgba(0, 0, 0, 0.25);
  border-radius: var(--br-lg);
  overflow: hidden;
  flex-shrink: 0;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-xs) var(--padding-smi);
  box-sizing: border-box;
}
.frame-child {
  width: 19.8px;
  position: relative;
  height: 20px;
}
.shelter1 {
  position: relative;
  font-size: var(--font-size-base);
  font-weight: 500;
  font-family: var(--font-epilogue);
  color: var(--color-darksalmon);
  text-align: left;
}
.group-parent {
  cursor: pointer;
  border: 1px solid var(--color-darksalmon);
  padding: var(--padding-3xs) var(--padding-xs);
  background-color: transparent;
  width: 153px;
  border-radius: var(--br-lg);
  box-sizing: border-box;
  height: 44px;
  overflow: hidden;
  flex-shrink: 0;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: var(--gap-3xs);
}
.rightnavigation,
.shelter {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.home {
  top: 0;
  left: 0;
  width: 51.5px;
  height: 17.6px;
}
.adopt2,
.contact,
.home,
.inquiry,
.products {
  text-decoration: none;
  position: absolute;
  font-weight: 600;
  color: inherit;
  display: inline-block;
}
.headnavigation {
  position: absolute;
  top: 13.2px;
  left: calc(50% - 463.3px);
  width: 476.5px;
  height: 17.6px;
}
.bg {
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 50%;
  background-color: var(--color-darkslategray);
  width: 44.1px;
  height: 42.1px;
}
.vector-icon6 {
  top: 8.8px;
  left: 8px;
  width: 26.1px;
  height: 19.6px;
}
.logo,
.navbar,
.vector-icon6 {
  position: absolute;
}
    </style>
  </head>
  <body>
    <div class="dogs1">
      <footer class="footer5" id="footer">
        <div class="details6">
          <div class="petopia-pvt-ltd5">Petopia pvt. ltd</div>
          <div class="kathmandu-np5">Kathmandu, NP</div>
        </div>
        <div class="adopt14">
          <b class="adopt15">Adopt</b>
          <a class="dog5" href="dogs.html" target="_blank">Dog</a>
          <a class="all11" href="adopt.html" target="_blank">All</a>
        </div>
        <div class="shop10">
          <b class="shop11">Shop</b>
          <a class="pupsicle8" href="pupsicle.html" target="_blank">Pupsicle</a>
          <a class="all12" href="products.html" target="_blank">All</a>
        </div>
        <div class="order-support10">
          <b class="order-support11">Order & Support</b>
          <a class="support5" href="inquire.html" target="_blank">Support</a>
          <a class="faq5" href="inquire.html" target="_blank">FAQ</a>
        </div>
        <div class="info10">
          <b class="info11">Info</b>
          <a
            class="store-locator5"
            href="https://www.google.com/maps/dir//P86J%2BW8X,+Kathmandu+44600/@27.7120696,85.2483647,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x39eb196de5da5741:0x652792640c70ede9!2m2!1d85.3307558!2d27.712059?entry=ttu"
            target="_blank"
            >Store Locator</a
          >
          <a class="news5" href="wordpress.com" target="_blank">News</a>
        </div>
        <div class="follow5">
          <div class="media-icon5">
            <a
              class="intagram5"
              href="https://www.instagram.com/adoptapet/?hl=en"
              target="_blank"
            >
              <img class="vector-icon75" alt="" src="./public/vector2.svg" />
            </a>
            <a
              class="facebook5"
              href="https://www.facebook.com/Adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon76" alt="" src="./public/vector3.svg" />
            </a>
            <a
              class="intagram5"
              href="https://www.pinterest.com/adoptapetcom/"
              target="_blank"
            >
              <img class="vector-icon75" alt="" src="./public/vector4.svg" />
            </a>
          </div>
          <b class="follow-along5">Follow Along</b>
        </div>
        <div class="footerlogo5">
          <div class="footerlogo-child12"></div>
          <div class="footerlogo-child13"></div>
          <div class="footerlogo-child14"></div>
          <img class="vector-icon78" alt="" src="./public/vector.svg" />

          <img class="vector-icon79" alt="" src="./public/vector1.svg" />

          <img class="vector-icon80" alt="" src="./public/vector.svg" />

          <div class="petopia5">petopia</div>
        </div>
      </footer>
      <h1 class="browse-dogs">Browse Dogs</h1>
      <nav class="navbar5" id="mainNavigationBar">
        <div class="rightnavigation5">
          <input
            class="search-bar5"
            name="searchBar"
            placeholder="e.g. japanese spitz"
            type="search"
          />

          <button class="shelter8">
            <button class="group-parent2" autofocus="{true}" id="shelter">
              <img class="frame-child2" alt="" src="./public/group-13.svg" />

              <div class="shelter9">Shelter?</div>
            </button>
          </button>
        </div>
        <div class="headnavigation5">
          <a class="home4" href="/home.html">Home</a>
          <a class="adopt16" href="/adopt.html">Adopt</a>
          <a class="products6" href="/products.html">Products</a>
          <a class="inquiry4" href="/inquire.html">Inquiry</a>
          <a class="contact4" href="/contacts.html">Contact?</a>
        </div>
        <a class="logo5" href="index.html">
          <div class="bg5"></div>
          <img class="vector-icon81" alt="" src="./public/vector51.svg" />
        </a>
      </nav>
      <div class="order-details">
        <h4>Customer Information</h4>
        <p1><strong>Name:</strong> <?php echo isset($_POST['customerName']) ? htmlspecialchars($_POST['customerName']) : ''; ?></p1>
        <p1><strong>Phone Number:</strong> <?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : ''; ?></p1>
        <p1><strong>Email:</strong> <?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?></p1>

        <h4>Delivery Address</h4>
        <p1><strong>Address:</strong> <?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></p1>
        <p1><strong>Postal Code:</strong> <?php echo isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode']) : ''; ?></p1>
        <p1><strong>Address 2:</strong> <?php echo isset($_POST['address2']) ? htmlspecialchars($_POST['address2']) : ''; ?></p1>

        <h4>Order Summary</h4>
        <p1><strong>Product Name:</strong> <?php echo isset($_POST['productName']) ? htmlspecialchars($_POST['productName']) : ''; ?></p1>
        <p1><strong>Price:</strong> <?php echo isset($_POST['price']) ? '$' . htmlspecialchars($_POST['price']) : ''; ?></p1>

        <h4>Payment Method</h4>
        <p1><strong>Selected Payment Method:</strong> <?php echo isset($_POST['paymentMethod']) ? htmlspecialchars($_POST['paymentMethod']) : ''; ?></p1>

        <h4>Promo Code</h4>
        <p1><strong>Promo Code:</strong> <?php echo isset($_POST['promoCode']) ? htmlspecialchars($_POST['promoCode']) : ''; ?></p1>

        <h4>Voucher</h4>
        <p1><strong>Voucher:</strong> <?php echo isset($_POST['voucher']) ? htmlspecialchars($_POST['voucher']) : ''; ?></p1>
    </div>

    <button class="view-details-btn" onclick="window.print()">Print Details</button>
    </div>

    <script>
      var frameLink = document.getElementById("frameLink");
      if (frameLink) {
        frameLink.addEventListener("click", function (e) {
          window.location.href = "./kaluu.html";
        });
      }
      </script>
  </body>
</html>