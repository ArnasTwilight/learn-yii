<?php

namespace frontend\tests\smoke;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
//        $I->amOnRoute(Url::toRoute('/site/index'));
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->seeInTitle('My Yii Application');

        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened

        $I->see('This is the About page.');
    }
}
