<?php

class UserCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/users');
        $I->see('User');
        $I->see('info:');
    }
}
