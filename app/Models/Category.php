<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories' ;

    protected $fillable =['ar_name' ,'en_name', 'created_at', 'updated_at'];
}
