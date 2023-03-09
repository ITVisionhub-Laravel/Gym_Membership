 
<div>
    <x-frontend.navbar :customer="$data['customerInfo']"/>
  
    <!-- ***** Sale Items ****** -->
    <div class="choose-product">
        <div class="card-body py-5 me-6">             
    
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <h3 class="badge-pill badge-light mt-2 mb-3 p-2">Sale Products</h3>
                        <div class="row">
                            @foreach ($data['products'] as $product_item)
                            {{-- col-sm-6  col-lg-6 col-xs-6  --}}
                                <div class="col-md-6  col-lg-6">
                                    <div class="shadow-sm card mb-3 product">
                                        <img class="product-img" src="{{ $product_item->image }}" alt="prd1" onmouseover="animateImg(this)"
                                        onmouseout="normalImg(this)"/>
                                        <div class="card-body sale-product">
                                            <h5 class="card-title  bold product-name text-center">{{ $product_item->name }}</h5>
                                            <p class="card-text text-success product-price text-center">{{ $product_item->price }} MMK.</p>
                                        
                                            <button type = "button" wire:click = "addToCart({{ $product_item->id }})" class="btn addbadge badge-pill  mt-2 float-end success"> 
                                                <span wire:loading.remove wire:target="addToCart({{ $product_item->id }})">
                                                     Add To Cart
                                                </span>
                                                <span wire:loading wire:target="addToCart({{ $product_item->id }})">
                                                    Adding....
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> 
                    </div>
                    
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <h4 class="badge-pill badge-light mt-3 mb-3 p-2 text-center">Cart</h4>
                    @if ($data['Cart']->isEmpty())
                            <div class="col-md-12 border rounded card">
                          
                                <div class="card-body text-center">
                                    Empty Cart
                                </div>
                            </div>
                     @endif
                    @foreach ($data['Cart'] as $cart_item)
                       
                        <div class="d-flex flex-row shadow-sm card cart-items mt-2 mb-3 animated flipInX">
                            <div class="p-2">
                                <img src="{{asset($cart_item->products->image)}}" alt="{{ $cart_item->products->name }}" style="max-width: 50px;"/>
                            </div>
                            <div class="p-2 mt-3">
                                <p class="text-success cart_item_name">{{ $cart_item->products->name }}</p>
                            </div>
                            <div class="p-2 mt-3">
                                <p class="text-success cart_item_price">${{ $cart_item->total }}</p>
                            </div>
                            <div class="p-2 mt-3 ml-auto" wire:loading.attr="disabled" wire:click="incrementQuantity({{ $cart_item->id }})">
                                <button class="btn badge badge-secondary plus" type="button" wire:target="incrementQuantity({{ $cart_item->id }})" data-action="increase-item">&plus;
                            </div>
                            <div class="p-2 mt-3">
                            <p class="text-success cart_item_quantity">{{ $cart_item->quantity }}</p>
                            </div>
                            <div class="p-2 mt-3" wire:loading.attr="disabled" wire:click="decrementQuantity({{ $cart_item->id }})">
                            <button class="btn badge badge-info" type="button" wire:target="decrementQuantity({{ $cart_item->id }})" data-action="decrease-item">&minus;
                            </div>
                            <div class="p-2 mt-3" wire:loading.attr="disabled" wire:click="removeCartItem({{ $cart_item->id }})">
                            <button class="btn badge badge-danger" type="button" wire:target="removeCartItem({{ $cart_item->id }})" data-action="remove-item">&times;
                            </div>
                        </div>
                   
                    @endforeach
                    @if ($data['Cart']->isNotEmpty())
                        <div class="d-flex flex-row shadow-sm card cart-footer mt-2 mb-3 animated flipInX">
                        <div class="p-2" wire:loading.attr="disabled" wire:click="removeTheWholeCart()">
                        <button class="btn badge-danger" type="button" wire:target="removeTheWholeCart()">Clear Cart
                        </div>
                        <div class="p-2 ml-auto" wire:loading.attr="disabled" wire:click="openDiv(true)">
                        <button onclick="product_payment()" class="btn badge-dark fload-end" type="button" wire:target="openDiv(true)">Pay <span class="pay">{{ $totalPrice }}</span> 
                            &#10137;
                        </div>
                    </div>
                    @endif

                    <div class="mt-5 col-md-12 border rounded ">
                        <h2 class="text-center mt-4">Invoice </h2>
                        <form method="post" wire:submit.prevent="CheckoutProducts()">
                            @csrf
                            <div class="row mt-3">
                                <div class="offset-1 col-5 my-1">
                                    <p>Name:</p>
                                </div>
                                <div class="col-5 my-1">
                                    <p class="name">{{ $data['customerInfo']->name }}</p>
                                </div>

                                <div class="offset-1 col-5 my-1">
                                    <p>Mobile:</p>
                                </div>
                                <div class="col-5 my-1">
                                    <p class="mobile">{{ $data['customerInfo']->phone_number }}</p>
                                </div>
                                
                                    @foreach ($data['Cart'] as $cart_item)
                                        
                                            <div class="offset-1 col-5 my-1" style="@if($showDiv) display:flex @else  display:none @endif">
                                                <p>{{ $cart_item->products->name }} : {{ $cart_item->quantity }}</p>
                                            </div>
                                            <div class="col-5 my-1 ml-4" style="@if($showDiv) display:flex @else  display:none @endif">
                                                <p id="package">{{ $cart_item->total }} MMK.</p>
                                            </div>
                                        
                                    @endforeach
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="offset-1 col-5 my-1">
                                    <p>Total Amount:</p>
                                </div>
                                <div class="col-5 my-1" >
                                    <p id="total_amount" style="@if($showDiv) display:flex @else  display:none @endif">{{ $totalPrice }}</p>
                                </div>

                                <div class="offset-1 col-5 my-1">
                                    <p>Payment Type:</p>
                                </div>
                                <div class="col-5 my-1">
                                    <select id="payOption" class="form-control form-control-sm payment_type">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                                <div id="paymentType" class="col-11 my-2 mx-5" style="display:none">
                                    
                                    <label for="">Select Payments</label>
                                    <select wire:model.defer="provider_id" required class="form-control">
                                    <option value="0">---Select Payment Type---</option>
                                    @foreach ($data['providers'] as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                    </select>

                                </div>
                                
                                <button type="button" class="btn btn-outline-secondary mt-5 mb-4 w-25 mx-auto" wire:target = "ClearInvoice(true)">Clear</button>
                                <input type="submit" value="Checkout" class="btn pkg-btn mt-5 mb-4 w-50 mx-auto" id="pkg_register" @if(!$showDiv) disabled  @endif>
                                <br>
                                {{--  <img src="" class="img-fluid loading" style="display: none;">  --}}
                            </div>
                        </form>
                    </div> 
                    
                    </div>
                    
                     
                
                </div>
            </div>  

    </div>
     <!-- ***** End Sale Items ****** -->

</div>
</body>
<x-frontend.footer :logo="$data['logo']" :partner="$data['partner']"/>
</html>
   @section('script')
    <script>
        
        "use strict"; 
         $(document).ready(function () {                       
              let cart = [];
              let cartTotal = 0;
        //Start of Gym Fee Payment
        const choosePackages = document.querySelectorAll('[data-action="choose_package"]');
          choosePackages.forEach(choosePackages => {
              choosePackages.addEventListener("click", () => {
                const packageData = {
                  name: choosePackages.querySelector(".package_name").innerText,
                  price: choosePackages.querySelector(".package_original_price").innerText,
                  promotion: choosePackages.querySelector(".package_promotion").innerText
              };

              var package_price=packageData.price-(packageData.price*parseInt(packageData.promotion)/100);
              document.getElementById("total_amount").innerText = package_price;
              document.getElementById("package_title").innerText = "Package:";
              document.getElementById("invoice_package_name").innerText = packageData.name;
               //document.getElementById("cart_product").style.display = "none";
              });
            }); 

            //End of Gym Fee Payment

            // Cash Option Part
             $('#payOption').on('change', function () {
              if($(this).val() == "Bank"){
                document.getElementById("paymentType").style.display = "";
              }else{
                document.getElementById("paymentType").style.display = "none";
              }
             });
            
          });
    </script>

     <script src="assets/js/imgfix.min.js"></script> 
   
   @endsection
