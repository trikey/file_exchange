<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = \App\User::FindByEmail("Taylor@ff.ru");
        $user->delete();

        $this->visit('/register')
            ->type('Taylor', 'fio')
            ->type('Taylor', 'organisation')
            ->type('Taylor@ff.ru', 'email')
            ->type('Taylor', 'password')
            ->type('Taylor', 'password_confirmation')
            ->press('Зарегистрироваться')
            ->seePageIs('/folders');
    }
}
