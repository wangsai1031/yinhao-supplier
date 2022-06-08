<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\ActiveField;
use backend\models\Supplier;
use backend\models\searches\SupplierSearch;

/* @var $this yii\web\View */
/* @var $model backend\models\searches\SupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'id' => 'supplier-search-form',
            'class' => 'form-inline',
            'data-pjax' => 1
        ],
        'fieldClass' => ActiveField::class,
    ]); ?>

    <?= $form->field($model, 'id_operator')->dropDownList(SupplierSearch::enum('id_operator')) ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 't_status')->dropDownList(Supplier::getEnumData('t_status')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Export'), ['class' => 'btn btn-secondary export']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

