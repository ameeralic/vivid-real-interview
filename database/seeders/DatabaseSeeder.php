<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'first_name' => config('admin.first_name'),
            'last_name' => config('admin.last_name'),
            'email' => config('admin.email'),
            'password' => config('admin.password'),
        ]);

        Company::factory(30)->has(Employee::factory()->count(3))->create();
    }
}
