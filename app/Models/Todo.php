<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Todo extends Model
{
    use HasFactory;
    protected $dates = ['deadline'];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
