<?php 
namespace Utils\Seeders;

use App\Models\User;


class UserSeeder
{
    public static function seed(int $userNumber)
    {
        $faker = \Faker\Factory::create();
        for($i=0; $i<$userNumber; $i++)
        {
            User::create([
                'username' => $faker->name(),
                'email' => $faker->email(),
                'password' => '1234',//Mot de passe par défaut
                'role_id' => 2 //Role par défaut, client
            ]);
        }

        echo "seeding completed, $userNumber new users inserted...😀";
    }

    public static function clear()
    {
        $users = User::all();

        foreach($users as $user);
        {
            if((int)$user->getId() > 2)
            {
                $user->delete();
            }
        }

        User::resetIncrement();
        echo "The users table is now empty(instead of the 2 first accounts)😉";
    }
}