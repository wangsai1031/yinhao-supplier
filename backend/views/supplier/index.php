<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searches\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Suppliers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            'name',
            'code',
            't_status',
        ],
    ]); ?>
    <div class="alert-info alert alert-dismissible checked-all-alert" role="alert" style="display: none">
        All 10 conversations on this page have been selected. <a href="javascript:void(0)" class="checked-all">Select all conversations that match this search</a>
    </div>
    <div class="alert-info alert alert-dismissible clear-checkbox-selection-alert" role="alert" style="display: none">
        All conversations in this search have been selected. <a href="javascript:void(0)" class="clear-checkbox-selection">clear selection</a>
    </div>
    <?php Pjax::end(); ?>

</div>
<?php
Modal::begin([
    'title' => '导出CSV',
    'id' => 'modal_export_csv',
]);
echo '<div id="modal_export_csv_content"> </div>';
Modal::end();

$this->registerJsFile('/js/gridview_checkbox.js', ['depends' => AppAsset::class]);
$this->registerJs(<<<'JS'
$('button.export').click(function () {
    var action = 'export-csv-form';
    $('#modal_export_csv_content').empty().load(action);
    $('#modal_export_csv').modal();
})
JS
);