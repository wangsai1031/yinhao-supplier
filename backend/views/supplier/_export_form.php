<?php
/**
 * Created by PhpStorm.
 * User: wangsai
 * Date: 2022/6/7
 * Time: 18:49
 */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<div class="supplier-export-form-box">

    <?php $form = ActiveForm::begin([
        'id' => 'supplier-export-form'
    ]); ?>

    <?= $form->field($model, 'fields')->checkboxList($model::enum('fields'), ['id' => 'supplierexportform-fields-input']) ?>
    <hr/>
    <?= $form->field($model, 'selectAllPages')->checkbox() ?>

    <div class="form-group">
        <?= Html::button('Export', ['class' => 'btn btn-success export-submit-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(<<<'JS'
$('.export-submit-btn').click(function () {
    let formData = $('#supplier-export-form').serializeArray()
    if ($('#supplierexportform-selectallpages').is(':checked')) {
        const supplierSearchForm = $('#supplier-search-form').serializeArray();
        console.log(supplierSearchForm)
        for (let i in supplierSearchForm) {
            formData.push({
                name: supplierSearchForm[i].name,
                value: supplierSearchForm[i].value
            })
        } 
    } else {
        let checkedList = []
        $("td > input").each(function() {
            if ($(this).is(':checked')) {
                checkedList.push($(this).parents('tr').data('key'))
            }
        })

        if (checkedList.length === 0) {
            alert('至少选择1条供应商数据')
            return
        }
        
        formData.push({
            name: 'checkedList',
            value: checkedList
        })
    }

    var action = 'export-csv';
    $.post(action, formData, function(data) {
        console.log(data)
        if (data.code === 0) {
            window.open(data.msg, '_self');
            $('#modal_export_csv').modal('hide');
        } else {
            alert(data.msg)
        }
    });
})
JS
);