<?php

use Illuminate\Database\Seeder;

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

        DB::table('users')->truncate();
        factory(App\Models\User::class, 30)->create();

        DB::table('comments')->truncate();
        $this->call(AdminsTableSeeder::class);
    }
}
