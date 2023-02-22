{{--  Brand Update Modal  --}}
<div wire:ignore.self class="modal fade" id="payFeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pay Fee</h1>
        <button type="button" class="btn-close" wire:click = "closeModal()" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div wire:loading class="p-2">
        <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>Loading...
      </div>
      <div wire:loading.remove>
        <form wire:submit.prevent="storePayment">
          <div class="modal-body">
            <div class="mb-3">
              
                  <label>Member Id</label>
                  <input type="text" value="$this->memberId" wire:model.defer="memberId" class="form-control" readonly>
                  @error('memberId') <small class="text-danger"> {{ $message }} </small> @enderror
              </div> 
            <div class="mb-3">
              <label for="">Payment Methods</label>
              <select wire:model.defer="provider" required class="form-select">
                  <option value="">Select Payment</option>
                  
                  @foreach ($this->providers as $provider)
                    {{--  {{ $provider->id==$this->provider ? 'selected':'' }}  --}}
                      <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                  @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="">Payment Packages</label>
              <select wire:model.defer="package" id="package" wire:click = "" required class="form-select">
                  <option value="">Select Packages</option>
                 
                  @foreach ($this->packages as $package)
                        {{--  {{ $package->id==$this->package ? 'selected':'' }}  --}}
                      <option value="{{ $package->id." ".$package->promotion." ".$package->original_price }}">
                    {{$package->package}}
                </option>
                  @endforeach
              </select>
            </div>
             
              <div class="mb-3">
                  <label>Promotion</label>
                  {{--  @dd($this)  --}}
                  {{--   value="$this.promotion"  --}}
                  <input type="text" id="promotion" wire:model.defer="promotion" class="form-control" readonly>
                  @error('promotion') <small class="text-danger"> {{ $message }} </small> @enderror
              </div>
              <div class="mb-3">
                  <label>Original Price</label>
                  {{--  value="$this.originalPrice"  --}}
                  <input type="text" id="original_price" wire:model.defer="originalPrice" class="form-control" readonly>
                  @error('originalPrice') <small class="text-danger"> {{ $message }} </small> @enderror
              </div>
              <div class="mb-3">
                  <label>Price</label>
                   {{--  value="$this.price"   --}}
                  <input type="text"id="price" wire:model.defer="price" class="form-control" readonly>
                  @error('price') <small class="text-danger"> {{ $message }} </small> @enderror
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" wire:click = "closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Pay</button>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>
