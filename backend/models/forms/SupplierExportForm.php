<?php
/**
 * Created by PhpStorm.
 * User: wangsai
 * Date: 2022/6/7
 * Time: 19:58
 */

namespace backend\models\forms;

use common\traits\EnumTrait;
use yii\base\Model;

class SupplierExportForm extends Model
{
    use EnumTrait;

    const FIELD_NAME = 'name',
        FIELD_CODE = 'code',
        FIELD_T_STATUS = 't_status';

    public $fields = [];

    public $selectAllPages = false;

    public function rules()
    {
        return [
            ['fields', 'each', 'rule' => ['in', 'range' => static::enum('fields')]],
            ['selectAllPages', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fields' => '选择导出字段',
            'selectAllPages' => 'select across all pages',
        ];
    }

    public static function getEnumData()
    {
        return [
            'fields' => [
                static::FIELD_NAME => static::FIELD_NAME,
                static::FIELD_CODE => static::FIELD_CODE,
                static::FIELD_T_STATUS => static::FIELD_T_STATUS,
            ]
        ];
    }
}