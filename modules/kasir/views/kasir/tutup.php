<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\kasir\models\Kasir;

/* @var $this yii\web\View */
/* @var $model app\modules\kasir\models\Kasir */

$this->title = 'Tutup Kasir';
$this->params['breadcrumbs'][] = ['label' => 'Kasir', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('document.getElementById("'.Html::getInputId($model, 'open_bal').'").setAttribute("style","width:250px");');
$this->registerJs('document.getElementById("'.Html::getInputId($model, 'close_bal').'").setAttribute("style","width:250px");');
$this->registerJs('document.getElementById("'.Html::getInputId($model, 'open_bal').'").disabled = true;');
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_title">
                <h2><?= Html::encode($this->title) ?></h2>
                <div class="clearfix"></div>
            </div>

            <?php
            $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_HORIZONTAL,
            ]);
            ?>

            <?= $form->field($model, 'kasir_id')->textInput(['maxlength' => true, 'disabled' => true, 'style' => 'width:150px']) ?>

            <?= $form->field($model, 'user')->dropDownList(Kasir::getListusers(), ['prompt' => '', 'style' => 'width:250px', 'disabled' => true]) ?>

            <?= $form->field($model, 'workstation')->dropDownList(Kasir::getListworkstation(), ['prompt' => '', 'style' => 'width:250px', 'disabled' => true]) ?>
            
            <?= $form->field($model, 'transactions')->textInput(['maxlength' => true, 'disabled' => true, 'style' => 'width:150px']) ?>
            
            <?=
            $form->field($model, 'open_bal', [
                'addon' => [
                    'prepend' => [
                        'content' => 'Rp.'
                    ]
                ]
            ])->widget('yii\widgets\MaskedInput', [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                ]
            ])
            ?>

            <?=
            $form->field($model, 'close_bal', [
                'addon' => [
                    'prepend' => [
                        'content' => 'Rp.'
                    ]
                ]
            ])->widget('yii\widgets\MaskedInput', [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                ]
            ])
            ?>

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <?= Html::submitButton('Proses', ['class' => 'btn btn-success', 'data-confirm' => 'Data sudah benar?']) ?>
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
