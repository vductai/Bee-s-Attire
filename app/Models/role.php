<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class role extends Model
{
    use HasFactory;
    protected $primaryKey = "role_id";
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
        'role_name',
        'role_desc'
    ];

    public function user()
    {
         return $this->hasMany(User::class, 'role_id');
    }
}
