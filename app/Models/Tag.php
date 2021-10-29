<?php

namespace App\Models;

use App\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $fillable = [
        'name',
        'desc',
        'status',
        'sort',
    ];
    public const STATUS_NORMAL = 1;
    public const STATUS_HIDEN = 0;

    public function poetries()
    {
        return $this->belongsToMany(Poetry::class, 'poetry_tags');
    }
}
