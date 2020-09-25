<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table="districts";
    protected $primaryKey="id";
    protected $guarded=[];

    public function province(){
        return $this->belongsTo('App\Province','province_id','id');
    }
}
