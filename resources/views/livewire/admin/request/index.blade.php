
<div>
     <div class="container my-1">
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
     
     <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Shop Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php 
                        $j=1;
                        @endphp
                        @foreach($requests as $request)
                        <tr>
                            <td>{{$j++}}</td>
                            @if ($request->shops)
                                <td>{{$request->shops->name}}</td>
                                @else
                                <td> - </td>
                            @endif

                             @if ($request->name)
                                <td>{{$request->name}}</td>
                                @else
                                <td>{{$request->products->name}}</td>
                            @endif
                            
                            <td>{{$request->quantity}}</td>
                            {{--  <td>
                            {{ $request->status }}
                            </td>  --}}
                            <td>
                                <div wire:loading.attr="disabled" wire:click="">
                                    <a href="#" wire:target = "" class="btn btn-sm btn-success">Approved</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

<x-slot name="scripts">
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();      
    });

    </script>
   
</x-slot> 
        </div>
   

 
