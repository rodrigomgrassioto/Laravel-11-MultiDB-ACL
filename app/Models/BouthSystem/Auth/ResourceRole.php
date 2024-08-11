<?php

namespace App\Models\BouthSystem\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceRole extends Model
{
    use HasFactory;

    protected $table = 'resource_role';

    public $timestamps = false;

    protected $fillable = [
        'resource_id',
        'role_id',
    ];
}
