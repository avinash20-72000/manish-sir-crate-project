<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <!-- Dashboard -->
        <li class="nav-item @if (Route::currentRouteName() == 'dashboard') active @endif">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- User Management -->
        @can('admin',auth()->user())
            <li class="nav-item @if (in_array(Route::currentRouteName(), ['user.index', 'role.index', 'permission.index', 'module.index'])) active @endif">
                <a class="nav-link @if (in_array(Route::currentRouteName(), ['user.index', 'role.index', 'permission.index', 'module.index'])) collapsed @endif" data-toggle="collapse"
                    href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">User Management &nbsp;</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if (in_array(Route::currentRouteName(), ['user.index', 'role.index', 'permission.index', 'module.index'])) show @endif" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'user.index') active @endif"
                                href="{{ route('user.index') }}">User</a></li>
                        <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'role.index') active @endif"
                                href="{{ route('role.index') }}">Role</a></li>
                        @can('superAdmin',auth()->user())
                            <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'permission.index') active @endif"
                                    href="{{ route('permission.index') }}">Permission</a>
                            <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'module.index') active @endif"
                                    href="{{ route('module.index') }}">Module</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endcan

        <!-- Crate Management -->
        <li class="nav-item @if (in_array(Route::currentRouteName(), ['crate.index', 'crate.create', 'crateTransferForm','crateReceiveForm'])) active @endif">
            <a class="nav-link @if (in_array(Route::currentRouteName(), ['crate.index', 'crate.create', 'crateTransferForm','crateReceiveForm'])) collapsed @endif" data-toggle="collapse"
                href="#crate-management" aria-expanded="false" aria-controls="crate-management">
                <i class="fa-cubes fa menu-icon"></i>
                <span class="menu-title">Crate Management &nbsp;</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if (in_array(Route::currentRouteName(), ['crate.index', 'crate.create', 'crateTransferForm','crateReceiveForm'])) show @endif" id="crate-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'crate.index') active @endif"
                            href="{{ route('crate.index') }}">Crate</a></li>
                    <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'crate.create') active @endif"
                            href="{{ route('crate.create') }}">Add Crate</a></li>
                    <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'crateTransferForm') active @endif"
                            href="{{ route('crateTransferForm') }}">Crate Transfer</a></li>
                    <li class="nav-item"> <a class="nav-link @if (Route::currentRouteName() == 'crateReceiveForm') active @endif"
                            href="{{ route('crateReceiveForm') }}">Crate Receive</a></li>

                </ul>
            </div>
        </li>

        <!-- Company -->
        @if(auth()->user()->hasRole('admin'))
            <li class="nav-item @if(Route::currentRouteName() == 'company.index') active @endif">
                <a class="nav-link" href="{{ route('company.index') }}">
                    <i class="fa-building fa menu-icon"></i>
                    <span class="menu-title">Company</span>
                </a>
            </li>
        @endif

        <!-- Activity  Log -->
        @if(isset(auth()->user()->super_admin))
            <li class="nav-item @if(Route::currentRouteName() == 'activityLogs') active @endif">
                <a class="nav-link" href="{{ route('activityLogs') }}">
                    <i class="icon-clock menu-icon"></i>
                    <span class="menu-title">Activity Logs</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
