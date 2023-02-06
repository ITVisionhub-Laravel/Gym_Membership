<x-admin>
<div class="row">
    <div class="col-md-12">
        <x-successmessage></x-successmessage>
        <div class="card">
            <div class="card-header">
                <h3>Edit Member
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers/'.$customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Age</label>
                    <input type="number" name="age" value="{{ $customer->age }}" class="form-control">
                    @error('age')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Height</label>
                    <input type="text" name="height" value="{{ $customer->height }}" class="form-control">
                    @error('height')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Weight</label>
                    <input type="text" name="weight" value="{{ $customer->weight }}" class="form-control">
                    @error('weight')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-4">
                    <label for="">City</label>
                    <select  id="city" class="form-select" name="city">
                            <option value="">Select City</option>
                            @foreach ($cities as $data)
                                <option value="{{$data->id}}" {{ $data->id==$customer->address->street->township->city->id ? 'selected':'' }}>
                                    {{$data->name}}
                                </option>
                            @endforeach
                    </select>
                    </div>
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                    <div class="form-group col-md-4">
                        <label for="">Township</label>
                        <select id="township-dd" class="form-select" name="township">
                             <option value="">Select Township</option>
                            @foreach ($townships as $data)
                                <option value="{{$data->id}}" {{ $data->id==$customer->address->street->township->id ? 'selected':'' }}>
                                    {{$data->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Street</label>
                        <select id="street-dd" class="form-select" name="street">
                            <option value="">Select Street</option>
                            @foreach ($streets as $data)
                                <option value="{{$data->id}}" {{ $data->id==$customer->address->street->id ? 'selected':'' }}>
                                    {{$data->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <label for="">Mobile</label>
                    <input type="text" name="phone_number" value="{{ $customer->phone_number }}" class="form-control">
                    @error('phone_number')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Emergency Mobile</label>
                    <input type="text" name="emergency_phone" value="{{ $customer->emergency_phone }}" class="form-control">
                    @error('emergency_phone')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                </div>
                <div class="row pt-3">
                 <div class="form-group col-md-3">
                    <label for="">Select Packages</label>
                    <select  id="package-dd" class="form-select" name="package" >
                            <option value="">Select Package</option>
                            @foreach ($packages as $data)
                            <option  value="{{ $data->id." ".$data->promotion." ".$data->original_price }}" {{ $data->id==$payment_records[0]->package->id ? 'selected':'' }}>
                                {{$data->package}}
                            </option>
                            @endforeach
                    </select>

                    @error('package')<small class="text-danger">{{ $message }}</small>@enderror 
                </div>
                    <div class="form-group col-md-3">
                    <label for="promotion"> Promotion</label>
                    <input type="text" value="{{ $payment_records[0]->package->promotion }}" class="form-control" id="promotion" name="promotion"  placeholder="Promotion" required readonly/>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="original_price">Original Price</label>
                    <input type="text" value="{{ $payment_records[0]->package->original_price }}" class="form-control" id="original_price" name="original_price"  placeholder="Original Price" required readonly/>
                    </div>
                    <div class="form-group col-md-3">
                    <label for="price"> Price</label>
                    <input type="text" class="form-control" value="{{ $payment_records[0]->price }}" id="price" name="price"  placeholder="Original Price" required readonly/>
                    </div>
                    </div>
                    <div class="row pt-3">
                    <div class="form-group col-md-6">
                    <label for="provider" class="form-label">Payment Methods</label>
                    <select name="provider" class="form-select @error('provider') is-invalid @enderror" aria-label=".form-select-lg example">
                        <option selected>Choose One Payment Method</option>
                        @foreach($providers as $provider)
                        <option value="{{$provider->id}}" {{ $provider->id==$payment_records[0]->paymentprovider->id ? 'selected':'' }}>{{$provider->name}}</option>
                        @endforeach
                        
                    </select>
                    
                    @error('provider')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{asset('/uploads/customer/'.$customer->image)}}" width="50px" height="50px" alt="">
                        @error('image')<small class="text-danger">{{ $message }}</small>@enderror 
                    </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<x-slot name="scripts">
<x-addressfieldjs></x-addressfieldjs>
</x-slot>
</x-admin>