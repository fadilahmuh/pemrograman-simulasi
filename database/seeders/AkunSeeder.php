<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fannie M F',
            'email' => 'fadilahmuhammad800@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
