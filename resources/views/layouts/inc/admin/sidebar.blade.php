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
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Add Members</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/expiredMembers') }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Payment Expired Members</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/equipments') }}">
          <i class="mdi mdi-webhook menu-icon"></i>
          <span class="menu-title">Equipments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-paymentpackage" aria-expanded="false" aria-controls="ui-paymentpackage">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">Package</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-paymentpackage">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_packages.create') }}">Add Packages</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_packages.index')}}">View Packages</a></li>

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
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.index')}}">View Payments</a></li>

          </ul>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-currency-usd menu-icon"></i>
          <span class="menu-title">Payment</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.create') }}">Add Payments</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_providers.index')}}">View Payments</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-paymentrecord" aria-expanded="false" aria-controls="ui-paymentrecord">
        <i class="mdi mdi-clipboard-text menu-icon"></i>
          <span class="menu-title">Payment Record</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-paymentrecord">
          <ul class="nav flex-column sub-menu">
            {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.create') }}">Add PaymentRecords</a></li> --}}
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_records.index')}}">View PaymentRecords</a></li>
          </ul>
        </div>
      </li>
      {{--  trainer  --}}
      
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/trainers') }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Trainner</span>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('attendents.index')}}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Attendent</span>
        </a>
      </li>
      <li class="nav-item">
            <a class="nav-link" href="{{url('admin/sliders')}}">
              <i class="mdi mdi-view-carousel menu-icon"></i>
              <span class="menu-title">Home Slider</span>
            </a>
          </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/logo')}}">
          <i class="mdi mdi-message-image menu-icon"></i>
          <span class="menu-title">Logo</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/partner')}}">
          <i class="mdi mdi-food-variant menu-icon"></i>
          <span class="menu-title">Partner</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/class')}}">
          <i class="mdi mdi-database menu-icon"></i>
          <span class="menu-title">Class</span>
        </a>
      </li>
    </ul>
  </nav>