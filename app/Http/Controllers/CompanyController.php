<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CompanyController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Companies/Index', [
            'users' => Company::paginate(10)->withQueryString(),
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Companies/Create');
    }

    public function store(FileManagement $fileManagement)
    {
        // dd('ss');
        $attributes = $this->validateCompany();
        if ($attributes['logo'] ?? false) {
            $attributes['logo'] = $fileManagement->uploadFile(
                file:$attributes['logo'],
                path:'images/companies/' . $attributes['email'] . '/logo'
            );
        }

        $company = Company::create($attributes);

        if (Auth::guard('web')->check()) {
            if (Auth::user()->can('admin')) {
                return redirect('/admin-dashboard')->with('success', 'Company has been created.');
            }
            return;
        }
        return;

    }

    public function edit(Company $company)
    {
        return Inertia::render('AdminDashboard/Companies/Edit', [
            'user' => $company
        ]);

    }

    public function update(Company $company)
    {

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
        $company->update($attributes);

        return back()->with('success', 'Company Updated!');
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

    public function destroy(Company $company)
    {
        // dd($teacher->course->all());
        $company->delete();
        Storage::disk('public')->deleteDirectory('images/companies/' . $company['email']);

        return redirect('/admin-dashboard/companies')->with('success', 'Company Deleted!');
    }

}
