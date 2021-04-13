<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Task extends Model
{   
    protected $fillable = [
        'task', 'user_id'
    ];
}
