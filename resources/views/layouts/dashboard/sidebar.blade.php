        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name') }} <sup>Mostafa</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @can('posts')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Post Management</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Post Management :</h6>
                            @can('index_posts')
                                <a class="collapse-item" href="{{ route('admin.posts.index') }}">Posts</a>
                            @endcan
                            @can('create_posts')
                                <a class="collapse-item" href="{{ route('admin.posts.create') }}">Add Post</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcan

            <!-- Nav Item - Utilities Collapse Menu -->
            @can('settings')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Setting</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Setting Management</h6>
                            <a class="collapse-item" href="{{ route('admin.settings.index') }}">Setting</a>

                        </div>
                    </div>
                </li>
            @endcan
            @can('admins')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseUtilitiesAdmin" aria-expanded="true" aria-controls="collapseUtilitiesAdmin">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Admin</span>
                    </a>
                    <div id="collapseUtilitiesAdmin" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Admin Management</h6>
                            <a class="collapse-item" href="{{ route('admin.admins.index') }}">Admin</a>
                            <a class="collapse-item" href="{{ route('admin.admins.create') }}">Add New Admin</a>

                        </div>
                    </div>
                </li>
            @endcan

            @can('authorization')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseUtilitiesAdmin" aria-expanded="true" aria-controls="collapseUtilitiesAdmin">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Roles</span>
                    </a>
                    <div id="collapseUtilitiesAdmin" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Roles Management</h6>
                            <a class="collapse-item" href="{{ route('admin.authorization.index') }}">Role</a>
                            <a class="collapse-item" href="{{ route('admin.authorization.create') }}">Add New Role</a>

                        </div>
                    </div>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @can('users')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Users Management</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.users.index') }}">users</a>
                            <a class="collapse-item" href="{{ route('admin.users.create') }}">Add user</a>
                        </div>
                    </div>
                </li>
            @endcan

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            @can('categories')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Categories</span></a>
                </li>
            @endcan
            <!-- Nav contact - Tables -->
            @can('contacts')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Contacts</span></a>
                </li>
            @endcan
            <!-- Notifications  -->
            @can('notifications')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.notification.index') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Notification</span></a>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
