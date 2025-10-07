<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $useradmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('rahasia'),
        ]);

        $admin = Role::where('name', 'admin')->first();
        $useradmin->addRole($admin);
    }
}
