<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UsersSeeder::class);
        $this->call(NotesSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
