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
        <a class="nav-link" data-bs-toggle="collapse" href="#attendance" aria-expanded="false" aria-controls="attendance">
          <i class="mdi mdi-checkbox-marked-circle menu-icon"></i>
          <span class="menu-title">Attendance</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="attendance">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#">CheckIn CheckOut</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">View Attendance</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/equipments') }}">
          <i class="mdi mdi-webhook menu-icon"></i>
          <span class="menu-title">Equipments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">Package</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_packages.create') }}">Add Packages</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('payment_packages.index')}}">View Packages</a></li>
          </ul>
        </div>
      </li>
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
        <a class="nav-link" href="{{ url('admin/trainers') }}">
          <i class="mdi mdi-webhook menu-icon"></i>
          <span class="menu-title">Trainers</span>
        </a>
      </li>
    </ul>
  </nav>