<?php

namespace App\Models\BouthSystem\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
