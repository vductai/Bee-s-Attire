<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify_manager extends Model
{
    use HasFactory;
    protected $table = 'notify_manager';
    protected $fillable = ['message', 'category'];
}
