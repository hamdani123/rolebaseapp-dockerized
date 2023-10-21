<?php

namespace App\Services;

use App\Models\RolePermission;
use App\Models\UserRole;
use App\Utils\ApiStatusCode;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PermissionService extends Service
{

    protected function makeModel()
    {
        // TODO: Implement makeModel() method.
    }

    public function setUserRole($user_id, $role_ids)
    {

        $this->code = ApiStatusCode::FAILED;
        $this->message = __('User role setup has been failed.');

        DB::beginTransaction();

        try {

            (new UserRole())->updateByUserId($user_id, $role_ids);

            DB::commit();

            $this->code = ApiStatusCode::SUCCESS;
            $this->message = __('User role has been set successfully.');

        } catch (\Exception $ex) {
            DB::rollback();
        }
    }

    public function setRolePermission($role_id, $permission_ids)
    {

        $this->code = ApiStatusCode::FAILED;
        $this->message = __('Role permission setup has been failed.');

        DB::beginTransaction();

        try {

            (new RolePermission())->updateByRoleId($role_id, $permission_ids);

            DB::commit();

            $this->message = __('Role permission has been set successfully.');

        } catch (\Exception $ex) {
            DB::rollback();
        }
    }

    public function getPermissionByUserId($user_id) : array
    {
        $permissions =  DB::table('user_roles')
            ->join('role_permissions', 'role_permissions.role_id', '=', 'user_roles.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->where('user_roles.user_id', $user_id)
            ->get()
            ->toArray();

        $index_list = [];
        $permissions_array = json_decode(json_encode($permissions),true);
        $permission_keys = [];
        foreach($permissions_array as $p){
            if($p['is_index'] == 1){
                $index_list[$p['parent_id']] = $p;
            }

            if(!empty($p['key'])){
                $permission_keys[] = $p['key'];
            }
        }

        if(!empty($permission_keys)) {
            $result['permission_keys'] = $permission_keys;
        }

        $result['sidebar'] = $this->makeSideBar($permissions_array,0,$index_list);
        return $result;
    }

    private function makeSideBar($elements,$parent_id = 0, $index_list) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parent_id) {

                $children = $this->makeSideBar($elements, $element['id'],$index_list);
                //dd($element);
                if(isset($index_list[$element['id']])){
                    $element['key'] = $index_list[$element['id']]['key'];
                    $element['is_index'] = 1;
                }

                if (!empty($children)) {
                    $element['children'] = $children;
                }

                $branch[] = $element;
                unset($elements[$element['id']]);

            }
        }

        return $branch;
    }

}
