<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="/assets/images/logo.png" width="25" alt="Aero"><span class="m-l-10">Bite Laundry</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="/profile"><img src="{{ asset('storage/'. Auth::user()->image ) }}" alt="User"></a>
                    <div class="detail">
                        <h4>{{ Auth::user()->name }}</h4>
                        <small>{{ Auth::user()->role }}</small>                        
                    </div>
                </div>
            </li>
            <li class="@if(Route::is('home')) active @endif open"><a href="/home"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li class="@if(Route::is('profile')) active @endif open"><a href="/profile"><i class="zmdi zmdi-account"></i><span>My Profile</span></a></li>
            @can('admin')
            <li class="@if(Route::is('account.index')) active @endif open"><a href="/account"><i class="zmdi zmdi-accounts-add"></i><span>Pengguna</span></a></li>
            <li class="@if(Route::is('membership.index')) active @endif open"><a href="/membership"><i class="zmdi zmdi-accounts"></i><span>Membership</span></a></li>
            <li class="@if(Route::is('outlet.index')) active @endif open"><a href="/outlet"><i class="zmdi zmdi-window-maximize"></i><span>Outlets</span></a></li>
            <li class="@if(Route::is('paket.index')) active @endif open"><a href="/paket"><i class="zmdi zmdi-shopping-basket"></i><span>Paket Laundry</span></a></li>
            <li class="@if(Route::is('transaksi')) active @endif open"><a href="/transaksi"><i class="zmdi zmdi-time-interval"></i><span>Riwayat Transaksi</span></a></li>
            @endcan
            @can('kasir')
            <li class="@if(Route::is('membership.index')) active @endif open"><a href="/membership"><i class="zmdi zmdi-accounts"></i><span>Membership</span></a></li>
            <li class="@if(Route::is('transaksi')) active @endif open"><a href="/transaksi"><i class="zmdi zmdi-time-interval"></i><span>Riwayat Transaksi</span></a></li>
            @endcan
            <li class="@if(Route::is('laporan')) active @endif open"><a href="/laporan"><i class="zmdi zmdi-archive"></i><span>Buat Laporan</span></a></li>
        </ul>
    </div>
</aside>