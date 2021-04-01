<?php

class MyModelCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amConnectedToDatabase('rockclub');

        $model = App\Models\MyModel::factory()->create([
                'id' => 5,
                'name' => 'auto',
                'model' => 'lada',
                'part' => '123'
        ]);

        $I->canSeeInDatabase('my_models', [
            'id' => 5,
        ]);

        $model = new App\Models\MyModel;
        $model['id'] = 2;
        $model['name'] = 'auto';
        $model['model'] = 'lada';
        $model['part'] = 'abc';
//
        $model->save();

        $model->getConnection()->insert("INSERT INTO my_models (id, name, model, part) VALUES (3, 'plain', 'AirBus', 'dhjdk')");

        $models = $model->getConnection()->selectFromWriteConnection('SELECT * FROM my_models');
        var_dump($models);

        \Codeception\TestCase\Test::assertTrue($model->save());
    }
}
