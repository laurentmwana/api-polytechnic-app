<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enum\SpatieUserRoleEnum;
use Spatie\Permission\Models\Role;
use App\Enum\SpatieUserPermissionEnum;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpatiePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SpatieUserRoleEnum::cases() as $role) {
            Role::create(['name' => $role->value]);
        }

        foreach (SpatieUserPermissionEnum::cases() as $permission) {
            Permission::create(['name' => $permission->value]);
        }

        // administrateur
        Role::findByName(SpatieUserRoleEnum::ROLE_ADMIN->value)
            ->givePermissionTo(
                Permission::findByName(SpatieUserPermissionEnum::PERMISSION_FULL->value)
            );
    }
}
