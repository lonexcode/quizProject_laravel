<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{

    protected $table = 'quizzes';


    function category()
    {
        return $this->belongsTo(Category::class);
    }


    function Mcq(){
        return $this->hasMany(Mcq::class);
    }
}
