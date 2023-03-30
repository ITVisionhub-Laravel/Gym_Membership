<div wire:ignore.self class="modal fade" id="addDeliveryRequest" tabindex="-1" aria-labelledby="addDeliveryRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addDeliveryRequest">Request To Delivery</h1>
        <button type="button" wire:click = "closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="storeDeliveryRequest">
        
        <div class="modal-body">      
            
            {{--  <div class="row">
                <x-forms.dropdownfield :dropdownValues="$products" name="product_id" labelName="Product Name" width="col-md-6"></x-forms.dropdownfield>
                <x-forms.dropdownfield :dropdownValues="$deliTypes" name="deli_type_id" labelName="Deli Type Name" width="col-md-6"></x-forms.dropdownfield>
            </div>
            <div class="row">
                <x-forms.forminput name="start_date" type="date" placeholder="start date" width="col-md-6" />
                <x-forms.forminput name="end_date" type="date" placeholder="end date" width="col-md-6" />
            </div>
            <x-forms.forminput name="description" type="textarea" width="col-md-12" />
            <div class="row">
                <x-forms.forminput wireValue=true name="quantity" type="number" placeholder="quantity" width="col-md-4" />
                <x-forms.forminput wireValue=true name="kg" type="number" placeholder="kg" width="col-md-4" />
                <x-forms.forminput wireValue=true name="deli_cost" type="number" placeholder="deli cost" width="col-md-4" />
            </div>  --}}
            <select class="form-select" name="product_id" wire:model.defer="product_id">
              <option value="">Select Products</option>
               @foreach ($products as $product)
               {{--  {{ $product->id==$checkOldValue ? 'selected':'' }}  --}}
                <option value="{{ $product->id }}" >
                    {{$product->name ?? $product->$name}}
                </option>
            @endforeach
            </select>
            <select class="form-select" name="deli_type_id" wire:model.defer="deli_type_id">
              <option value="">Select Delivery Type</option>
               @foreach ($deliTypes as $deliType)
               {{--  {{ $deliType->id==$checkOldValue ? 'selected':'' }}  --}}
                <option value="{{ $deliType->id }}" >
                    {{$deliType->name ?? $deliType->$name}}
                </option>
            @endforeach
            </select>
            <div class="mb-3">
                <label>start_date</label>
                <input type="text" wire:model.defer="start_date" class="form-control">
                 @error('start_date') <small class="text-danger"> {{ $message }} </small> @enderror
            </div>
            <div class="mb-3">
                <label>end_date</label>
                <input type="text" wire:model.defer="end_date" class="form-control">
                 @error('end_date') <small class="text-danger"> {{ $message }} </small> @enderror
            </div>
            <div class="mb-3">
                <label>description</label>
                <input type="text" wire:model.defer="description" class="form-control">
                 @error('description') <small class="text-danger"> {{ $message }} </small> @enderror
            </div>
            
            <div class="mb-3">
                <label>quantity</label>
                <input type="text" wire:model.defer="quantity" class="form-control">
                @error('quantity') <small class="text-danger"> {{ $message }} </small> @enderror
            </div>
            <div class="mb-3">
                <label>kg</label>
                <input type="text" wire:model.defer="kg" class="form-control">
                @error('kg') <small class="text-danger"> {{ $message }} </small> @enderror
            </div>
            <div class="mb-3">
                <label>deli cost</label>
                <input type="text" wire:model.defer="deli_cost" class="form-control">
                @error('deli_cost') <small class="text-danger"> {{ $message }} </small> @enderror
            </div>
        </div>
        <div class="modal-footer">
          <div wire:loading.attr="disabled" wire:click="removeTheWholeCart()">
             <button type="button" wire:click = "closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          <div wire:loading.attr="disabled" wire:click="storeDeliveryRequest">
            <button type="submit" class="btn btn-primary">Save</button>
          </div> 
            
        </div>
      </form>
      
    </div>
  </div>
</div>