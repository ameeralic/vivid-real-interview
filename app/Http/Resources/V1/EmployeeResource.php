<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employeeFirstName' => $this->first_name,
            'employeeLastName' => $this->last_name,
            'employeeEmail' => $this->email,
            'employeePhoneNumber' => $this->phone,
            'employeeCompany' => [
                'companyId' => $this->company->id,
                'companyName' => $this->company->name,
                'companyEmail' => $this->company->email,
                'companyLogo' => $this->company->logo,
                'companyWebsite' => $this->company->website,
            ],
        ];
    }
}
