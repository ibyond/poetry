<?php

namespace App\Models;

use App\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dynasty extends Model
{
    use HasFactory, HasDateTimeFormatter, SoftDeletes;

    protected $fillable = [
        'name',
        'desc',
    ];
}
