<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'starts_at',
        'ends_at',
        'user_id',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
