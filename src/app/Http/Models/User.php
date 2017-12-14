<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'gv_admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'status', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

}
