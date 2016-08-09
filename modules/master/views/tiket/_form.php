<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\master\models\HargaTiket;

/* @var $this yii\web\View */
/* @var $model app\modules\master\models\Tiket */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('document.getElementById("'.Html::getInputId($model, 'wisata').'").setAttribute("style","width:250px");');
$this->registerJs('document.getElementById("'.Html::getInputId($model, 'kategori_tiket').'").setAttribute("style","width:250px");');
$this->registerJs('document.getElementById("'.Html::getInputId($model, 'kategori_perorangan').'").setAttribute("style","width:250px");');
$this->registerJs('document.getElementById("'.Html::getInputId($model, 'harga').'").setAttribute("style","width:150px");');
?>

<div class="tiket-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
    ]); ?>
    
    <?= $form->field($model, 'wisata')->dropDownList(HargaTiket::getListwisata(),['prompt'=>'']) ?>

    <?= $form->field($model, 'kategori_tiket')->dropDownList(HargaTiket::getListtiket(),['prompt'=>'']) ?>

    <?= $form->field($model, 'kategori_perorangan')->dropDownList(HargaTiket::getListperorangan(),['prompt'=>'']) ?>

    <?= $form->field($model, 'harga', [
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
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-confirm' => 'Data sudah benar?']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
