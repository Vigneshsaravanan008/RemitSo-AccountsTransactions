<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route("web.dashboard")}}" class="brand-link">
        <img src="{{asset("admin-assets/images/laravel.png")}}" alt="RemitSo" class="brand-image img-circle elevation-3"
            style="opacity:.8">
        <span class="brand-text font-weight-light">RemitSo</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('web.dashboard')}}" class="nav-link {{request()->routeIs('web.dashboard')?"active":""}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Accounts
                        </p>
                    </a>
                </li>

                <li class="nav-header">Transactions</li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>
                            Transactions
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
