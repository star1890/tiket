<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

use app\modules\master\models\Workstation;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Workstation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workstation-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
    ]); ?>

    <?= $form->field($model, 'workstation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workstation_ip')->textInput(['maxlength' => true])->widget('yii\widgets\MaskedInput', ['clientOptions' => ['alias' =>  'ip']]) ?>
    
    <?= $form->field($model, 'wisata')->dropDownList(Workstation::getListwisata(),['prompt'=>'']) ?>
    
    <?= $form->field($model, 'kategori')->dropDownList(Workstation::getListkategori(),['prompt'=>'']) ?>
    
    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-confirm' => 'Data sudah benar?']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
