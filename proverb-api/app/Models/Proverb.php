<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proverb extends Model
{
    protected $table = 'proverbs';
    protected $fillable = [
        'name',
        'content'
    ];
}
