<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    /** @use HasFactory<\Database\Factories\PartyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'pin_code',
        'notes',
    ];

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
