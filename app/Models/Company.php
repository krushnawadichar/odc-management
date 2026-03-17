<?php
// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'registration_number',
        // 'email',
        'founded_year',
        'contact_person_name',
        'contact_person_designation',
        'contact_person_email',
        'contact_person_phone',
        'address',
        'country',
        'state',
        'city',
        'postal_code',
        'document_name',
        'document',
        'status'
    ];

    protected $casts = [
        'founded_year' => 'integer',
    ];

    // Relationships
    public function countryData()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function stateData()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function cityData()
    {
        return $this->belongsTo(City::class, 'city');
    }

    // Accessors
    public function getDocumentUrlAttribute()
    {
        return $this->document ? asset('storage/' . $this->document) : null;
    }

    public function getCountryNameAttribute()
    {
        return $this->countryData->name ?? 'N/A';
    }

    public function getStateNameAttribute()
    {
        return $this->stateData->name ?? 'N/A';
    }

    public function getCityNameAttribute()
    {
        return $this->cityData->name ?? 'N/A';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'Inactive');
    }

        public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}