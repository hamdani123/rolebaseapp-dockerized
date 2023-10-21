<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public function deleteByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->delete();
    }

    public function add($user_id, array $role_ids): bool
    {
        $insertData = [];
        $result = false;
        $current_datetime = now();
        if (!empty($role_ids)) {
            foreach ($role_ids as $role_id) {
                $insertData[] = [
                    'user_id' => $user_id,
                    'role_id' => $role_id,
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
    public function updateByUserId($user_id, array $role_ids): bool
    {
        $this->deleteByUserId($user_id);

        return $this->add($user_id, $role_ids);
    }
}
