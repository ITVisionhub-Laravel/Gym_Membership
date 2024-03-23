<div class="container my-1">
    {{--  ,['products'=>$products,'deli_types'=>$deliTypes]  --}}
    @include('livewire.admin.request.modal-form')
    <x-successmessage/>
     <div class="container mb-4">
        <div class="row">
            <div type="button" wire:loading.attr="disabled" wire:click="clickEvt(1)" class="col-md-3">

                <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightyellow">
                    <div class="d-flex">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon4"> <i class="fa fa-line-chart" aria-hidden="true"></i> </div>
                        </div>
                        <div class="mt-2 px-3">
                            <h5 class="heading">WareHouse</h5>
                            <p>$50.00</p>
                        </div>
                    </div>

                </div>
            </div>
            <div type="button" wire:loading.attr="disabled" wire:click="clickEvt(2)" class="col-md-3">
                <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightyellow">
                    <div class="pointer d-flex">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon5"> <i class="fa fa-male" aria-hidden="true"></i> </div>
                        </div>
                        <div class=" mt-2 px-3">
                            <h5 class="heading">DeliverMan</h5>
                            <p>dkf</p>
                        </div>
                    </div>

                </div>
            </div>
            <div type="button" wire:loading.attr="disabled" wire:click="clickEvt(3)" class="col-md-3">
                <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightyellow">
                    <div class="pointer d-flex">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon6"> <i class="fa fa-female" aria-hidden="true"></i> </div>
                        </div>
                        <div class=" mt-2 px-3">
                            <h5 class="heading">ShopKeeper</h5>
                            <p>dkf</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

     <hr>
    {{--  @dd($clickEvent)  --}}
     @if ($clickEvent == 1)
        @include('livewire.admin.request.shopkeeper_table',['requests'=>$requests])
     @elseif ($clickEvent == 2)
        @include('livewire.admin.request.warehouse_table',['requests'=>$requests])
     @else
        @include('livewire.admin.request.delivery_man_table',['requests'=>$requests])
     @endif

</div>


