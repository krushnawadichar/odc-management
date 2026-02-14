<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OdcManpower extends Model
{
    protected $table = 'odc_manpowers';

    protected $fillable = [
        'name',
        'phone',
        'skills',
        'available_date',
        'status'
    ];

    public function requests()
    {
        return $this->hasMany(ContractRequest::class);
    }
}
