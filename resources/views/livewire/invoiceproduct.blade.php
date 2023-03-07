 {{--  @dd($invoiceProducts)   --}}
@foreach ($invoiceProducts as $cart_item)
                  
    {{--  <div id="cart_product" style="display:none">  --}}
    <div class="offset-1 col-5 my-1">
        <p>{{ $cart_item->products->name }} : {{ $cart_item->quantity }}</p>
        </div>
        <div class="col-5 my-1">
            <p id="package">{{ $cart_item->total }} MMK.</p>
        </div>
    {{--  </div>  --}}
@endforeach