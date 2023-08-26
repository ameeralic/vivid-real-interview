<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $showEmployees = $request->query('showEmployees');

        $data = [
            'id' => $this->id,
            'companyName' => $this->name,
            'companyEmail' => $this->email,
            'companyLogo' => $this->logo,
            'companyWebsite' => $this->website,
        ];
        if ($showEmployees === "true") {
            $data += array('companyEmployees' => $this->employees);
        }
        return $data;
    }
}
