<template>
    <div class="min-h-screen">
        <div class="py-48">
            <p class="text-xl font-semibold text-gray-700 dark:text-gray-100 mb-4">API Documentation</p>
            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Authentication</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/auth
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: POST
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Raw-Data(JSON): {
                    "email":"admin@admin.com",
                    "password":"password"
                    }
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Success Response: {
                    "message": "login Success!",
                    "token": .....
                    }
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Company - index</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/companies
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: GET
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Company - Single</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/companies/{id}?showEmployees=true 
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: GET
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Company - Create</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/companies/
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: POST
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    formData: <br/>
                    name: company name<br/>
                    logo: **Select file to upload<br/>
                    email: admin@admin.com<br/>
                    website: www.website.com
                    
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Company - Update</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/companies/{id}
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100 mb-2">
                    Method: POST
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    formData: <br/>
                    _method: PUT<br/>
                    name: company name<br/>
                    logo: **Select file to upload<br/>
                    email: admin@admin.com<br/>
                    website: www.website.com
                    
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Company - Delete</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/companies/1
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: DELETE
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Employee - index</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/employees
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: GET
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Employee - Single</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/employees/{id}
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: GET
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Employee - Create</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/employees/
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: POST
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    formData: <br/>
                    first_name: Employee first name<br/>
                    last_name: Employee last name<br/>
                    email: admin@admin.com<br/>
                    phone: 1234567890
                    
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Employee - Update</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/employees/{id}
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100 mb-2">
                    Method: POST
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    formData: <br/>
                    _method: PUT
                    first_name: Employee first name<br/>
                    last_name: Employee last name<br/>
                    email: admin@admin.com<br/>
                    phone: 1234567890
                    
                </p>
            </div>

            <div class="mb-4 border-2 p-4">
                <p class="font-medium text-lg text-gray-700 dark:text-gray-100 mb-2">Employee - Delete</p>
                <p class="text-lg text-gray-700 dark:text-gray-100">
                    http://127.0.0.1:8000/api/v1/employees/1
                </p>
                <p class="text-base text-gray-700 dark:text-gray-100">
                    Method: DELETE
                </p>
            </div>

        </div>

    </div>
</template>z
<script>
</script>
