<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('title','Admin')->first();

        $user =  [
            'name' => 'administrator',
            'email' => 'admin@test.com',
            'password' => 'admin123',
            'remember_token' => Str::random(10),
            'role_id' => $role->id,
        ];

        User::create($user);
    }
}
