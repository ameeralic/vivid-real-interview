<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    protected $with = ['company'];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company_id',
        'phone',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
