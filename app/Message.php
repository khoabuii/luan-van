<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table='message';
    protected $primaryKey='id';
    protected $guarded=[];
    protected $fillable=[
        'sitter','parent','content','check'
    ];
}
