
<div> 
  <x-frontend.navbar :customer="$data['customerInfo']"/>
    <!-- ***** Main Banner Area End ***** -->

        <!-- ***** Packages Banner Area Start***** -->
        <div class="choose-package">
        <div class="card-body row py-5 me-5">
            <div class="col-md-8">
                <h3 class="one-pkg">Choose One Package </h3>
                <div class="row">
                    @foreach ($data['packages'] as $package)
                        @if ($chooseOnePackage == $package->id)
                        <div type="button" class="col-4 col-md-3 p-3 pkg_monthly">
                            <div class="card h-80 shadow">
                                <div class="card-body text-center">
                                    My Package <span>({{ $package->package }})</span>
                                </div>
                            </div>
                        </div>
                       
                        @elseif ($data['debitCreditInfo'] && $data['debitCreditInfo']->gymMember->payment_records->last()->payment_package_id == $package->id)
                        <div type="button" class="col-4 col-md-3 p-3 pkg_monthly">
                            <div class="card h-80 shadow">
                                <div class="card-body text-center">
                                    My Package <span>({{ $package->package }})</span>
                                </div>
                            </div>
                        </div>

                        @else
                            <div type="button" class="col-4 col-md-3 p-3 pkg_monthly"
                            @if ($data['debitCreditInfo']) style="pointer-events: none;" @endif
                            wire:loading.attr="disabled" wire:click="choosePackage({{ $package->id }})">

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
            @if ($data['debitCreditInfo'] && $data['debitCreditInfo']->status_id == 1)
                @if ($data['qrcode'])
                    <div class="mt-5 col-md-4 border rounded card">
                        <div class="card-header">
                            <h4>QR Code</h4>
                        </div>
                        <div class="card-body">
                            {{ QrCode::size(300)->generate($data['qrcode']->member_card_id) }}
                        </div>
                    </div>
                @endif
            @endif
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
                                {{ $packageInfo->package }}
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
                            <p>Discounted Fee:</p>
                        </div>
                        <div class="col-5 my-1">
                            <p>@if ($packageInfo){{ $packageInfo->promotion_price }} @endif</p>
                        </div>
            
                        <div class="offset-1">
                            <x-forms.dropdownfield :dropdownValues="$data['providers']" name="payment_provider_id"
                                wireValue="payment_provider_id" width="col-md-10" labelName="Payment Type"></x-forms.dropdownfield>
                        </div>
            
                        <button type="button" class="btn btn-outline-secondary mt-5 mb-4 w-25 mx-auto" id="clear">Clear</button>
                        <input type="submit" value="Checkout" class="btn pkg-btn mt-5 mb-4 w-50 mx-auto" id="pkg_register" @if (!$packageInfo)
                            disabled
                        @endif>
                        <br>
                        <img src="" class="img-fluid loading" style="display: none;">
                    </div>
                </form>
            </div>
        </div>
        </div>
        <!-- ***** Packages Banner Area End ******-->

</div>
</body>

<x-frontend.footer :logo="$data['logo']" :partner="$data['partner']"/>
    </html>
@section('script')
   <script>
    document.addEventListener('livewire:load', function () {
            Livewire.on('checkoutSuccess', function () {
                Livewire.emit('refreshComponent'); // Trigger Livewire action to refresh the component
            });
        });
</script>
@endsection
