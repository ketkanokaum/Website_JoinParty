<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users') ->insert ([
        //     'username' => 'dada',
        //     'email' => 'emp1@gmail.com',
        //     'fristname' =>'wisrut',
        //     'lastname' =>'taiyawong',
        //     'password' => Hash::make('abc1234'),
        //     'usertype' => 'user'
        // ]);

        // DB::table('users') ->insert ([
        //     'username' => 'Admin ',
        //     'email' => 'admin@gmail.com',
        //     'fristname' =>'Kai',
        //     'lastname' =>'naja',
        //     'password' => Hash::make('admin1234'),
        //     'usertype' => 'admin'
        //     ]);

            for ($i = 1; $i <= 20; $i++) {
                DB::table('users')->insert([
                    'username' => 'user' . $i,
                    'email' => 'user' . $i . '@example.com',
                    'fristname' => 'First' . $i,
                    'lastname' => 'Last' . $i,
                    'password' => Hash::make('password' . $i),
                    'usertype' => 'user',
                ]);
            }
        }
    }

