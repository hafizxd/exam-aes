<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendant;
use App\Models\TestQuestion;

class AttendantAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attendant()
    {
        return $this->belongsTo(Attendant::class);
    }

    public function testQuestion()
    {
        return $this->belongsTo(TestQuestion::class);
    }
}
