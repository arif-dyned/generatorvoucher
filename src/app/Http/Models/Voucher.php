<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'gv_voucher';

    public function organization()
    {
        return $this->hasMany('App\http\model\Organization');
    }
}
