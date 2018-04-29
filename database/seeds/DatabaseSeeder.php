<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\User;
use \App\Folder;

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
        $id = $user->id;

        $user = new User([
            'fio' => 'Guest',
            'email' => 'test@test.com',
            'password' => '123123',
            'organisation' => 'test',
            'canAccess' => 1
        ]);
        $user->save();

        DB::table('folders')->delete();
        DB::table('folders')->insert(
            [
                'name' => 'Root Folder',
                'created_by' => $id,
                'modified_by' => $id,
                'path' => '/uploads/jADk-PNS_6E.jpg',
                'parent_id' => 0,
            ]
        );
        // $this->call(UsersTableSeeder::class);
    }
}
