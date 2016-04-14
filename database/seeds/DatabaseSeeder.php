<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $user = new User([
            'fio' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123123',
            'organisation' => 'admin',
            'isAdmin' => 1
        ]);
        $user->save();

        $user = new User([
            'fio' => 'Guest',
            'email' => 'test@test.com',
            'password' => '123123',
            'organisation' => 'test',
            'canAccess' => 1
        ]);
        $user->save();
        // $this->call(UsersTableSeeder::class);
    }
}
