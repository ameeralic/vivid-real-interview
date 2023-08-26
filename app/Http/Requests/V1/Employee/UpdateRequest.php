<?php

namespace App\Http\Requests\V1\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'firstName' => ['required'],
                'lastName' => ['required'],
                'companyId' => ['required'],
                'email' => ['required', 'email'],
                'phoneNumber' => ['required', 'max:10'],
            ];
        } else {
            return [
                'firstName' => ['sometimes', 'required'],
                'lastName' => ['sometimes', 'required'],
                'companyId' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
                'phoneNumber' => ['sometimes', 'required', 'max:10'],
            ];
        }

    }
    protected function prepareForValidation(): void
    {
        if ($this->firstName) {
            $this->merge([
                'first_name' => $this->firstName,
            ]);
        }
        if ($this->lastName) {
            $this->merge([
                'last_name' => $this->lastName,
            ]);
        }
        if ($this->companyId) {
            $this->merge([
                'company_id' => $this->companyId,
            ]);
        }
        if ($this->phoneNumber) {
            $this->merge([
                'phone' => $this->phoneNumber,
            ]);
        }
    }
}
