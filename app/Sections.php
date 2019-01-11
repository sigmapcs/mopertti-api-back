<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $table = 'sections';

    protected $fillable = ['id','name'];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
