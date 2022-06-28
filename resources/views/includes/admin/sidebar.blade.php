<!-- Sidebar -->
<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-print-none"
    id="accordionSidebar"
>
    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route('dashboard') }}"
    >
        <div class="sidebar-brand-text mx-3">Petcare Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
        >
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('health-package.index') }}">
            <i class="fas fa-fw fa-book-medical"></i>
            <span>Paket Sehat</span></a
        >
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('gallery.index') }}">
            <i class="fas fa-fw fa-images"></i>
            <span>Galeri Paket</span></a
        >
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Transaksi</span></a
        >
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.week') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Week Report</span></a
        >
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.month') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Month Report</span></a
        >
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.year') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Year Report</span></a
        >
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.today') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Today's Transaction</span></a
        >
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('worker.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Pegawai</span></a
        >
    </li>
    

    <hr class="sidebar-divider" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
