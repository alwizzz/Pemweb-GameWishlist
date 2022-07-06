<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    function generateProducts(){
        Product::customCreate('Persona 4 Golden', 'JRPG, Turn-based', 'ATLUS', 260000, 'images/persona-4-golden.jpg');
        Product::customCreate('Elden Ring', 'Souls-like, Open World', 'FromSoftware', 600000, 'images/elden-ring.jpg' );
        Product::customCreate('Persona 5 Striker', 'Hack and Slash', 'ATLUS', 769000, 'images/persona-5-striker.jpg' );
        // Product::customCreate('', '', '', );
    }
    

    public function run()
    {
        $this->generateProducts();

        User::factory(5)->create();
        User::create([
            'name' => 'Muhammad Alwiza Ansyar',
            'username' => 'WeDay',
            'email' => 'alwiza21@gmail.com',
            // password value is 'password' for every user, but will be hashed
            'password' => bcrypt('12345') 
        ]);
    }
}
