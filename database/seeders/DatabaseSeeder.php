<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profesi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Administration',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'role_id' => 1,
            'password' => bcrypt('123456')
        ]);

        // Profesi::create([
        //     'nama_profesi' => 'Mahasiswa/Pelajar (Student)',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'Aparatur Sipil Negara (Civil Servant/Civil Service Employee)',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'Karyawan (Corporate Employee)',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'Mentor EJSC/MJC',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'Talenta MJC',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'Wirausahawan/ Wiraswasta/ Usahawan (Enterpreneur)',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'Umum (Citizen)',
        // ]);
        // Profesi::create([
        //     'nama_profesi' => 'UMKM',
        // ]);
    }
}