<?php
/**
 * Created by PhpStorm.
 * User: wangsai
 * Date: 2022/6/7
 * Time: 18:47
 */

namespace common\helpers;

class ExcelHelper
{
    public static function toCSV(array $data, array $colHeaders = array(), $asString = false)
    {
        $file = '/file/csv/' . uniqid() . '.csv';

        $filePath = \Yii::getAlias('@webroot') . $file;

        $stream = fopen($filePath, "w+");

        if (!empty($colHeaders)) {
            fputcsv($stream, $colHeaders);
        }

        foreach ($data as $record) {
            fputcsv($stream, $record);
        }

        fclose($stream);

        return $file;
    }
}