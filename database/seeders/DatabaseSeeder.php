<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создание ролей
        \App\Models\RoleAdmin::create([
            'name' => 'Главный администратор',
        ]);
        \App\Models\RoleAdmin::create([
            'name' => 'Администратор',
        ]);
        \App\Models\RoleAdmin::create([
            'name' => 'Модератор',
        ]);
        
        // Создание главного админа
        \App\Models\Admin::create([
            'nickname' => 'kovinar',
            'login' => 'kostin.kirill.04@gmail.com',
            'password' => '123456',
            'role_id' => 1,
            'path_icon' => null,
        ]);
        \App\Models\Admin::create([
            'nickname' => 'Loft',
            'login' => 'lord2280411@gmail.com',
            'password' => '123456',
            'role_id' => 2,
            'path_icon' => null,
        ]);
        \App\Models\Admin::create([
            'nickname' => 'Krillis Kstoni',
            'login' => 'kovinar2@gmail.com',
            'password' => '123456',
            'role_id' => 3,
            'path_icon' => null,
        ]);
    }
}
