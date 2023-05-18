<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                @php
                    $admin_sidebar_data = \SiteHelper::get_admin_sidebar_tree();
                @endphp

                @if ($admin_sidebar_data && count($admin_sidebar_data) > 0)
                    @foreach ($admin_sidebar_data as $item)
                        @if ($item->is_multi_level == 0)
                            <li {{ str_replace('{ACTIVE_CLASS}', 'mm-active', $item->module_key) }}>
                                <a href="{{ route($item->module_url) }}"
                                    class="waves-effect {{ str_replace('{ACTIVE_CLASS}', 'active', $item->module_key) }}">
                                    {!! $item->icon !!}
                                    <span>{{ $item->name }}</span>
                                </a>
                            </li>
                        @else
                            <li class="{{ str_replace('{ACTIVE_CLASS}', 'mm-active', $item->module_key) }}">
                                <a href="javascript: void(0);"
                                    class="has-arrow waves-effect {{ str_replace('{ACTIVE_CLASS}', 'mm-active', $item->module_key) }}">
                                    {!! $item->icon !!}
                                    <span>{{ $item->name }}</span>
                                </a>
                                <ul class="sub-menu  {{ str_replace('{ACTIVE_CLASS}', 'mm-collapse mm-show', $item->module_key) }}"
                                    aria-expanded="false">
                                    @if ($item->permissions_count > 0)
                                        @foreach ($item->permissions as $permission)
                                            <li
                                                class="{{ Request::is($permission->permission_key) ? 'mm-active' : '' }}">
                                                <a href="{{ route($permission->url) }}"
                                                    class="{{ Request::is($permission->permission_key) ? 'active' : '' }}">
                                                    {!! $permission->icon !!}
                                                    <span>{{ $permission->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
