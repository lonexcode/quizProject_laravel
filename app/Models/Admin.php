<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
   //protected $table = 'admin';
   public $timestamps = false;



   function getNameAttribute($val)
   {
      return ucfirst($val);
   }
}
