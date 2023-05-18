<?php
namespace App\Libraries;

use App\Models\AdminModule;
use App\Models\AdminPermission;
use Illuminate\Support\Facades\Auth;

class SiteHelper
{
    public static function get_admin_sidebar_tree()
    {
        $modules = AdminModule::where('view_sidebar', 1)->with(['permissions' => function ($q) {
            $q->where('view_sidebar', 1)
                ->where('status', 1)
                ->orderBy('rank', 'ASC');
            if (Auth::user()->role_id != 1) {
                $q->whereHas('admin_permissions');
            }
        }]);
        
        if (Auth::user()->role_id != 1) {
            $modules = $modules->whereHas('admin_module_permissions')
                ->whereHas('permissions.admin_permissions');
        }
        $modules = $modules->orderBy('module_rank', 'ASC')
            ->withCount(['permissions'])
            ->get();
        return $modules;
    }
    public static function admin_has_permission($module, $permission)
    {
        if (Auth::user()->role_id == 1) {
            return 1;
        } else {
            $admin_permission = AdminPermission::where('role_id', Auth::user()->role_id);

            if ($module) {
                $admin_permission = $admin_permission->where('module_id', $module);
            }

            if ($permission) {
                $admin_permission = $admin_permission->where('permission_id', $permission);
            }
            $admin_permission = $admin_permission->first();
            return $admin_permission ? 1 : 0;
        }

    }
}
