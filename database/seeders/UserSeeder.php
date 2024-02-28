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
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'user@test.com';
        $user->password = bcrypt('12345678');
        $user->save();
        #$user->assignRole($roleUser);

        $user = new User();
        $user->name = 'Test Admin';
        $user->email = 'admin@test.com';
        $user->password = bcrypt('12345678');
        $user->rol = 'admin';
        $user->save();
        #$user->assignRole($roleAdmin);

        $user = new User();
        $user->name = 'Test Medic';
        $user->email = 'medic@test.com';
        $user->password = bcrypt('12345678');
        $user->rol = 'medic';
        $user->save();

    }
}
