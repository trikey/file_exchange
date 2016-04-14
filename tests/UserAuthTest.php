<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/login')
            ->type('i.belitskiy@redmond-rus.com', 'email')
            ->type('Asd=123', 'password')
            ->press('Войти')
            ->seePageIs('/folders');
    }
}
