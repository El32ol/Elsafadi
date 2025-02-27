<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'          => 'Akl Mohamed Akl',
            'email'         => 'super_admin@app.com',
            'password'      => Hash::make(123456),
            'super_admin'   => 1,
            'status'        => 'active'
        ]);
    }
}
