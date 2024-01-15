<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

class TestQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
