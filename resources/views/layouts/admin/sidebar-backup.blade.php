<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li {{ Request::is('admin') || Request::is('admin/dashboard') ? 'class="mm-active"' : '' }}>
                    <a href="{{ route('admin.dashboard') }}"
                        class="waves-effect {{ Request::is('admin') || Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="{{ Request::is('admin/modules/*') ||Request::is('admin/permissions/*') ||Request::is('admin/roles/*') ||Request::is('admin/users/*')? 'mm-active': '' }}">
                    <a href="javascript: void(0);"
                        class="has-arrow waves-effect {{ Request::is('admin/modules/*') ||Request::is('admin/permissions/*') ||Request::is('admin/roles/*') ||Request::is('admin/users/*')? 'mm-active': '' }}">
                        <i class=" ri-stack-fill"></i>
                        <span>User Management</span>
                    </a>
                    <ul class="sub-menu  {{ Request::is('admin/modules/*') ||Request::is('admin/permissions/*') ||Request::is('admin/roles/*') ||Request::is('admin/users/*')? 'mm-collapse mm-show': '' }}"
                        aria-expanded="false">

                        @if (env('ENABLE_PERMISSIONS_MODULE') == 1)
                            <li class="{{ Request::is('admin/modules/*') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.modules.index') }}"
                                    class="{{ Request::is('admin/modules/*') ? 'active' : '' }}">
                                    <i class="ri-arrow-right-fill"></i>
                                    <span>Modules</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('admin/permissions/*') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.permissions.index') }}"
                                    class="{{ Request::is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="ri-arrow-right-fill"></i>
                                    <span>Permissions</span>
                                </a>
                            </li>
                        @endif
                        <li class="{{ Request::is('admin/roles/*') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.roles.index') }}"
                                class="{{ Request::is('admin/roles/*') ? 'active' : '' }}">
                                <i class="ri-arrow-right-fill"></i>
                                <span>Roles</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/users/*') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.users.index') }}"
                                class="{{ Request::is('admin/users/*') ? 'active' : '' }}">
                                <i class="ri-arrow-right-fill"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </li>



                <li {{ Request::is('admin/settings/*') ? 'class="mm-active"' : '' }}>
                    <a href="javascript: void(0);"
                        class="has-arrow waves-effect {{ Request::is('admin/settings/*') ? 'mm-active' : '' }}">
                        <i class="ri-settings-2-line"></i>
                        <span>Setup & Configurations</span>
                    </a>
                    <ul class="sub-menu  {{ Request::is('admin/settings/*') ? 'mm-collapse mm-show' : '' }}"
                        aria-expanded="false">
                        <li {{ Request::is('admin/settings/general-settings') ? 'class="mm-active"' : '' }}>
                            <a href="{{ route('admin.settings.general-settings') }}"
                                {{ Request::is('admin/settings/general-settings') ? 'class="active"' : '' }}>
                                <i class="ri-arrow-right-fill"></i>
                                <span>General Settings</span>
                            </a>
                        </li>

                        <li {{ Request::is('admin/settings/email-templates') ? 'class="mm-active"' : '' }}>
                            <a href="{{ route('admin.settings.email-templates.index') }}"
                                {{ Request::is('admin/email-templates') ? 'class="active"' : '' }}>
                                <i class="ri-arrow-right-fill"></i>
                                <span>Email Template</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
