<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $administrator = User::create([
            'type' => UserTypeEnum::ADMINISTRATOR(),
            'name' => 'Mohamed Nader',
            'email' => 'httpsnader@gmail.com',
            'password' => Hash::make(123),
        ]);
        $administrator->assignRole(1);

        $customerService = User::create([
            'type' => UserTypeEnum::CUSTOMER_SERVICE(),
            'name' => 'Customer Service Test',
            'email' => 'customer.service@gmail.com',
            'password' => Hash::make(123),
        ]);
        $customerService->assignRole(3);

        $user = User::create([
            'type' => UserTypeEnum::USER(),
            'name' => 'User 01',
            'email' => 'user01@gmail.com',
            'password' => Hash::make(123),
        ]);
        $user->assignRole(2);

        $user = User::create([
            'type' => UserTypeEnum::USER(),
            'name' => 'User 02',
            'email' => 'user02@gmail.com',
            'password' => Hash::make(123),
        ]);
        $user->assignRole(2);

        User::create([
            'type' => UserTypeEnum::CLIENT(),
            'name' => 'Client 01',
            'email' => 'client01@gmail.com',
            'password' => Hash::make(123),
        ]);

        User::create([
            'type' => UserTypeEnum::CLIENT(),
            'name' => 'Client 02',
            'email' => 'client02@gmail.com',
            'password' => Hash::make(123),
        ]);
    }
}
