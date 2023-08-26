<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $appends = ['logo_url'];


    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    protected function logoUrl(): Attribute
    {
        parse_url($this->logo)['host'] ?? '' === 'images.pexels.com' ? $logo = $this->logo : $logo = 'assets/' . $this->logo;
        return Attribute::make(
            get:fn($value) => asset($logo)
        );
    }
}
