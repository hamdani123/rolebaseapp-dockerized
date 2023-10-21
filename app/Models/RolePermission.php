<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public function deleteByRoleId($role_id)
    {
        return $this->where('role_id', $role_id)->delete();
    }

    public function add($role_id, array $permission_ids): bool
    {
        $insertData = [];
        $result = false;
        $current_datetime = now();
        if (!empty($permission_ids)) {
            foreach ($permission_ids as $permission_id) {
                $insertData[] = [
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                    'created_at' => $current_datetime,
                    'updated_at' => $current_datetime,
                ];
            }
        }

        if (!empty($insertData)) {
            $result = true;
            self::insert($insertData);
        }

        return $result;
    }
    public function updateByRoleId($role_id, array $permission_ids): bool
    {
        $this->deleteByRoleId($role_id);

        return $this->add($role_id, $permission_ids);
    }
}
