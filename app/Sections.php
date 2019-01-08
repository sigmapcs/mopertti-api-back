<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $table = 'table_sections_category';

    protected $fillable = ['name'];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
