<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_id',  // Add batch_id here
        'user_id',
    ];
}
