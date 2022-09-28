<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('dashboard') }}">
            {{-- <img src="{{ asset('assets/vendors/images/deskapp-logo.svg') }}}" alt="" class="dark-logo"> --}}
            <img src="{{ asset('assets/vendors/images/logo-putih.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="dropdown-toggle no-arrow {{ Request::is('dashboard') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1 "></span><span class="mtext">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('transaksi.index') }}"
                        class="dropdown-toggle no-arrow {{ Request::is('transaksi*') ? 'active' : '' }}">
                        <span class="micon dw dw-analytics-19"></span><span class="mtext">Kelola Data Transaksi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('tata-letak-barang.create') }}"
                        class="dropdown-toggle no-arrow {{ Request::is(['tata-letak-barang*', 'pola-penjualan-produk-hasil-perhitungan']) ? 'active' : '' }}">
                        <span class="micon dw dw-table"></span><span class="mtext">Tata Letak Barang</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pengaturan.akun') }}"
                        class="dropdown-toggle no-arrow {{ Request::is(['pengaturan-akun*', 'edit-profil*']) ? 'active' : '' }}">
                        <span class="micon dw dw-settings"></span><span class="mtext">Pengaturan Akun</span>

                        {{-- <i class="icon-copy dw dw-settings1"></i> --}}

                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="dropdown-toggle no-arrow"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="micon dw dw-logout"></span><span class="mtext">Keluar</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
