<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nom' => 'admin',
                'firstname' => 'Super',
                'lastname'  => 'Admin',
                'mot_de_passe' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
