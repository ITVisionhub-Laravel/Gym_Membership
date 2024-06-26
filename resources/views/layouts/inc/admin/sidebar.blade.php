<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/customers') }}">
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                <span class="menu-title">Add Members</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/expiredMembers') }}">
                <i class="mdi mdi-account-alert menu-icon"></i>
                <span class="menu-title">Payment Expired Members</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapse-brands" aria-expanded="false"
                aria-controls="collapse-brands">
                <i class="mdi mdi-lumx menu-icon"></i>
                <span class="menu-title">Brands</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="collapse-brands">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/brands/create') }}">Add Brand</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/brands') }}">View Brands</a></li>

                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapse-product" aria-expanded="false"
                aria-controls="collapse-product">
                <i class="mdi mdi-google-circles-extended menu-icon"></i>
                <span class="menu-title">Product Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="collapse-product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/categories/create') }}">Add
                            Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/categories') }}">View Categoriess</a>
                    </li>
                    {{--  <li class="nav-item"> <a class="nav-link" href="{{ url('admin/categories') }}">Add Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/categories') }}">View Categories</a></li>  --}}

                </ul>
            </div>
        </li>

        {{--  For Products  --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-product" aria-expanded="false"
                aria-controls="ui-product">
                <i class="mdi mdi-package-variant menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="ui-product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create') }}">Add Products</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}">View Products</a></li>

                </ul>
            </div>
        </li>
        {{--  Products End  --}}

        {{--  For Requeset  --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/requests') }}">
                <i class="mdi mdi-truck menu-icon"></i>
                <span class="menu-title">Request</span>
            </a>
        </li> --}}
        {{--  Request End  --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-paymentpackage" aria-expanded="false"
                aria-controls="ui-paymentpackage">
                <i class="mdi mdi-dumbbell menu-icon"></i>
                <span class="menu-title">Package</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-paymentpackage">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payment_packages.create') }}">Add
                            Packages</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payment_packages.index') }}">View
                            Packages</a></li>

                </ul>
            </div>
        </li>
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('payment_providers.create') }}">
          <i class="mdi mdi-currency-usd menu-icon"></i>
          <span class="menu-title">Payment</span>
        </a>
      </li> -->
        <!-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-payment" aria-expanded="false" aria-controls="ui-payment">
        <i class="mdi mdi-currency-usd menu-icon"></i>
          <span class="menu-title">Payment</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-payment">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.create') }}">Add Payments</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.index') }}">View Payments</a></li>

          </ul>
        </div>
      </li> -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Payment</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.create') }}">Add
                            Payments</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.index') }}">View
                            Payments</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-transaction" aria-expanded="false"
                aria-controls="ui-transaction">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Expenses</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-transaction">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('expenses.create') }}">Add Expenses</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('expenses.index') }}">View Expenses</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-debitcredit" aria-expanded="false"
                aria-controls="ui-debitcredit">
                <i class="fa-regular fa-credit-card"></i>
                <span class="menu-title" style="margin-left: 16px">DebitAndCredit</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-debitcredit">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('debit-credit.index') }}">View
                            DebitAndCredit</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-paymentrecord" aria-expanded="false"
                aria-controls="ui-paymentrecord">
                <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">Payment Record</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-paymentrecord">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.index') }}">View
                            PaymentRecords</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-shareholder" aria-expanded="false"
                aria-controls="ui-shareholder">
                <i class="far fa-handshake menu-icon"></i>
                <span class=" menu-title">Share Holder</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-shareholder">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('shareholders.index') }}">View
                            Share Holders</a></li>
                </ul>
            </div>
            <div class="collapse" id="ui-shareholder">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('shareholders.create') }}">Create
                            Share Holders</a></li>
                </ul>
            </div>
            <div class="collapse" id="ui-shareholder">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="#">Update
                            Share Holders</a></li>
                </ul>
            </div>
        </li>

        {{-- Class Category --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-classCategory" aria-expanded="false"
                aria-controls="ui-class">
                <i class="mdi mdi-database menu-icon"></i>
                <span class=" menu-title">Class Category</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="ui-classCategory">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('classCategory.create') }}">Add
                            Class Category</a></li>
                </ul>
            </div>
            <div class="collapse" id="ui-classCategory">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('class-category.index') }}">View
                            Class Category</a></li>
                </ul>
            </div>

        </li>

        {{-- Class --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-class" aria-expanded="false"
                aria-controls="ui-class">
                <i class="mdi mdi-database menu-icon"></i>
                <span class=" menu-title">Class </span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="ui-class">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('class.create') }}">Add Class </a></li>
                </ul>
            </div>
            <div class="collapse" id="ui-class">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('class.index') }}">View Class </a></li>
                </ul>
            </div>

        </li>

        {{--  For Gym Classes  --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/class') }}">
                <i class="mdi mdi-database menu-icon"></i>
                <span class="menu-title">Class</span>
            </a>
        </li> --}}

        {{-- Schedule --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('schedule.index') }}">
                <i class="fa-solid fa-calendar-days menu-icon"></i>
                <span class="menu-title">Schedule</span>
            </a>

        </li>

        {{--  trainer  --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/trainers') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Trainner</span>
            </a>

        </li>
        {{--  Organization Chart  --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/organizationchart') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Organization Chart</span>
            </a>

        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('attendents.index') }}">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Attendent</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/logo') }}">
                <i class="mdi mdi-message-image menu-icon"></i>
                <span class="menu-title">Logo</span>
            </a>
        </li>

        {{-- Location --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-address" aria-expanded="false"
                aria-controls="ui-address">
                <i class="fa-solid fa-location-dot menu-icon"></i>
                <span class="menu-title">Address</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-address">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('country.index') }}">View Country</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('state.index') }}">View State</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('city.index') }}">View City</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('township.index') }}">View Township</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('ward.index') }}">View Ward</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('street.index') }}">View Street</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/partner') }}">
                <i class="mdi mdi-food-variant menu-icon"></i>
                <span class="menu-title">Partner</span>
            </a>
        </li>

        {{--  For shop  --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-shop" aria-expanded="false"
                aria-controls="ui-shop">
                <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">Shop</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-shop">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/shoptypes/create') }}">Add Shop
                            Type</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/shoptypes') }}">View Shop Type</a>
                    </li>

                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/shops/create') }}">Add Shop</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/shops') }}">View Shop</a></li>
                </ul>
            </div>
        </li>

        {{--  Deliver --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-delivery" aria-expanded="false"
                aria-controls="ui-delivery">
                <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">DeliveryType</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-delivery">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/deliverytypes/create') }}">Add
                            DeliveryType</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/deliverytypes') }}">View
                            DeliveryType</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-salerecord" aria-expanded="false"
                aria-controls="ui-salerecord">
                <i class="mdi mdi-book-open-variant
                menu-icon"></i>
                <span class="menu-title">Sales Record</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-salerecord">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('salerecord.index') }}">View
                            Sales Record</a></li>
                </ul>
            </div>
            <div class="collapse" id="ui-salerecord">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('salerecord.create') }}">Create
                            Sales Record</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            {{--  {{ route('setting.index') }}  --}}
            <a class="nav-link" href="">
                <i class="fa-solid fa-gear menu-icon"></i>
                <span class="menu-title">Setting</span>
            </a>
        </li>




        {{--  For Equipments  --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/equipments') }}">
                <i class="mdi mdi-webhook menu-icon"></i>
                <span class="menu-title">Equipments</span>
            </a>
        </li> --}}
    </ul>
</nav>
