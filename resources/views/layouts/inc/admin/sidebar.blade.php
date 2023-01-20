<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/members') }}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Add Members</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">CheckIn CheckOut</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
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
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/packages/create') }}">Add Packages</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/packages') }}">View Packages</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#payment" aria-expanded="false" aria-controls="payment">
          <i class="mdi mdi-currency-usd menu-icon"></i>
          <span class="menu-title">Payment</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="payment">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/payment') }}">Add Payment Records</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/payment/provider') }}">Add Payment Method</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Trainner</span>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentation/documentation.html">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Attendent</span>
        </a>
      </li>
    </ul>
  </nav>