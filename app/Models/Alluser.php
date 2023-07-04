<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alluser extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'name', 'email', 'address','pan_no','adhaar_no','image'
    ];
}
