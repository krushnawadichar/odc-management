<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'company_name',
        'contact_person',
        'phone',
        'required_date',
        'required_manpower',
        'status',
    ];

    public function requests()
    {
        return $this->hasMany(ContractRequest::class);
    }

}
