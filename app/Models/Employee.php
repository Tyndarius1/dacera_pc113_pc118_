<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class Employee extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'gender',
    ];
}
