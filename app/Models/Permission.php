<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function add($inputData){
        return self::create($inputData);
    }

    public function updateById($id,$inputData){
        return $this->where('id',$id)->update($inputData);
    }

    public function deleteById($id){
        return $this->where('id',$id)->delete();
    }

    public function getById($id){
        return $this->where('id',$id)->first();
    }

    public function getAll($search = []){
        $items = $this->query();

        if(!empty($search)){
            $items->where($search);
        }
        return $items->get() ?? [];
    }
}
