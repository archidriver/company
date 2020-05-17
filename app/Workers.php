<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{

    protected $fillable = ['name', 'position_id', 'date_start', 'salary', 'level', 'manager_id', 'image'];


    public function WorkersManager(){
        return $this->hasMany($this, 'manager_id');
    }

    public function rootManager(){
        return $this->where('manager_id', null)->with('WorkersManager')->get();
    }

}
