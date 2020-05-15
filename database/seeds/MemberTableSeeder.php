<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members2')->insert([
            'username' => 'Reira',
            'email'    => 'example@example.com',
            'password' => Hash::make('1qaz2wsx'),
        ]);
    }
}
