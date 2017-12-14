<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'gv_organizations';

    public function voucher()
    {
        return $this->belongsTo('App\http\model\Voucher');
    }
}
