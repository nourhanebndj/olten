<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Laratrust crée ce modèle Role

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = ['particulier', 'livreur', 'conducteur', 'admin', 'locateur'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role], [
                'display_name' => ucfirst($role),
                'description' => ucfirst($role) . ' role',
            ]);
        }
    }
}
