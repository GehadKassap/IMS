<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        $super_admin_user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@ims.com',
            'password' => Hash::make('adminIms')
        ]);
        $super_admin_user->assignRole('super admin');
        

        $dev_user = User::factory()->create([
            'name' => 'Abed Said',
            'email' => 'abed.allah.said@gmail.com',
            'password' => Hash::make('abedsaid')
        ]);
        $dev_user->assignRole('admin');

        $stuff_user = User::factory()->create([
            'name' => 'stuff user',
            'email' => 'stuff@gmail.com',
            'password' => Hash::make('stuff')
        ]);
        $stuff_user->assignRole('stuff');

        $student_user = User::factory()->create([
            'name' => 'student user',
            'email' => 'student@gmail.com',
            'password' => Hash::make('student')
        ]);
        $student_user->assignRole('student');


        $guest_user = User::factory()->create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('guest')
        ]);
        $guest_user->assignRole('guest');

        
    }
}
