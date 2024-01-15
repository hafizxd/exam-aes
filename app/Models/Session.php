<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;
use App\Models\Attendant;

class Session extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'code',
        'code_encrypted',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function attendants()
    {
        return $this->hasMany(Attendant::class);
    }
}
