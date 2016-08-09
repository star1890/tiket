<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Wisata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wisata-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
    ]); ?>

    <?= $form->field($model, 'wisata')->textInput(['maxlength' => true]) ?>

    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-confirm' => 'Data sudah benar?']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
