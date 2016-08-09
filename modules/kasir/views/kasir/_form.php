<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

use app\modules\kasir\models\Kasir;

/* @var $this yii\web\View */
/* @var $model app\modules\kasir\models\Kasir */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('document.getElementById("'.Html::getInputId($model, 'open_bal').'").setAttribute("style","width:250px");');
?>

<div class="kasir-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'kasir_id')->textInput(['maxlength' => true, 'readonly'=>'readonly', 'style'=>'width:150px']) ?>

    <?= $form->field($model, 'user')->dropDownList(Kasir::getListuser(),['prompt'=>'','style'=>'width:250px']) ?>

    <?= $form->field($model, 'workstation')->dropDownList(Kasir::getKasirworkstation(),['prompt'=>'','style'=>'width:250px']) ?>

    <?= $form->field($model, 'open_bal', [
        'addon' => [
            'prepend' => [
                'content'=>'Rp.'
                ]
            ]
        ])->widget('yii\widgets\MaskedInput', [
            'clientOptions' => [
                'alias' =>  'decimal',
                'groupSeparator' => ',',
                'autoGroup' => true
                ]
            ]) ?>

    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton('Proses', ['class' => 'btn btn-success', 'data-confirm' => 'Data sudah benar?']) ?>
            <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
