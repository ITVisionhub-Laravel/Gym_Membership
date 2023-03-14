 
<div>
  <x-frontend.navbar :customer="$data['customerInfo']"/>
    <!-- ***** Main Banner Area End ***** -->

    {{--  @if ()
        
    @endif      --}}
        <!-- ***** Packages Banner Area Start***** -->
        <div class="choose-package">
        <div class="card-body row py-5 me-5">
            <div class="col-md-8">
                <h3 class="one-pkg">Choose One Package </h3>
                <div class="row">
                    @foreach ($data['packages'] as $package)
                    {{--  data-action = "choose_package"  --}}
                    {{--  @dd($userChoosePackage->package_id)  --}}
                    @if ($chooseOnePackage == $package->id)
                            <div type="button" class="col-4 col-md-3 p-3 pkg_monthly pointer" disabled>
                            <div class="card h-80 shadow">
                                <div class="card-body text-center">
                                    My
                                    Package <span>({{ $package->package }})</span>
                                </div>
                            </div>
                            </div>
                    {{--  @endif
                        @if($userChoosePackage && $userChoosePackage->package_id == $package->id)
                            <div type="button" class="col-4 col-md-3 p-3 pkg_monthly pointer" disabled>
                            <div class="card h-80 shadow">
                                <div class="card-body text-center">
                                    My
                                    Package <span>({{ $package->package }})</span>
                                </div>
                            </div>
                            </div>  --}}
                        @else
                            <div type="button" class="col-4 col-md-3 p-3 pkg_monthly pointer" wire:loading.attr="disabled" wire:click="choosePackage({{ $package->id }})" @if ($data['qrcode'])
                                @if ($data['qrcode']->user_id == $data['customerInfo']->id)
                                    disabled
                                @endif
                            @endif>
                            <div class="card h-80 shadow" wire:target="choosePackage({{ $package->id}})" >
                                <div class="card-body text-center">		
                                    <h6 class="package_name text-dark">					
                                        {{ $package->package }}	
                                    </h6>
                                    <h6 class="package_promotion">
                                        {{ $package->promotion }} %	
                                    </h6>          				   
                                    <h6 class="package_original_price">
                                        {{ $package->original_price }}
                                    </h6>          				   
                                </div>
                            </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @if ($data['qrcode'])
            <div class="mt-5 col-md-4 border rounded card">
                <div class="card-header">
                    <h4>QR Code</h4>
                </div>
                <div class="card-body">
                    {{ QrCode::size(300)->generate($data['qrcode']->member_card_id) }}
                </div>
            </div>
                @else
                <div class="mt-5 col-md-4 border rounded ">
                    <h2 class="text-center mt-4 ">Invoice </h2>
                    <form method="post" wire:submit.prevent="checkout(@if ($packageInfo){{ $packageInfo->id }} @endif)">
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
                            
                            <div class="offset-1 col-5 my-1">
                                <p>Package:</p>
                            </div>
                            <div class="col-5 my-1">
                                <p id="invoice_package_name">@if ($packageInfo)
                                    {{   $packageInfo->package }}
                                @endif</p>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="offset-1 col-5 my-1">
                                <p>Original Fee:</p>
                            </div>
                            <div class="col-5 my-1">
                                <p id="total_amount">@if ($packageInfo){{ $packageInfo->original_price }} @endif</p>
                            </div>

                            <div class="offset-1 col-5 my-1">
                                <p>Promotion Fee:</p>
                            </div>
                            <div class="col-5 my-1">
                                <p>@if ($packageInfo){{ $packageInfo->promotion_price }} @endif</p>
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

                            {{--  <x-forms.dropdownfield :dropdownValues="$data['providers']" name="payment" width="col-md-10"></x-forms.dropdownfield>  --}}
                            </div>
                            
                            <button type="button" class="btn btn-outline-secondary mt-5 mb-4 w-25 mx-auto" id="clear">Clear</button>
                            <input type="submit" value="Checkout" class="btn pkg-btn mt-5 mb-4 w-50 mx-auto" id="pkg_register" @if (!$packageInfo) disabled @endif> 
                            <br>
                            <img src="" class="img-fluid loading" style="display: none;">
                        </div>
                    </form>
                </div>
                
            @endif
                
        </div>
        </div>
        <!-- ***** Packages Banner Area End ******-->

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
               document.getElementById("cart_product").style.display = "none";
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
   
   @endsection