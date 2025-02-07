<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    public function run() {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$BWh/AXxP8xfBzT8cGpXgAuKnb744Q5x.p1HhuGhKv.YUwBJZqztBO',
                'remember_token' => null,
                'created_at'     => '2025-01-29 22:09:53',
                'updated_at'     => '2025-01-29 22:09:53',
            ],
        ];

        User::insert($users);
    }
}
