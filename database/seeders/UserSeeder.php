<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        Permission::create(['name' => 'show:role']);
        Permission::create(['name' => 'create:role']);
        Permission::create(['name' => 'edit:role']);
        Permission::create(['name' => 'delete:role']);

        Permission::create(['name' => 'show:permission']);

        Permission::create(['name' => 'show:user']);
        Permission::create(['name' => 'create:user']);
        Permission::create(['name' => 'edit:user']);
        Permission::create(['name' => 'delete:user']);

        $user = new User();
        $user->name = 'Test User';
        $user->email = 'user@test.com';
        $user->password = bcrypt('12345678');
        $user->save();
        $user->assignRole($roleUser);

        $user = new User();
        $user->name = 'Test Admin';
        $user->email = 'admin@test.com';
        $user->password = bcrypt('12345678');
        $user->rol = 'admin';
        $user->save();
        $user->assignRole($roleAdmin);

    }
}
