<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kasir\models\search\KasirSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kasir-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kasir_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'user') ?>

    <?= $form->field($model, 'workstation') ?>

    <?= $form->field($model, 'open_date') ?>

    <?php // echo $form->field($model, 'open_bal') ?>

    <?php // echo $form->field($model, 'close_date') ?>

    <?php // echo $form->field($model, 'close_bal') ?>

    <?php // echo $form->field($model, 'real_close_bal') ?>

    <?php // echo $form->field($model, 'transactions') ?>

    <?php // echo $form->field($model, 'open_by') ?>

    <?php // echo $form->field($model, 'close_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
