<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestQuestion;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function testQuestions()
    {
        return $this->hasMany(TestQuestion::class);
    }
}
