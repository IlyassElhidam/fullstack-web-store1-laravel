<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crad extends Model
{
    use HasFactory;
    protected $fillable=['userID','productID','quantity'];
}
