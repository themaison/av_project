<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Создание пользователя с ролью 'recruiter'
        $user = User::create([
            'name' => 'Шевелёв Кирилл Станиславович',
            'email' => 'korall@mail.ru',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole('recruiter');

        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->contacts = $user->email;
        $profile->save();

        // Создание пользователя с ролью 'applicant'
        $user = User::create([
            'name' => 'Мельничук Владислав Викторович',
            'email' => 'melnichuk1712@mail.ru',
            'password' => bcrypt('666666'),
        ]);
        $user->assignRole('applicant');

        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->contacts = $user->email;
        $profile->save();
    }
    
}
