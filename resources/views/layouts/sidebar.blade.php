<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">فروشگاه پارس‌تک</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? 'کاربر' }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- داشبورد --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>داشبورد</p>
                    </a>
                </li>
                {{-- فاکتور جدید --}}
                <li class="nav-item">
                    <a href="{{ route('invoices.create') }}" class="nav-link {{ request()->routeIs('invoices.create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>صدور فاکتور جدید</p>
                    </a>
                </li>
                {{-- لیست فاکتورها --}}
                <li class="nav-item">
                    <a href="{{ route('invoices.index') }}" class="nav-link {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>لیست فاکتورها</p>
                    </a>
                </li>
                {{-- انبار --}}
                <li class="nav-item has-treeview {{ request()->is('products*') || request()->is('stocks*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('products*') || request()->is('stocks*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            مدیریت انبار
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                                <i class="fas fa-cube nav-icon"></i>
                                <p>کالاها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stocks.in') }}" class="nav-link {{ request()->routeIs('stocks.in') ? 'active' : '' }}">
                                <i class="fas fa-arrow-down nav-icon"></i>
                                <p>ورود کالا</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stocks.out') }}" class="nav-link {{ request()->routeIs('stocks.out') ? 'active' : '' }}">
                                <i class="fas fa-arrow-up nav-icon"></i>
                                <p>خروج/مصرف کالا</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- فروش سریع --}}
                <li class="nav-item">
                    <a href="{{ route('quick-sale') }}" class="nav-link {{ request()->routeIs('quick-sale') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bolt"></i>
                        <p>فروش سریع</p>
                    </a>
                </li>
                {{-- اشخاص --}}
                <li class="nav-item">
                    <a href="{{ route('persons.index') }}" class="nav-link {{ request()->routeIs('persons.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>اشخاص</p>
                    </a>
                </li>
                {{-- گزارشات --}}
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>گزارشات</p>
                    </a>
                </li>
                {{-- خروج --}}
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="#" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>خروج</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
