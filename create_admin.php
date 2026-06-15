<?php
use App\Models\User;
User::updateOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Administrator',
        'username' => 'admin',
        'password' => bcrypt('password'),
        'role' => 'Admin',
        'status' => 'Aktif'
    ]
);
echo "Admin user created successfully.\n";
