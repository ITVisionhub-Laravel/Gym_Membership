<x-admin>
<div class="container my-1">
    <x-successmessage/>
     <div class="container mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightyellow">
                    <div class="d-flex">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon4"> <i class="fa fa-line-chart" aria-hidden="true"></i> </div>
                        </div>
                        <div class=" mt-2 px-3">
                        <h5 class="heading">WareHouse</h5>
                        <p>$50.00</p>
                        </div>
                    </div>
                
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightyellow">
                    <div class="d-flex">
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
            <div class="col-md-3">
                <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightyellow">
                    <div class="d-flex">
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
                            <th>Class Name</th>
                            <th>Description</th>
                            <th>Morning Time</th>
                            <th>Evening Time</th>
                            <th>Trainer Name</th>
                            <th>Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
</div>
<x-slot name="scripts">
    <script>
     $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</x-slot>
</x-admin>