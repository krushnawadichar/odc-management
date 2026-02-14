<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractRequest extends Model
{
    protected $table = 'contract_requests';

    protected $fillable = [
        'odc_manpower_id',
        'company_id',
        'status',
    ];

    public function manpower()
    {
        return $this->belongsTo(OdcManpower::class,'odc_manpower_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
