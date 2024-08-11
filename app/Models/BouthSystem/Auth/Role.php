<?php

namespace App\Models\BouthSystem\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }
}
