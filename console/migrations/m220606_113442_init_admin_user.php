<?php

use yii\db\Migration;
use console\models\User;
use yii\helpers\Json;

class m220606_113442_init_admin_user extends Migration
{
    public function up()
    {
        $userModel = new User();
        $userModel->username = 'admin';
        $userModel->email = 'admin@supplier';
        $userModel->status = User::STATUS_ACTIVE;
        $userModel->setPassword('admin123');
        $userModel->generateAuthKey();

        if (! $userModel->save(false)) {
            throw new \yii\console\Exception('创建默认用户失败' . Json::encode($userModel->getFirstErrors()));
        }
    }

    public function down()
    {
        echo '添加失败';
    }
}
