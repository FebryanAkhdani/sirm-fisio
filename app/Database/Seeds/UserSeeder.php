<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = model(UserModel::class);

        // Tambah user dengan password yang di-hash otomatis oleh UserModel
        // $users->save([
        //     'email'    => 'user@example.com',
        //     'username' => 'user123',
        //     'password' => 'password123',  // Password akan di-hash oleh Shield
        // ]);

        // Tambah admin
        $users->save([
            'email'    => 'admin@example.com',
            'username' => 'admin123',
            'password' => 'adminpassword',
            'active'   => 1,  // Opsional: aktifkan user
            'roles'    => ['admin']  // Menambahkan role admin (disesuaikan dengan role Shield)
        ]);
    }
}
