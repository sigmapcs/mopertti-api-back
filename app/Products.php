<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'table_products';

    protected $fillable = ['name','description','section','category','imgurl','notes'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
