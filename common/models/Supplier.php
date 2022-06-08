<?php

namespace common\models;

use common\traits\EnumTrait;
use common\traits\KVTrait;
use common\traits\ModelErrorTrait;
use common\traits\StaticRelationQueryTrait;
use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string $t_status
 */
class Supplier extends \yii\db\ActiveRecord
{
    use StaticRelationQueryTrait;
    use ModelErrorTrait;
    use EnumTrait;
    use KVTrait;

    const STATUS_OK = 'ok',
        STATUS_HOLD = 'hold';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_status'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 3],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            't_status' => 'T Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\SupplierQuery(get_called_class());
    }

    public static function getEnumData()
    {
        return [
            't_status' => [
                static::STATUS_OK => static::STATUS_OK,
                static::STATUS_HOLD => static::STATUS_HOLD,
            ]
        ];
    }
}
