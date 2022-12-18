<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'title', 'image', 'shortdescription',
        'fulldescription','startTime', 'endTime',
    ];
}
