
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>5 Heroes GYM | Build your body strong</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/frontend_custom.css">

    <link rel="icon" type="image/x-icon" href="assets/images/features-1-icon.png">

    </head>
    
    <body>
        <x-frontend.navbar :qrcode="$qrcode"/>
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <h3 class="badge-pill badge-light mt-3 mb-3 p-2 pt-5">Sale Products</h3>
                <div class="row">
                    @foreach ($products as $product_item)
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="shadow-sm card mb-3 product">
                            <img class="product-img" src="{{ $product_item->image }}" alt="prd1" onmouseover="animateImg(this)"
                            onmouseout="normalImg(this)"/>
                            <div class="card-body sale-product">
                                <h5 class="card-title  bold product-name text-center">{{ $product_item->name }}</h5>
                                <p class="card-text text-success product-price text-center">{{ $product_item->price }} MMK.</p>
                                <button class="btn addbadge badge-pill  mt-2 float-end success" type="button"
                                data-action="add-to-cart">Add to cart</button>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12 pt-1">
                <h4 class="badge-pill badge-light mt-3 mb-3 p-2 text-center pt-5">Cart</h4>
                <div class="cart"></div>
            </div>
        </div>
       </div>   
    
    <!-- ***** Sale Items End *****-->

    <x-frontend.footer :logo="$logo" :partner="$partner"/>
    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    {{--  Add to Cart  --}}
       <script>
        "use strict";                        
        let cart = [];
        let cartTotal = 0;
        const cartDom = document.querySelector(".cart");
        const addtocartbtnDom = document.querySelectorAll('[data-action="add-to-cart"]');
        
        addtocartbtnDom.forEach(addtocartbtnDom => {
          addtocartbtnDom.addEventListener("click", () => {
            const productDom = addtocartbtnDom.parentNode.parentNode;
            const product = {
              img: productDom.querySelector(".product-img").getAttribute("src"),
              name: productDom.querySelector(".product-name").innerText,
              price: productDom.querySelector(".product-price").innerText,
              quantity: 1
           };
        
        const IsinCart = cart.filter(cartItem => cartItem.name === product.name).length > 0;
        if (IsinCart === false) {
          cartDom.insertAdjacentHTML("beforeend",`
          <div class="d-flex flex-row shadow-sm card cart-items mt-2 mb-3 animated flipInX">
            <div class="p-2">
                <img src="${product.img}" alt="${product.name}" style="max-width: 50px;"/>
            </div>
            <div class="p-2 mt-3">
                <p class="text-success cart_item_name">${product.name}</p>
            </div>
            <div class="p-2 mt-3">
                <p class="text-success cart_item_price">${product.price}</p>
            </div>
            <div class="p-2 mt-3 ml-auto">
                <button class="btn badge badge-secondary plus" type="button" data-action="increase-item">&plus;
            </div>
            <div class="p-2 mt-3">
              <p class="text-success cart_item_quantity">${product.quantity}</p>
            </div>
            <div class="p-2 mt-3">
              <button class="btn badge badge-info" type="button" data-action="decrease-item">&minus;
            </div>
            <div class="p-2 mt-3">
              <button class="btn badge badge-danger" type="button" data-action="remove-item">&times;
            </div>
          </div> `);
        
          if(document.querySelector('.cart-footer') === null){
            cartDom.insertAdjacentHTML("afterend",  `
              <div class="d-flex flex-row shadow-sm card cart-footer mt-2 mb-3 animated flipInX">
                <div class="p-2">
                  <button class="btn badge-danger" type="button" data-action="clear-cart">Clear Cart
                </div>
                <div class="p-2 ml-auto">
                  <button class="btn badge-dark fload-end" type="button" data-action="check-out">Pay <span class="pay"></span> 
                    &#10137;
                </div>
              </div>`); }
        
            addtocartbtnDom.innerText = "In cart";
            addtocartbtnDom.disabled = true;
            cart.push(product);
        
            const cartItemsDom = cartDom.querySelectorAll(".cart-items");
            cartItemsDom.forEach(cartItemDom => {
        
            if (cartItemDom.querySelector(".cart_item_name").innerText === product.name) {
        
              cartTotal += parseInt(cartItemDom.querySelector(".cart_item_quantity").innerText) 
              * parseInt(cartItemDom.querySelector(".cart_item_price").innerText);
              document.querySelector('.pay').innerText = cartTotal + " MMK.";
        
              // increase item in cart
              cartItemDom.querySelector('[data-action="increase-item"]').addEventListener("click", () => {
                cart.forEach(cartItem => {
                  if (cartItem.name === product.name) {
                        cartItemDom.querySelector(".cart_item_quantity").innerText = ++cartItem.quantity;
                        cartItemDom.querySelector(".cart_item_price").innerText = cartItem.quantity *
                        parseInt(cartItem.price) + " MMK.";
                        cartTotal += parseInt(cartItem.price);
                        document.querySelector('.pay').innerText = cartTotal + " MMK.";
                  }
                });
              });
        
              // decrease item in cart
              cartItemDom.querySelector('[data-action="decrease-item"]').addEventListener("click", () => {
                cart.forEach(cartItem => {
                  if (cartItem.name === product.name) {
                    if (cartItem.quantity > 1) {
                        cartItemDom.querySelector(".cart_item_quantity").innerText = --cartItem.quantity;
                        cartItemDom.querySelector(".cart_item_price").innerText = parseInt(cartItem.quantity) *
                        parseInt(cartItem.price) + " MMK.";
                        cartTotal -= parseInt(cartItem.price)
                        document.querySelector('.pay').innerText = cartTotal + " MMK.";
                    }
                  }
                });
              });
        
              //remove item from cart
              cartItemDom.querySelector('[data-action="remove-item"]').addEventListener("click", () => {
                cart.forEach(cartItem => {
                  if (cartItem.name === product.name) {
                      cartTotal -= parseInt(cartItemDom.querySelector(".cart_item_price").innerText);
                      document.querySelector('.pay').innerText = cartTotal + " MMK.";
                      cartItemDom.remove();
                      cart = cart.filter(cartItem => cartItem.name !== product.name);
                      addtocartbtnDom.innerText = "Add to cart";
                      addtocartbtnDom.disabled = false;
                  }
                  if(cart.length < 1){
                    document.querySelector('.cart-footer').remove();
                  }
                });
              });
        
              //clear cart
              document.querySelector('[data-action="clear-cart"]').addEventListener("click" , () => {
                cartItemDom.remove();
                cart = [];
                cartTotal = 0;
                if(document.querySelector('.cart-footer') !== null){
                  document.querySelector('.cart-footer').remove();
                }
                addtocartbtnDom.innerText = "Add to cart";
                addtocartbtnDom.disabled = false;
              });
        
              document.querySelector('[data-action="check-out"]').addEventListener("click" , () => {
                //if(document.getElementById('paypal-form') === null){
                //  checkOut();
                //}
                alert('Checkout');
              });
            }
          });
        }
        });
        });
        
        function animateImg(img) {
          img.classList.add("animated","shake");
        }
        
        function normalImg(img) {
          img.classList.remove("animated","shake");
        }
        
        function checkOut() {
          let paypalHTMLForm = `
          <form id="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
            <input type="hidden" name="business" value="gmanish478@gmail.com">
            <input type="hidden" name="currency_code" value="INR">`;
           
          cart.forEach((cartItem,index) => {
           ++index;
           paypalHTMLForm += ` <input type="hidden" name="item_name_${index}" value="${cartItem.name}">
            <input type="hidden" name="amount_${index}" value="${cartItem.price.replace("MMK.","")}">
            <input type="hidden" name="quantity_${index}" value="${cartItem.quantity}">`;
          });
           
          paypalHTMLForm += `<input type="submit" value="PayPal" class="paypal">
          </form><div class="overlay">Please wait...</div>`;
          document.querySelector('body').insertAdjacentHTML("beforeend", paypalHTMLForm);
          document.getElementById("paypal-form").submit();
        }
        </script>  
{{--  End of Add to cart  --}}
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/frontend_custom.js"></script>
    </body>
    </html>