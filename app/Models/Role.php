<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function add($inputData){
        return self::create($inputData);
    }

    public function updateById($id,$inputData){
        return $this->where('id',$id)->update($inputData);
    }

    public function deleteById($clause){
        return $this->where($clause)->delete();
    }

    public function getById($clause){
        return $this->where($clause)->first() ?? [];
    }

    public function getAll($search = []){
        $items = $this->query();

        if(!empty($search)){
            $items->where($search);
        }
        return $items->get() ?? [];
    }
}
