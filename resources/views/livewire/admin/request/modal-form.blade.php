{{--  For Shopkeeper Request  --}}
<div wire:ignore.self class="modal fade" id="addShopkeeperRequest" tabindex="-1" aria-labelledby="addShopkeeperRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addShopkeeperRequest">Request To Shopkeeper</h1>
        <button type="button" wire:click = "closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="storeShopKeeperRequestToWarehouse">
        
        <div class="modal-body">      
            
            <div class="row">
                <x-forms.dropdownfield :dropdownValues="$products" wireValue=true name="product_id" labelName="Product Name" width="col-md-4"></x-forms.dropdownfield>
                <x-forms.dropdownfield :dropdownValues="$deliTypes" wireValue=true name="deli_type_id" labelName="Deli Type Name" width="col-md-4"></x-forms.dropdownfield>
                <x-forms.dropdownfield :dropdownValues="$shopTypes" wireValue=true name="shop_type_id" labelName="Shop Type Name" width="col-md-4"></x-forms.dropdownfield>
            </div>
            
            
            <div class="row">
              <x-forms.forminput wireValue=true name="description" wireValue=true type="textarea" width="col-md-8" />
                <x-forms.forminput wireValue=true name="quantity" type="number" placeholder="quantity" width="col-md-4" />
            </div>
           
        </div>
        <div class="modal-footer">
          <div wire:loading.attr="disabled" wire:click="removeTheWholeCart()">
             <button type="button" wire:click = "closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          <div wire:loading.attr="disabled" wire:click="storeShopKeeperRequestToWarehouse">
            <button type="submit" class="btn btn-primary">Save</button>
          </div> 
            
        </div>
      </form>
      
    </div>
  </div>
</div>

{{--  For WareHouse Request  --}}
<div wire:ignore.self class="modal fade" id="addWarehouseRequest" tabindex="-1" aria-labelledby="addWarehouseRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addWarehouseRequest">Request To Delivery</h1>
        <button type="button" wire:click = "closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="storeWarehouseRequestToDeliveryMan">
        
        <div class="modal-body">      
            
            <div class="row">
                <x-forms.dropdownfield :dropdownValues="$products" wireValue=true name="product_id" labelName="Product Name" width="col-md-4"></x-forms.dropdownfield>
                <x-forms.dropdownfield :dropdownValues="$shopTypes" wireValue=true name="shop_type_id" labelName="Shop Type Name" width="col-md-4"></x-forms.dropdownfield>
                <x-forms.dropdownfield :dropdownValues="$deliTypes" wireValue=true name="deli_type_id" labelName="Deli Type Name" width="col-md-4"></x-forms.dropdownfield>
            </div>

            <div class="row">
                <x-forms.forminput wireValue=true name="deli_kg" type="number" placeholder="kg" width="col-md-4" />
                <x-forms.forminput wireValue=true name="deli_cost" type="number" placeholder="deli cost" width="col-md-4" />
            </div>
            
            <x-forms.forminput wireValue=true name="description" wireValue=true type="textarea" width="col-md-12" />
            <div class="row">
                <x-forms.forminput wireValue=true name="quantity" type="number" placeholder="quantity" width="col-md-4" />
                <x-forms.forminput wireClick=true wireFunction="calculateDeliCost" wireValue=true name="total_kg" type="number" placeholder="kg" width="col-md-4" />
                <x-forms.forminput wireValue=true name="total_cost" type="number" placeholder="total cost" width="col-md-4" />
            </div>
           
        </div>
        <div class="modal-footer">
          <div wire:loading.attr="disabled" wire:click="removeTheWholeCart()">
             <button type="button" wire:click = "closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          <div wire:loading.attr="disabled" wire:click="storeWarehouseRequestToDeliveryMan">
            <button type="submit" class="btn btn-primary">Save</button>
          </div> 
            
        </div>
      </form>
      
    </div>
  </div>
</div>

{{--  For Delivery Request  --}}
<div wire:ignore.self class="modal fade" id="addDeliveryRequest" tabindex="-1" aria-labelledby="addDeliveryRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addDeliveryRequest">Request To Delivery</h1>
        <button type="button" wire:click = "closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="storeDeliveryRequestToShop">
        
        <div class="modal-body">      
            
            <div class="row">
                <x-forms.dropdownfield :dropdownValues="$products" wireValue=true name="product_id" labelName="Product Name" width="col-md-6"></x-forms.dropdownfield>
                <x-forms.dropdownfield :dropdownValues="$shopTypes" wireValue=true name="shop_type_id" labelName="Shop Type Name" width="col-md-6"></x-forms.dropdownfield>
                <x-forms.forminput wireValue=true name="quantity" type="number" placeholder="quantity" width="col-md-4" />
            </div>
        </div>
        <div class="modal-footer">
          <div wire:loading.attr="disabled" wire:click="removeTheWholeCart()">
             <button type="button" wire:click = "closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
          <div wire:loading.attr="disabled" wire:click="storeDeliveryRequestToShop">
            <button type="submit" class="btn btn-primary">Save</button>
          </div> 
            
        </div>
      </form>
      
    </div>
  </div>
</div>


