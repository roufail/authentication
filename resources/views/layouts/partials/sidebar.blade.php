<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('admin-assets/images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Users Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-assets/images/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth('admins')->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item @if (Route::is('admin.admins.index') || Route::is('admin.admins.create')) menu-open @endif">
                    <a href="#" class="nav-link @if (Route::is('admin.admins.index') || Route::is('admin.admins.create')) active @endif"">
                        <i class="
                        
                        
                        
                                                                            fas fa-user-shield nav-icon"></i>
                        <p>
                            Admins
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.index') }}" class="nav-link @if (Route::is('admin.admins.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.admins.create') }}" class="nav-link @if (Route::is('admin.admins.create')) active @endif">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p>Create Admin</p>
                            </a>
                        </li>

                    </ul>
                </li>






                <li class="nav-item @if (Route::is('admin.users.index') || Route::is('admin.users.create')) menu-open @endif">
                    <a href="#" class="nav-link @if (Route::is('admin.users.index') || Route::is('admin.users.create')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link @if (Route::is('admin.users.index')) active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}" class="nav-link @if (Route::is('admin.users.create')) active @endif">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Create User</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item @if (Route::is('admin.roles.index') || Route::is('admin.roles.create')) menu-open @endif">
                    <a href="#" class="nav-link @if (Route::is('admin.roles.index') || Route::is('admin.roles.create')) active @endif">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>
                            Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link @if (Route::is('admin.roles.index')) active @endif">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>Roles</p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.create') }}" class="nav-link @if (Route::is('admin.roles.create')) active @endif">
                                <i class="nav-icon fas fa-user-tag"></i>

                                <p>Create Roles</p>
                            </a>
                        </li>









                    </ul>
                </li>


                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}



                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
