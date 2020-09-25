<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table="provinces";
    protected $primaryKey="id";
    protected $guarded=[];

    public function district(){
        return $this->hasMany('App\District','province_id','id');
    }
}
