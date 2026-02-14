<?php
namespace App\Services;

use App\Models\OdcManpower;
use App\Models\Company;
use App\Models\ContractRequest;
use Illuminate\Support\Facades\DB;

class OdcService
{
    public function registerManpower($data)
    {
        return OdcManpower::create($data);
    }

    public function registerCompany($data)
    {
        return Company::create($data);
    }

    public function createRequest($manpowerId, $companyId)
    {
        return ContractRequest::create([
            'odc_manpower_id' => $manpowerId,
            'company_id' => $companyId,
        ]);
    }

    public function approveRequest($requestId)
    {
        return DB::transaction(function() use ($requestId){

            $request = ContractRequest::findOrFail($requestId);

            $request->update(['status' => 'approved']);

            $request->manpower->update(['status' => 'booked']);

            return true;
        });
    }
}
