<?php
/**
 * Created by PhpStorm.
 * User: wangsai
 * Date: 2022/6/6
 * Time: 19:50
 */
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name,
    'code' => Yii::$app->getSecurity()->generateRandomString(3),
    't_status' => ['ok', 'hold'][rand(0,1)]
];