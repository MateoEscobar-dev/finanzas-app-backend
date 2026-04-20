<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                '0000',
                "Usuario",
                "",
                "Del sistema",
                "",
                "0000000000",
                "",
                "Calle 109 # 18b31 Bogotá",
                "system@gmail.com",
                "2023-03-01 00:00:00",
                '$2y$10$Jon9U1CREjwL94xMRLkOT.ULQWtCxKPJbnzEWdVNOTCTY1br4Po5e',
                "es",
                1,
                "1997-10-20",
                "Administrator"
            ],
            [
                '0001',
                "Admin",
                "",
                "Escobar",
                "",
                "0000000000",
                "",
                "Calle 109 # 18b31 Bogotá",
                "admin@gmail.com",
                "2023-03-01 00:00:00",
                '$2y$10$Jon9U1CREjwL94xMRLkOT.ULQWtCxKPJbnzEWdVNOTCTY1br4Po5e',
                "es",
                1,
                "1997-10-20",
                "Administrator"
            ],
        ];

        foreach($users as $user){
            $row = User::create(["document" => $user[0], "first_name" => $user[1], "second_name" => $user[2], "first_last_name" => $user[3], "second_last_name" => $user[4], "phone" => $user[5], "phone_ext" => $user[6], "address" => $user[7], "email" => $user[8], "email_verified_at" => $user[9], "password" => $user[10], "lang" => $user[11], "active" => $user[12], "birth_day" => $user[13]]);
            $role = Role::where('name', $user[14])->first(); // Obtén el rol por nombre
            $row->assignRole($role);
        }
    }
}
