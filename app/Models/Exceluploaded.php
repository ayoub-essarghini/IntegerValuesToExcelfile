<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exceluploaded extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path',
        'size',
        'date_create',
    ];
}
