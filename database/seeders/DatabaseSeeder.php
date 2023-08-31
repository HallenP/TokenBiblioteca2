<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            // creamos un parametro el cual al ser corrido con el comando de seeder, ese usuario,
            // contraseña y rol estaran por defecto al iniciar sesion, tambien encryptamos la contraseña con el Hash
        User::create([
            'name' => 'hallen',
            
            
            
            'email' => 'hp@gmail.com',
            'password' => Hash::make('123'),
            'IdRol' => '1'
            
        ]);
    }
}
