<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::count() < 1) {

    		$password = '12345';
            $faker = Faker::create();
            DB::table('users')->insert([
                'name' => 'Admin',
                'lastname' => $faker->lastName,
                'email' => 'admin@globalpaq.mx',
                'phone' => $faker->phoneNumber,
                'password' => bcrypt($password),
                'activo' => 1,
                'role' => 'administrador',
                'foto' => $faker->imageUrl,
                'faker' => 1,
                'email_verified_at' => now(),
                'remember_token' => str_random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }

        if(User::count() === 1) {

            $password = '12345';
            $faker = Faker::create();
            for ($i=0; $i < 49; $i++) {
                DB::table('users')->insert([
                    'name' => $faker->name,
                    'lastname' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'activo' => 1,
                    'role' => 'cliente',
                    'foto' => $faker->imageUrl,
                    'faker' => 1,
                    'email_verified_at' => now(),
                    'remember_token' => str_random(10),
                    'password' => bcrypt($password),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

        }

    }
}
