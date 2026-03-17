<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Personal Information
        'first_name',
        'last_name',
        'user_id',
        'dob',
        'gender',
        'profile_image',
        
        // Worker Details
        'skills',
        'other_skill',
        'registration_date',
        'salary_per_day',
        'employment_type',
        'status',
        
        // Education & Work
        'highest_education',
        'work_duration',
        'document_name',
        'document_path',
        
        // Address
        'address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dob' => 'date',
        'registration_date' => 'date',
        'salary_per_day' => 'decimal:2',
        'skills' => 'array', // Auto-cast JSON to array
    ];

    /**
     * Get the worker's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the profile image URL.
     *
     * @return string|null
     */
    public function getProfileImageUrlAttribute(): ?string
    {
        return $this->profile_image ? asset('storage/' . $this->profile_image) : null;
    }

    /**
     * Get the document URL.
     *
     * @return string|null
     */
    public function getDocumentUrlAttribute(): ?string
    {
        return $this->document_path ? asset('storage/' . $this->document_path) : null;
    }

    /**
     * Get formatted skills as comma-separated string.
     *
     * @return string
     */
    public function getFormattedSkillsAttribute(): string
    {
        $skills = $this->skills ?? [];
        
        if ($this->other_skill) {
            $skills[] = $this->other_skill;
        }
        
        return !empty($skills) ? implode(', ', $skills) : 'N/A';
    }

    /**
     * Get the salary per day formatted with currency.
     *
     * @return string
     */
    public function getFormattedSalaryAttribute(): string
    {
        return '₹' . number_format($this->salary_per_day, 2) . '/day';
    }

    /**
     * Get the registration date formatted as d-m-Y.
     *
     * @return string
     */
    public function getFormattedRegistrationDateAttribute(): string
    {
        return $this->registration_date ? $this->registration_date->format('d-m-Y') : 'N/A';
    }

    /**
     * Get the date of birth formatted as d-m-Y.
     *
     * @return string
     */
    public function getFormattedDobAttribute(): string
    {
        return $this->dob ? $this->dob->format('d-m-Y') : 'N/A';
    }

    /**
     * Get the status badge class.
     *
     * @return string
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status == 'Active' ? 'bg-success' : 'bg-danger';
    }

    /**
     * Scope a query to only include active workers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    /**
     * Scope a query to filter by skill.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $skill
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySkill($query, $skill)
    {
        return $query->whereJsonContains('skills', $skill);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set default registration date to current date if not provided
        static::creating(function ($worker) {
            if (empty($worker->registration_date)) {
                $worker->registration_date = now();
            }
        });
    }

            public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}