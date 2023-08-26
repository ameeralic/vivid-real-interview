<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\FileManagement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\V1\CompanyResource;
use App\Http\Resources\V1\CompanyCollection;
use App\Http\Requests\V1\Company\StoreRequest;
use App\Http\Requests\V1\Company\UpdateRequest;

class CompanyController extends Controller
{
    //
    public function index()
    {
        return new CompanyCollection(Company::paginate(10));

    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return new CompanyResource($company);
    }

    public function store(FileManagement $fileManagement)
    {
        $attributes = $this->validateCompany();
        if ($attributes['logo'] ?? false) {
            $attributes['logo'] = $fileManagement->uploadFile(
                file:$attributes['logo'],
                path:'images/companies/' . $attributes['email'] . '/logo'
            );
        }

        $company = Company::create($attributes);
        return new CompanyResource($company);
    }

    public function update($id)
    
    {
        $company = Company::findOrFail($id);
        // return request()->all();
        $attributes = $this->validateCompany($company);
        $fileManagement = new FileManagement();

        if ($attributes['logo']) {
            $attributes['logo'] =
            $fileManagement->uploadFile(
                file:$attributes['logo'] ?? false,
                deleteOldFile:$company->logo ?? false,
                oldFile:$company->logo,
                path:'images/companies/' . ($company['email'] !== $attributes['email'] ? $attributes['email'] : $company['email']) . '/logo',
            );
        } else if ($company->logo) {
            $fileManagement->deleteFile(
                fileUrl:$company->logo
            );
        }

        if ($company['email'] !== $attributes['email']) {
            $fileManagement->moveFiles(
                oldPath:'images/companies/' . $company['email'] . '/logo',
                newPath:'images/companies/' . $attributes['email'] . '/logo',
                deleteDirectory:'images/companies/' . $company['email']
            );
            $attributes['logo'] = str_replace($company['email'], $attributes['email'], $attributes['logo']);
        }
        if ($company->update($attributes)) {
            return response()->json(
                ['message' => 'Update Successfull!']
            );
        } else {
            return response()->json(
                ['message' => 'Update Failed!']
            );
        }
    }

    public function destroy($id)
    {
        // dd($teacher->course->all());
        $company = Company::findOrFail($id);
        $company->delete();
        Storage::disk('public')->deleteDirectory('images/companies/' . $company['email']);

        return [
            'message' => 'delete successfull',
        ];
    }

    protected function validateCompany( ? Company $company = null) : array
    {
        $company ??= new Company();

        return request()->validate(
            [
                'name' => 'required|min:3|max:50',
                'logo' => $company->exists ? 'nullable' : 'nullable|mimes:jpeg,png |max:2096',
                'email' => ['required', 'email', Rule::unique('companies', 'email')->ignore($company)],
                'website' => 'required|min:3|max:50',
            ],
            [
                'logo' => 'Upload Logo image as jpg/png format with size less than 2MB',
            ]
        );
    }
}
