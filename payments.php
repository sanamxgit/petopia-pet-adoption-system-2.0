<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./payment.css" />
    <link rel="stylesheet" href="dogs.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700&display=swap" />
    <title>Payment</title>
</head>
<body>
    <div class="order">
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
        <main class="frame-main" id="body">
            <div class="frame-parent3" id="deliveryDetails">
                <form class="name-parent" id="orderForm" action="orders.php" method="post">
                    <div class="name">Name</div>
                    <div class="phone-number">Phone Number</div>
                    <div class="email">Email</div>
                    <input
                        class="frame-child7"
                        name="customerName"
                        placeholder="Full name"
                        type="text"
                        required
                    />

                    <input
                        class="frame-child8"
                        name="phoneNumber"
                        placeholder="99-999-999-99"
                        type="tel"
                        required
                    />

                    <input
                        class="frame-child9"
                        name="email"
                        placeholder="yourmail@gmail.com"
                        type="email"
                        required
                    />
                    <input
                        type="hidden"
                        name="productName"
                        value="<?php echo isset($_GET['productName']) ? htmlspecialchars($_GET['productName']) : ''; ?>"
                    />
                    <input
                        type="hidden"
                        name="price"
                        value="<?php echo isset($_GET['price']) ? htmlspecialchars($_GET['price']) : ''; ?>"
                    />
                </form>
                <form class="address-parent" id="deliveryAddress">
                    <div class="name">Address</div>
                    <div class="phone-number">Postal Code</div>
                    <div class="email">Address 2</div>
                    <input
                        class="frame-child7"
                        name="address"
                        placeholder="kuleshwor, kathmandu"
                        type="text"
                    />

                    <input
                        class="frame-child8"
                        name="postalCode"
                        placeholder="e.g. 44600"
                        type="number"
                    />

                    <input
                        class="frame-child9"
                        name="address2"
                        placeholder="e.g. googlemaps.com"
                        type="text"
                    />
                </form>
                <div class="delivery-address">Delivery Address</div>
                <div class="personal-details">Personal details</div>
            </div>
            <div class="frame-parent4">
                <form class="payment-method-parent" id="description">
                    <div class="payment-method">Payment Method</div>
                    <div class="promo-code">Promo Code</div>
                    <div class="voucher">Voucher</div>
                    <select
                        class="select-payment-method-parent"
                        required="{true}"
                        id="paymentMethod"
                    >
                        <option value="1">Select Payment Method</option>
                        <option value="2">esewa</option>
                        <option value="3">Khalti</option>
                        <option value="4">Bank Transfer</option>
                    </select>
                    <button class="place-order-wrapper" type="submit" form="orderForm" name="placeOrder">
                       <div class="place-order">Place Order</div>
                    </button>
                    <input
                        class="frame-child13"
                        name="promoCode"
                        placeholder="if any..."
                        type="text"
                    />

                    <input
                        class="frame-child14"
                        name="voucher"
                        placeholder="No Applicable Voucher"
                        type="text"
                    />

                    <div class="order-summary-parent" id="orderSummary">       
                    <div class="total-payment">Total payment</div>
                    <div class="div3">
                <?php   
          
                $price = $_GET['price'] ?? '';
       
                echo "$" . htmlspecialchars($price);
                ?>
            </div>
                        <div class="all-taxes-included">All taxes included</div>
                    </div>
                </form>
                <h1 class="payment">Payment</h1>
            </div>
            <div class="product-name-group" id="productId">
                <h1 class="product-name1">Product Name</h1>
                <?php
                // Retrieve the product name from the URL query parameter
                $productName = $_GET['productName'] ?? '';

                // Display the product name in the iframe
                echo "<iframe class='frame-iframe' id='petType' name>$productName</iframe>";
                echo "<div class='pet-type-'>$productName</div>";
                ?>
            </div>
        </main>

        
    </div>

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
    <script>
    // Function to show a popup message
    function showMessage() {
        alert("Your order has been placed!");
    }

    // Add a click event listener to the "Place Order" button
    document.getElementById("placeOrder").addEventListener("click", showMessage);


</script>
</body>
</html>
