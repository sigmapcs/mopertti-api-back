<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'table_categories';

    protected $fillable = ['name','parent'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
