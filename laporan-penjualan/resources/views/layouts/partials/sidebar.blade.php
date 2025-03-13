<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #7E1010">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('template/img/LOGO HATS.jpeg') }}" alt="Logo"
                style="width: 50px; height: 50px; border-radius: 30px; margin-top: 20px">
            <img src="public\template\img\LOGO HATS.jpeg" alt="">

        </div>
        <div class="sidebar-brand-text mx-3">HATS COFFEE <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        DATA MASUK
    </div>



    <li class="nav-item">
        <a class="nav-link" href="{{ route('penjualan.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Penjualan</span></a>
    </li>


    @can('view-barang')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <i class="fas fa-folder"></i>
                <span>Data Barang</span></a>
        </li>
    @endcan




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Grafik
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('grafik.penjualan') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Grafik Penjualan Bulanan</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('grafik.all') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Grafik Penjualan Keseluruhan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    @canany(['view-role', 'view-permission', 'view-user'])
        <div class="sidebar-heading">
            Settings
        </div>
    @endcanany


    @can('view-role')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('roles.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Role</span></a>
        </li>
    @endcan

    @can('view-permission')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('permissions.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Permission</span></a>
        </li>
    @endcan

    @can('view-user')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span></a>
        </li>
    @endcan

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    {{-- <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="public\template\img\LOGO TEL-U CAFE.jpeg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
            and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
            Pro!</a>
    </div> --}}

</ul>
