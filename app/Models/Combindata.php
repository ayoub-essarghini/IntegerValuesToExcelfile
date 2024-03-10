<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combindata extends Model
{
    use HasFactory;

    protected $fillable = [
        'a',
        'b',
        'res',
        'x',
        'fres'
    ];
}
