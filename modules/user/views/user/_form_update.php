<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'role')->dropDownList(User::getRole(),['prompt'=>'']) ?>
    
    <?= $form->field($model, 'status')->dropDownList(['1'=>'Aktif','2'=>'Tidak Aktif']) ?>
    
    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? 'Proses' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-confirm' => 'Data sudah benar?']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
