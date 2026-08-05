<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterLocaleAwareServicesPass;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::Create(
            ['name' => 'admin']
        );

        Role::Create(
            ['name' => 'kasir']
        );
    }
}
