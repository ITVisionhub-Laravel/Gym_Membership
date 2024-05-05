<x-app-layout>
  <div>
    @php
    $routeName = request()->route()->getName();
    @endphp 
    <div>
      @if($routeName == 'package.details')
        <livewire:cart-show />
      @elseif($routeName == 'class.list')
        <livewire:gym-class-type :gymClassCategoryId="$gymClassCategoryId" />
      @elseif($routeName == 'product.checkout')
        <livewire:product-checkout />
      @endif
    </div> 
  </div>
</x-app-layout>