<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Session;
use App\Models\AttendantAnswer;

class Attendant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendantAnswers()
    {
        return $this->hasMany(AttendantAnswer::class);
    }
}
